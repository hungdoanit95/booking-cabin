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
        return View('admin-dat-lich',[
            'time_books' => array_chunk(array_chunk($time_books,5),2),
            'cabins' => $cabins,
            'fillter_data' => $data_request
        ]);
    }
}
