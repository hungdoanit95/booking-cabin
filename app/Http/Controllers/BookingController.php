<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\TimeBooks;
use App\Models\Cabins;
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

    public function createOrUpdate(Request $request){
        if(empty($request) 
        || empty($request->cabin_val)
        || empty($request->time_val)
        || empty($request->date_val)
        || empty($request->name_val)
        || empty($request->telephone_val)){
            return redirect()->back()->width('msg', 'Vui lòng kiểm tra lại dữ liệu'); 
        }
        $cabin_id = $request->cabin_val;
        $time_id = $request->time_val;
        $date_booking = $request->date_val;
        $name_booking = $request->name_val;
        $email_booking = $request->email_val;
        $telephone_booking = $request->telephone_val;
        $data_filter = array(
            'cabin_id' => $cabin_id,
            'time_id' => $time_id,
            'date_booking' => $date_booking,
            'telephone_booking' => $telephone_booking,
        );
        $data_create_update = array(
            'name_booking' => $name_booking,
            'email_booking' => $email_booking,
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
            $bookings = Booking::leftjoin('cabins','cabins.id','booking_cabin.cabin_id')->leftjoin('timebooks','timebooks.time_id','booking_cabin.time_id')->where('date_booking',$request->date_register)->where(function ($q) use ($keyword){
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
        $time_ids = Booking::where('date_booking',$request->date_booking)->where('cabin_id',$request->cabin_id)->select('time_id')->get();
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
}
