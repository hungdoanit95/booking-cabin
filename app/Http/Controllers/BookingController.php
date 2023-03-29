<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index(){
        $time_books = array(
            array(
                'time_id' => 1,
                'time_value' => '6h00 - 7h00',
            ),
            array(
                'time_id' => 2,
                'time_value' => '7h00 - 8h00',
            ),
            array(
                'time_id' => 3,
                'time_value' => '8h00 - 9h00',
            ),
            array(
                'time_id' => 4,
                'time_value' => '9h00 - 10h00',
            ),
            array(
                'time_id' => 5,
                'time_value' => '10h00 - 11h00',
            ),
            array(
                'time_id' => 6,
                'time_value' => '11h00 - 12h00',
            ),
            array(
                'time_id' => 7,
                'time_value' => '12h00 - 13h00',
            ),
            array(
                'time_id' => 8,
                'time_value' => '13h00 - 14h00',
            ),
            array(
                'time_id' => 9,
                'time_value' => '14h30 - 15h30',
            ),
            array(
                'time_id' => 10,
                'time_value' => '15h30 - 16h30',
            ),
            array(
                'time_id' => 11,
                'time_value' => '16h30 - 17h30',
            ),
            array(
                'time_id' => 12,
                'time_value' => '17h30 - 18h30',
            ),
            array(
                'time_id' => 13,
                'time_value' => '18h30 - 19h30',
            ),
            array(
                'time_id' => 14,
                'time_value' => '19h30 - 20h30',
            ),
            array(
                'time_id' => 15,
                'time_value' => '20h30 - 21h30',
            ),
            array(
                'time_id' => 16,
                'time_value' => '21h30 - 22h30',
            ),
        );
        $cabins = array(
            array(
                'id' => 1,
                'name' => 'Cabin số 1',
            ),
            array(
                'id' => 2,
                'name' => 'Cabin số 2',
            ),
            array(
                'id' => 3,
                'name' => 'Cabin số 3',
            ),
            array(
                'id' => 4,
                'name' => 'Cabin số 4',
            ),
            array(
                'id' => 5,
                'name' => 'Cabin số 5',
            ),
        );
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
        || empty($request->email_val)
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

    public function findBookings(Request $request){
        $data_json = array();
        if(!empty($request->telephone) || !empty($request->date_booking)){
            $date_bokking = !empty($request->date_booking)?$request->date_booking:date('Y-m-d');
            $bookings = Booking::where('telephone_booking',$request->telephone)->where('date_bokking',$date_bokking)->get();
        }
        return response()->json([
            'api_name' => 'Lịch học Cabin đã đặt',
            'message' => 'Load dữ liệu thành công',
            'data' => $bookings,
            'status' => 1,
        ]);
    }
}
