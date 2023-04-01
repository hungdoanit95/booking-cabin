<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeBooks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
                'time_value' => '14h00 - 15h00',
            ),
            array(
                'time_id' => 10,
                'time_value' => '15h00 - 16h00',
            ),
            array(
                'time_id' => 11,
                'time_value' => '16h00 - 17h00',
            ),
            array(
                'time_id' => 12,
                'time_value' => '17h00 - 18h00',
            ),
            array(
                'time_id' => 13,
                'time_value' => '18h00 - 19h00',
            ),
            array(
                'time_id' => 14,
                'time_value' => '19h00 - 20h00',
            ),
            array(
                'time_id' => 15,
                'time_value' => '20h00 - 21h00',
            ),
            array(
                'time_id' => 16,
                'time_value' => '21h00 - 22h00',
            ),
        );
        foreach($time_books as $time_book){
            DB::table('timebooks')->insert($time_book);
        }
    }
}
