<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;
use App\Models\Booking;

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
    $datas = Booking::leftjoin('students','students.telephone','booking_cabin.telephone_booking')
    ->leftjoin('tuitions','tuitions.student_id','students.id')
    ->leftjoin('money_cabin','money_cabin.student_id','students.id')
    ->leftjoin('timebooks','timebooks.time_id','booking_cabin.time_id')
    ->select(
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
      'status',
      'booking_cabin.id as id '
    )
    ->get();
      return view('home',[
        'datas' => $datas
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
