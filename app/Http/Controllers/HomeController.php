<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;
use App\Models\Booking;
use Auth;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {
    $student_phonecode = !empty($request->student_phonecode)?$request->student_phonecode:'';
    $date_booking = !empty($request->date_booking)?$request->date_booking:'';
    $status = !empty($request->status)?(int)$request->status:'';
    $datas = Booking::leftjoin('students','students.telephone','booking_cabin.telephone_booking')
    ->leftjoin('tuitions','tuitions.student_id','students.id')
    ->leftjoin('money_cabin','money_cabin.student_id','students.id')
    ->leftjoin('timebooks','timebooks.time_id','booking_cabin.time_id');
    if(!empty($student_phonecode)){
      $datas = $datas->where(function ($query) use ($student_phonecode) {
        $query->where('students.telephone', '=', $student_phonecode)
              ->orWhere('students.student_code', '=', $student_phonecode);
      });
    }
    if(!empty($date_booking)){
      $datas = $datas->where('booking_cabin.date_booking',$date_booking);
    }
    if(!empty($status)){
      $datas = $datas->where('booking_cabin.status',$status);
    }
    if(isset($request->typeview) && $request->typeview !== '*'){
      if($request->typeview == 1){
        $datas = $datas->orderBy('date_booking','DESC');
        $datas = $datas->orderBy('time_value','DESC');
      }else if($request->typeview == 2){
        $datas = $datas->orderBy('date_booking','ASC');
        $datas = $datas->orderBy('time_value','ASC');
      }else if($request->typeview == 3){
        $datas = $datas->orderBy('booking_cabin.created_at','DESC');
      }else if($request->typeview == 4){
        $datas = $datas->orderBy('booking_cabin.created_at','ASC');
      }
    }
    $datas = $datas->select(
      'course_code',
      'student_code',
      'name_booking',
      'telephone_booking',
      'date_booking',
      'time_value',
      'notes_booking',
      'tuition_total',
      'tuition_paid',
      'tuition_unpaid',
      'date_payout',
      'cabin_money',
      'address_id',
      'status',
      'booking_cabin.id as id'
    )->get();
      $user_login = Auth::user();
      return view('home',[
        'datas' => !empty($datas)?$datas:array(),
        'user_login' => $user_login,
        'filter' => [
          'student_phonecode' => $student_phonecode,
          'date_booking' => $date_booking,
          'status' => $status,
          'typeview' => isset($request->typeview)?$request->typeview:''
        ]
      ]);
  }

  function requestSheetdb($url, $method = 'GET', $data = []) {
    $options = array(
      'http' => array(
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'method'  => strtoupper($method),
        'content' => http_build_query([
          'data' => $data
        ])
      )
    );
  
    try {
      $raw = @file_get_contents($url, false, stream_context_create($options));
      $result = json_decode($raw);
    } catch (Exception $e) {
      return false;
    }
  
    return $result;
  }
  
  public function getDataGoogleSheet(){
        // returns all spreadsheets data
        $content = $this->requestSheetdb('https://sheetdb.io/api/v1/8q04pf4lyad35');
        return $content;
  }
}
