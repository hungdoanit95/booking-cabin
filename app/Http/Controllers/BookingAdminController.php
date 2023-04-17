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
use Auth;
use Illuminate\Support\Facades\Log;
use DB;

class BookingAdminController extends Controller
{
    protected $bookingRepo;
    public function __construct(BookingInterface $bookingRepo)
    {
        $this->bookingRepo = $bookingRepo;
    }
    public function Booking(Request $request){
        $time_books = TimeBooks::all()->toArray();
        $cabins = Cabins::all();
        $bookings = $this->bookingRepo->getBooking();
        $data_request = $request->all();
        return view('admin-dat-lich',[
            'time_books' => array_chunk(array_chunk($time_books,5),2),
            'cabins' => $cabins,
            'fillter_data' => $data_request
        ]);
    }
    public function adminDeleteBooking(Request $request){
        $user_login = Auth::user();
        $booking_id = isset($request->booking_id) ? $request->booking_id : '';
        if(!empty($booking_id)){
            $booking_delete = DB::table('booking_cabin')->where('id', $booking_id)->where('status',1)->get();
            if(!empty($booking_delete)){
                $check_delete = DB::table('booking_cabin')->where('id', $booking_id)->where('status',1)->update([
                    'user_delete_id' => $user_login->id,
                    'date_deleted' => date('Y-m-d'),
                    'status' => 3
                ]);
                if($check_delete){
                    return response()->json([
                        'api_name' => 'Api delete booking',
                        'status' => 1,
                        'message' => 'Bạn đã xóa booking thành công'
                    ]);
                }
            }
        }
        
        return response()->json([
            'api_name' => 'Api delete booking',
            'status' => 0,
            'message' => 'Rất tiếc bạn không thể xóa booking này'
        ]);
    }
    public function adminUpdateBooking(Request $request){
        $user_login = Auth::user();
        $id_status = isset($request->id_status) ? $request->id_status : '';
        $booking_id = isset($request->booking_id) ? (int)$request->booking_id : '';
        if(!empty($booking_id)){
            $booking_delete = DB::table('booking_cabin')->where('id', $booking_id)->where('status',1)->get();
            if(!empty($booking_delete)){
                $check_delete = DB::table('booking_cabin')->where('id', $booking_id)->where('status',1)->update([
                    'admin_id' => $user_login->id,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'status' => $id_status
                ]);
                if($check_delete){
                    return response()->json([
                        'api_name' => 'Api update booking',
                        'status' => 1,
                        'message' => 'Bạn đã cập nhật booking thành công'
                    ]);
                }
            }
        }
        
        return response()->json([
            'api_name' => 'Api update booking',
            'status' => 0,
            'message' => 'Rất tiếc bạn không thể cập nhật booking này'
        ]);
    }
}
