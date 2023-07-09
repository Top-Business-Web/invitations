<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
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
                'password' => bcrypt('1234'),
                'image' => $imagePath,
            ],
            [
                'name' => 'Abdullah alhumsi',
                'email' => 'admin1@admin.com',
                'password' => bcrypt('1234'),
                'image' => $imagePath,
            ],
            [
                'name' => 'abdullah eldapour',
                'email' => 'admin2@admin.com',
                'password' => bcrypt('1234'),
                'image' => $imagePath,
            ],
            [
                'name' => 'eslam mohammed',
                'email' => 'admin3@admin.com',
                'password' => bcrypt('1234'),
                'image' => $imagePath,
            ],
        ];
        DB::table('admins')->insert($data);
    }
}
