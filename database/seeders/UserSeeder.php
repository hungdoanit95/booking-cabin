<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array(
                'group_id'=>1,
                'name'=>'Giáo viên Đồng Nai',
                'password'=>Hash::make('@123123123'),
                'email' => 'giaoviendongnai@gmail.com',
                'telephone'=>'0123123123',
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ),
            array(
                'group_id'=>1,
                'name'=>'Giáo viên Bình Dương',
                'password'=>Hash::make('@123123123'),
                'email' => 'giaovienbinhduong@gmail.com',
                'telephone'=>'0456456456',
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ),
            array(
                'group_id'=>1,
                'name'=>'Giáo viên Dầu Khí',
                'password'=>Hash::make('@123123123'),
                'email' => 'giaoviendaukhi@gmail.com',
                'telephone'=>'0789789789',
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ),
            array(
                'group_id'=>2,
                'name'=>'Admin',
                'password'=>Hash::make('@123123123'),
                'email' => 'admin@gmail.com',
                'telephone'=>'0909123456',
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ),
        );
        foreach($users as $user){
            DB::table('users')->insert($user);
        }
    }
}
