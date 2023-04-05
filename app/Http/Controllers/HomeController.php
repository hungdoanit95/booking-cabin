<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SheetDB\SheetDB;
use App\Models\OptData;


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

  public function setOtpSms(Request $request){
    $otp_code = OptData::where('telephone', $request['telephone'])->first();
    if($otp_code){
      return response()->json([
        'api_name' => 'Api xét mã OPT',
        'status' => 0,
        'message' => 'Số điện thoại đã nhận OTP'
      ]);
    }
    $check_update = OptData::insert([
      'telephone' => $request['telephone'],
      'otp_code' => rand(100000,999999),
      'date_add' => date('Y-m-d H:i:s'),
    ]);
    if($check_update){
      return response()->json([
        'api_name' => 'Api Lấy mã Otp',
        'message' => 'Cập nhật Otp thành công',
        'status' => 1
      ]);
    }else{
      return response()->json([
        'api_name' => 'Api Lấy mã Otp',
        'message' => 'Cập nhật Otp không thành công',
        'status' => 0
      ]);
    }
  }

  public function getOtpSms(Request $request){
    $otp_code = OptData::where('telephone', $request['telephone'])->first();
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
}
