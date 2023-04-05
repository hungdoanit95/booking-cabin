<?php

namespace App\Console\Commands;

use App\Helpers\GoogleSheet;
use Illuminate\Console\Command;
use Google_Client;
use Google_Service_Sheets;
use Exception;
use Log;
use DB;
use App\Models\Student;
use App\Models\Tuition;
use App\Models\Certificate;

class GoogleSheetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:google_sheet_api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getGoogleClient()
   {
   	$client = new Google_Client();
   	$client->setApplicationName('Google Sheets API PHP Quickstart');
   	$client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
   	$client->setAuthConfig(config_path('credentials.json'));
   	$client->setAccessType('offline');
   	$tokenPath = storage_path('app/token.json');
   	if (file_exists($tokenPath)) {
   		$accessToken = json_decode(file_get_contents($tokenPath), true);
   		$client->setAccessToken($accessToken);
   	}

   	if ($client->isAccessTokenExpired()) {
   		if ($client->getRefreshToken()) {
   			$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
   		} else {
   			$authUrl = $client->createAuthUrl();
   			printf("Open the following link in your browser:\n%s\n", $authUrl);
   			print 'Enter verification code: ';
   			$authCode = trim(fgets(STDIN));

   			// Exchange authorization code for an access token.
   			$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
   			$client->setAccessToken($accessToken);

   			// Check to see if there was an error.
   			if (array_key_exists('error', $accessToken)) {
   				throw new Exception(join(',', $accessToken));
   			}
   		}

   		if (!file_exists(dirname($tokenPath))) {
   			mkdir(dirname($tokenPath), 0700, true);
   		}
   		file_put_contents($tokenPath, json_encode($client->getAccessToken()));
   	}

   	return $client;
  }

  public function insertDatabase($value = array()){
    if(count($value) > 0){
      // DB
    }
  }

  public function readFileGoogleSheet($service){
		// $spreadsheetIds = env('GOOGLE_SHEET_ID');
		$spreadsheetIds = [
			"1dgDM_OzmLMjRfMETp4DCa5A_jFMtAhmyuM3WHxoKhRs"
			// "1ZNyQB3tkRORgqVaKmnuLQK2Ht0fa2d67pD5pLTBZeOU",
			// "1bYPOEvdj1noc3wwSppRD8KanNspvEfx3AN8hCDnF4nQ", ## Template chính
		];
		$range = 'Sheet1!A2:DG';
		// get values
		foreach($spreadsheetIds as $spreadsheetId){
			$response = $service->spreadsheets_values->get($spreadsheetId, $range);
			$values = $response->getValues();
			Log::debug($values); return;
			if(count($values) > 0){
				foreach($values as $value){
					if(isset($value[1]) || isset($value[2])){ // Tồn tại mã học viên hoặc tên học viên
						DB::beginTransaction();
						try{
							DB::table('students')->updateOrInsert([
								'student_code' => isset($value[1])?$value[1]:'', // Cột B: Mã HV
								'telephone' =>  isset($value[11])?$value[11]:'', // Cột L Điện thoại
							],[
								'time_hidden' => isset($value[0])?date('Y-m-d', strtotime($value[0])):'', // Cột A: Dấu thời gian
								'student_name' =>  isset($value[2])?$value[2]:'', // Cột C: Họ và Tên học viên
								'course_code' =>  isset($value[3])?$value[3]:'', // Cột D: Khóa
								'course_planed' =>  isset($value[4])?$value[4]:'', // Cột E: Khoá dự kiến Dành cho CSKH
								'birthday' =>  isset($value[9])?date('Y-m-d', strtotime($value[9])):'', // Cột J Ngày sinh
								'address' =>  isset($value[10])?$value[10]:'', // Cột k Địa chỉ
								'telephone2' =>  isset($value[11])?$value[11]:'', // Cột M SDT khác
								'id_student' =>  isset($value[12])?$value[12]:'', // Cột N CMND
								'date_give_card' => isset($value[13])?date('Y-m-d', strtotime($value[13])):'', // Cột O Ngày cấp thẻ học nghề (ĐỐI VỚI BĐXN)
							]);
							$student_id = DB::getPdo()->lastInsertId();
							DB::table('certificates')->updateOrInsert([
								'certificate_name' => isset($value[5])?$value[5]:'', // Cột F: Hạng
							],[
								'certificate_name' => isset($value[5])?$value[5]:'', // Cột F: Hạng
							]);
							$certificate_id = DB::getPdo()->lastInsertId();
							DB::table('tuitions')->updateOrInsert([
								'certificate_id' => isset($certificate_id)?$certificate_id:'', // Cột F: Hạng
								'student_id' => isset($student_id)?$student_id:''
							],[
								'tuition_total' => isset($value[6])?$value[6]:'', // Cột G:
								'tuition_paid' => isset($value[7])?$value[7]:'', // Cột H:
								'tuition_unpaid' => isset($value[8])?$value[8]:'', // Cột I:
							]);
							DB::table('courses')->updateOrInsert([
								'student_id' => isset($student_id)?$student_id:''
							],[
								'time_practice' => isset($value[15])?$value[15]:'',
								'address_practice' => isset($value[16])?$value[16]:'',
								'total_time' => isset($value[17])?$value[17]:'',
								'time_practiced' => isset($value[18])?$value[18]:'',
								'time_unpracticed' => isset($value[19])?$value[19]:'',
							]);
							DB::table('employee')->updateOrInsert([
								'student_id' => isset($student_id)?$student_id:''
							],[
								'clue' => isset($value[20])?$value[20]:'', // Cột U Đầu mối
								'call' => isset($value[21])?$value[21]:'', // Cột V Call
								'sale' => isset($value[22])?$value[22]:'', // Cột W Sale
								'register' => isset($value[23])?$value[23]:'', // Cột X Ghi danh tại văn phòng
								'schedule_price' => isset($value[24])?$value[24]:'', // Cột Y Lịch Trình Đóng Tiền (Như trên hợp đồng)
								'misa_name' => isset($value[25])?$value[25]:'', // Cột Z Tên Misa
								'misa_year' => isset($value[26])?$value[26]:'', // Cột AA Năm
								'misa_month' => isset($value[27])?$value[27]:'', // Cột AB tháng
							]);
							DB::table('gift_and_time')->updateOrInsert([
								'student_id' => isset($student_id)?$student_id:''
							],[
								'books' => isset($value[28])?$value[28]:'', // Cột AC Phát sách 600 câu
								'gifts' => isset($value[29])?$value[29]:'', // Cột AD Quà tặng (nếu có)
								'tuition_solid' => isset($value[30])?$value[30]:'', // Cột AE HỌC PHÍ CHUẨN
								'money_discount_fullmoney' => isset($value[31])?$value[31]:'', // Cột AF ĐÓNG HẾT HỌC PHÍ GIẢM TIỀN
								'money_discount_in' => isset($value[32])?$value[32]:'', // Cột AG TIỀN GIẢM TRONG CHƯƠNG TRÌNH
								'money_discount_ex' => isset($value[33])?$value[33]:'', // TIỀN GIẢM NGOÀI CHƯƠNG TRÌNH
								'reg_group' => isset($value[34])?$value[34]:'', // GIẢM ĐĂNG KÝ NHÓM/ GIỚI THIỆU
								'total_tuition' => isset($value[35])?$value[35]:'', // AJ TỔNG HỌC PHÍ SAU GIẢM
								'compare' => isset($value[36])?$value[36]:'', // AK ĐỐI CHIẾU LỆCH VỚI GIÁ SALES
							]);
							// DB::table('money_cabin')->updateOrInsert([
							// 	'student_id' => isset($student_id)?$student_id:''
							// ],[
							// 	'date_payout'=>isset($value[89])?$value[89]:'', // Cột CL NGÀY NỘP TRUNG TÂM
							// 	'cabin_money'=>isset($value[90])?$value[90]:'' // Cột CM TIỀN CABIN
							// ]);
							DB::commit();
						}catch(Exception $e){
							Log::debug($e);
							DB::rollback();
						}
					}
				}
			}
		}
		return 'Done';
  }

//    public function updateGoogleSheet(){
// 		$data = [
// 			[
// 				'column A2',
// 				'column B2',
// 				'column C2',
// 				'column D2',
// 			],
// 			[
// 				'column A3',
// 				'column B3',
// 				'column C3',
// 				'column D3',
// 			],
// 		];
// 		$requestBody = new \Google_Service_Sheets_ValueRange([
// 			'values' => $data
// 		]);

// 		$params = [
// 			'valueInputOption' => 'RAW'
// 		];

// 		$service->spreadsheets_values->update($spreadsheetId, $range, $requestBody, $params);
//   }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      // Log::debug('start update sheet 1 data');
      $client = $this->getGoogleClient();
      $service = new Google_Service_Sheets($client);
      //Get Value
      $this->readFileGoogleSheet($service);
    }
}
