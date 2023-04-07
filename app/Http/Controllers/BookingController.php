<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\TimeBooks;
use App\Models\Cabins;
use App\Models\OtpData;
use App\Models\User;
use App\Models\Student;
use App\Models\BlacklistPhone;
use App\Repositories\Booking\BookingInterface;

class BookingController extends Controller
{

    protected $bookingRepo;

    public function __construct(BookingInterface $bookingRepo)
    {
        $this->bookingRepo = $bookingRepo;
    }
    public function index(){
        $time_books = TimeBooks::all()->toArray();
        $cabins = Cabins::all();
        $bookings = $this->bookingRepo->getBooking();
        return view('booking', [
            'time_books' => array_chunk(array_chunk($time_books,5),2),
            'cabins' => $cabins
        ]);
    }

    public function checkTuitionFee($telephone){
      $tuition_detail = Student::leftjoin('tuitions','tuitions.student_id','students.id')
      ->leftjoin('money_cabin','money_cabin.student_id','students.id')
      ->where('students.telephone',$telephone)
      ->get();
      if(!empty($tuition_detail) && ((int)$tuition_detail['tuition_paid'] == (int)$tuition_detail['tuition_total'] && (int)$tuition_detail['tuition_unpaid'] == 0 || (int)$tuition_detail['cabin_money'] > 0)){
        return 1; // đã đóng đủ học phí hoặc đã đóng tiền cabin
      }
      return 0;
    }

    public function createOrUpdate(Request $request){
        if(empty($request) 
        || empty($request->time_val)
        || empty($request->date_val)
        || empty($request->name_val)
        || empty($request->telephone_val)){
            return redirect()->back()->width('msg', 'Vui lòng kiểm tra lại dữ liệu'); 
        }
        $cabin_id = 0;
        $time_id = $request->time_val;
        $date_booking = isset($request->date_val) ? $request->date_val : strtotime(date("Y-m-d")."+ 2 days");
        $name_booking = $request->name_val;
        $email_booking = 'email@gmail.com';
        $telephone_booking = $request->telephone_val;
        $status = $request->status;
        $data_filter = array(
            'cabin_id' => $cabin_id,
            'time_id' => $time_id,
            'date_booking' => $date_booking,
            'telephone_booking' => $telephone_booking,
        );
        $check_tuition = $this->checkTuitionFee($telephone_booking);
        $data_create_update = array(
            'name_booking' => $name_booking,
            'email_booking' => $email_booking,
            'status' => $check_tuition ? 2 : 1, // Nếu đã đóng tiền thì trạng thái tự duyệt là 2
        );
        $check_add_update = Booking::updateOrCreate($data_filter,$data_create_update);
        if($check_add_update){
            return response()->json([
                'api_name' => 'Đặt lịch học Cabin',
                'message' => 'Đặt lịch học Cabin thành công',
                'status' => 1,
            ]);
        }else{
            return response()->json([
                'api_name' => 'Đặt lịch học Cabin',
                'message' => 'Đặt lịch học Cabin không thành công',
                'status' => 0,
            ]);
        }
    }

    public function viewFindBooking(){
        return view('find-booking');
    }

    
    public function findBooking(Request $request){
        $data = array();
        if(!empty($request->date_register) && !empty($request->keywords)){
            $keyword = !empty($request->keywords)?$request->keywords:'';
            $bookings = Booking::leftjoin('timebooks','timebooks.time_id','booking_cabin.time_id')->where('date_booking',$request->date_register)->where(function ($q) use ($keyword){
                $q->where('telephone_booking',$keyword)
                ->orWhere('name_booking',$keyword);
            })->get();
            $data = $bookings;
        }
        if(!empty($data)){
            return response()->json([
                'api_name' => 'Api Find Booking',
                'status' => 1,
                'message' => 'Tìm kiếm thành công',
                'data' => $data
            ]);
        }else{
            return response()->json([
                'api_name' => 'Api Find Booking',
                'status' => 0,
                'message' => 'Tìm kiếm không thành công',
                'data' => $data
            ]);
        }
    }

    public function findBookings(Request $request){
        $data_json = array();
        if(!empty($request->telephone) || !empty($request->date_booking)){
            $date_bokking = !empty($request->date_booking)?$request->date_booking:date('Y-m-d');
            $bookings = Booking::where('telephone_booking',$request->telephone)->where('date_bokking',$date_bokking)
            ->select(
                'cabins.name',
                'timebooks.time_value',
                'booking_cabin.date_booking',
                'booking_cabin.name_booking',
                'booking_cabin.email_booking',
                'booking_cabin.telephone_booking'
            )->get();
        }
        return response()->json([
            'api_name' => 'Lịch học Cabin đã đặt',
            'message' => 'Load dữ liệu thành công',
            'data' => $bookings,
            'status' => 1,
        ]);
    }

    public function checkTimeCabin(Request $request){
        $data_json = array();
        $time_ids = Booking::where('date_booking',$request->date_booking)->where('status',2)->select('time_id')->get();
        return response()->json([
            'api_name' => 'Lịch học Cabin đã đặt',
            'message' => 'Load dữ liệu thành công',
            'data' => $time_ids,
            'status' => 1,
        ]);
    }
    
