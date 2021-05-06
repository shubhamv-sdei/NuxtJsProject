<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
          [ 'id' => '1', 'firstname' => 'Test', 'lastname' => 'User', 'email' => 'testuser@gmail.com', 'country'=>'United State', 'street'=>'254  Peck Street', 'city'=>'Manchester', 'state' => 'NH', 'zip' => '03109', 'password'=> Hash::make('12345678'), 'token' => '0xff51afd7ed558ccdL' ],
       ];
       DB::table('users')->insert($data);
    }
}
