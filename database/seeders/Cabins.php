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
                'name' => 'Bình Dương',
            ),
            array(
                'id' => 2,
                'name' => 'Đồng Nai',
            ),
            array(
                'id' => 3,
                'name' => 'Bà Rịa - Vũng Tàu',
            ),
        );
        foreach($cabins as $cabin){
            DB::table('cabins')->insert($cabin);
        }
    }
}