    public function privacyPolicy(){
        return 0;
    }
    public function termsOfService(){
        return 0;
    }
    
    public function callbackGoogleSheet(Request $request){
        return $request;
    }
    
    protected function sendOTPSMS($telephone,$new_otp_code){
      $input_xml = "<RQST name='send_sms_list'>
      <REQID>11111111</REQID>
      <CONTRACTID>3172</CONTRACTID>
      <LABELID>37005</LABELID>
      <TEMPLATEID>454730</TEMPLATEID>
      <ISTELCOSUB>0</ISTELCOSUB>
      <PARAMS>
          <NUM>1</NUM>
          <CONTENT>
            Ma Otp cua ban la: ".$new_otp_code.". Luu lai ma OTP de su dung xuyen suot qua trinh hoc tai Website cabin.hoclaioto.net
          </CONTENT>
      </PARAMS>
      <CONTRACTTYPEID>1</CONTRACTTYPEID>
      <SCHEDULETIME></SCHEDULETIME>
      <MOBILELIST>".preg_replace('/^0/','84',$telephone)."</MOBILELIST>
      <AGENTID>304</AGENTID>
      <APIUSER>DayLaiXeOto</APIUSER>
      <APIPASS>laixeoto</APIPASS>
      <USERNAME>DayLaiXeOto</USERNAME>
    </RQST>";
    $url = "http://113.185.0.35:8888/smsmarketing/api";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml;charset=UTF-8'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $input_xml);
    $data = curl_exec($ch);
    curl_close($ch);
    $array_data = json_decode(json_encode(simplexml_load_string($data)), true);
    return $array_data;
  }

    public function setOtpSms(Request $request){
        $otp_code = OtpData::where('telephone', $request['telephone'])->first();
        if($otp_code){
          return response()->json([
              'api_name' => 'Api xét mã OPT',
              'status' => 0,
              'message' => 'Số điện thoại đã nhận OTP, vui lòng nhập lại mã OTP đã nhận vào ô (Mã OTP)'
          ]);
        }
        $check_blacklist = BlacklistPhone::where('telephone', $request['telephone'])->first();
        $status_phone_blacklist = 0; 
        if(!empty($check_blacklist) && $check_blacklist['status'] == 1){
          return response()->json([
              'api_name' => 'Api xét mã OPT',
              'status' => -1,
              'message' => 'Số điện thoại của bạn đã trong danh sách hạn chế vui lòng liên hệ hotline trung tâm để được hỗ trợ!'
          ]);
        }else if(!empty($check_blacklist) && $check_blacklist['status'] == 0){
          $status_phone_blacklist = 1;
        }
        $new_otp_code = rand(100000,999999);
        $check_send = $this->sendOTPSMS($request['telephone'],$new_otp_code);
        $check_update = 0;
        if($check_send){
          if($check_send['ERROR'] == '0'){
            $check_update = OtpData::insert([
              'telephone' => $request['telephone'],
              'otp_code' => $new_otp_code,
              'date_add' => date('Y-m-d H:i:s')
            ]);
          }else{
            BlacklistPhone::updateOrCreate(['telephone'=> $request['telephone']],[
              'status' => $status_phone_blacklist
            ]);
            return response()->json([
                'api_name' => 'Api Lấy mã Otp',
                'message' => 'Cập nhật Otp không thành công. Vui lòng kiểm tra lại số điện thoại',
                'error_description' => $check_send['ERROR_DESC'],
                'status' => 0
            ]);
          }
        }
        if($check_update){
          return response()->json([
              'api_name' => 'Api Lấy mã Otp',
              'message' => 'Cập nhật Otp thành công',
              'status' => 1,
              'error_description' => ''
          ]);
        }else{
          return response()->json([
              'api_name' => 'Api Lấy mã Otp',
              'message' => 'Cập nhật Otp không thành công',
              'status' => 0,
              'error_description' => ''
          ]);
        }
    }

  public function getOtpSms(Request $request){
    $otp_code = OtpData::where('telephone', $request['telephone'])->first();
    if($otp_code){
      return response()->json([
        'api_name' => 'Api Lấy mã OPT',
        'status' => 1,
        'otp_code' => $otp_code
      ]);
    }else{
      return response()->json([
        'api_name' => 'Api Lấy mã OPT',
        'status' => 0,
        'otp_code' => array()
      ]);
    }
  } 

  public function checkOtpSms(Request $request){
    $check_otp = OtpData::where('telephone',$request['telephone'])->where('otp_code', $request['otp_code'])->first();
    if($check_otp){
      $users = Student::where('telephone',$request['telephone'])->first();
      return response()->json([
        'api_name' => 'Api Lấy mã OPT',
        'status' => 1,
        'data' => $users,
        'message' => 'Pass'
      ]);
    }else{
      return response()->json([
        'api_name' => 'Api Lấy mã OPT',
        'status' => 0,
        'message' => 'Fail'
      ]);
    }
  }
}
