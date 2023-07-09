<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(InvitationSeeder::class);
        $this->call(InviteeSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(ScannedSeeder::class);


    }
}
