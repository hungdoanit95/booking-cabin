<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cabins extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        foreach($cabins as $cabin){
            DB::table('cabins')->insert($cabin);
        }
    }
}
