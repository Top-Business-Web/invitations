<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Osama arafa',
             'email' => 'admin@admin.com',
             'phone' => '01099614948',
             'address' => 'cairo',
             'password' => bcrypt('123456'),
             'status' => '1',
             'image' => 'assets/uploads/users/70511688644149.png',
         ]);
        User::create([
            'name' => 'Abdullah Alhumsi',
             'email' => 'admin1@admin.com',
             'phone' => '01099614948',
             'address' => 'cairo',
             'password' => bcrypt('123456'),
             'status' => '1',
             'image' => 'assets/uploads/users/70511688644149.png',
         ]);
        User::create([
            'name' => 'Abdullah Eldapour',
             'email' => 'admin2@admin.com',
             'phone' => '01099614948',
             'address' => 'cairo',
             'password' => bcrypt('123456'),
             'status' => '1',
             'image' => 'assets/uploads/users/70511688644149.png',
         ]);
    }
}
