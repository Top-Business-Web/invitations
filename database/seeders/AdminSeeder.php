<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
           'name' => 'Osama arafa',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);
        Admin::create([
           'name' => 'Abdullah Alhumsi',
            'email' => 'abdo@abdo.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
