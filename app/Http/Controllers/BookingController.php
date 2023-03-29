<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
