<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagePath = 'assets/uploads/users/70511688644149.png';
        $data = [
            [
                'name' => 'Osama arafa',
                'email' => 'admin@admin.com',
                'phone' => '01099614948',
                'points' => '1',
                'address' => 'cairo',
                'password' => bcrypt('123456'),
                'status' => '1',
                'image' => 'assets/uploads/users/70511688644149.png',
            ],
            [
                'name' => 'abdullah alhumsi',
                'email' => 'admin1@admin.com',
                'phone' => '01099614948',
                'points' => '1',
                'address' => 'cairo',
                'password' => bcrypt('123456'),
                'status' => '1',
                'image' => 'assets/uploads/users/70511688644149.png',
            ],
            [
                'name' => 'abdullah eldapour',
                'email' => 'admin2@admin.com',
                'phone' => '01099614948',
                'points' => '1',
                'address' => 'cairo',
                'password' => bcrypt('123456'),
                'status' => '1',
                'image' => 'assets/uploads/users/70511688644149.png',
            ],
            [
                'name' => 'eslam mohammed',
                'email' => 'admin3@admin.com',
                'phone' => '01099614948',
                'points' => '1',
                'address' => 'cairo',
                'password' => bcrypt('123456'),
                'status' => '1',
                'image' => 'assets/uploads/users/70511688644149.png',
            ],
        ];
        DB::table('users')->insert($data);
    }
}
