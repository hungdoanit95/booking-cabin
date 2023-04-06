<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;


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
  public function index()
  {
    BookingCabin::leftjoin()->get();
      return view('home');
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
