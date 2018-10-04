<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Adminstrator',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('logernam'),
                'role' => 'admin',
                'last_login' => Carbon::now(),
                'phone' => '88-89-98-99',
                'address' => '01 31 12 TNT on Street',
                'type' => 'traveller',
                'status' => 'loyal',
                'activate' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Loger Admin',
                'username' => 'logernam',
                'email' => 'logernam@gmail.com',
                'password' => Hash::make('logernam'),
                'role' => 'admin',
                'last_login' => Carbon::now(),
                'phone' => '88-89-98-99',
                'address' => '01 31 12 TNT on Street',
                'type' => 'traveller',
                'status' => 'loyal',
                'activate' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Loger User',
                'username' => 'logeruser',
                'email' => 'logeruser@gmail.com',
                'password' => Hash::make('logernam'),
                'role' => 'user',
                'last_login' => Carbon::now(),
                'phone' => '88-89-98-99',
                'address' => '01 31 12 TNT on Street',
                'type' => 'traveller',
                'status' => 'loyal',
                'activate' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Loger Admin',
                'username' => 'logeradmin',
                'email' => 'logeradmin@gmail.com',
                'password' => Hash::make('logernam'),
                'role' => 'admin',
                'last_login' => Carbon::now(),
                'phone' => '88-89-98-99',
                'address' => '01 31 12 TNT on Street',
                'type' => 'traveller',
                'status' => 'loyal',
                'activate' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
