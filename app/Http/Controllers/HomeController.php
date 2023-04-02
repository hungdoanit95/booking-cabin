<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Gmail;

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

    public function getDataGoogleSheet(){
        $client = new Google_Client();
        $client->setAuthConfig(config_path('credentials.json'));
        $client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);
        $service = new Google_Service_Sheets($client);
        $spreadsheetId = '1bYPOEvdj1noc3wwSppRD8KanNspvEfx3AN8hCDnF4nQ';
        $range = 'Sheet1!A1:E';
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();
        return $values;
    }
}
