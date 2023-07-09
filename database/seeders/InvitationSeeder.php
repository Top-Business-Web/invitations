<?php

namespace Database\Seeders;

use App\Models\Invitation;
use Illuminate\Database\Seeder;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invitation::create([
            'date' => '2023-12-05',
            'title' => 'دعوة زفاف',
            'image' => 'assets/uploads/users/70511688644149.png',
            'has_qrcode' => '1',
            'qrcode' => 'hello my friend',
            'send_date' => '1',
            'address' => 'cairo, sheppen alkom',
            'longitude' => '25 * 25',
            'latitude' => '50 * 65',
            'password' => bcrypt('123456'),
            'user_id' => '1',
            'status' => '1',
            'step' => '25',
        ]);
        Invitation::create([
            'date' => '2023-12-05',
            'title' => 'دعوة عيد ميلاد',
            'image' => 'assets/uploads/users/70511688644149.png',
            'has_qrcode' => '1',
            'qrcode' => 'hello my friend 1',
            'send_date' => '1',
            'address' => 'cairo, sheppen alkom',
            'longitude' => '25 * 25',
            'latitude' => '50 * 65',
            'password' => bcrypt('123456'),
            'user_id' => '2',
            'status' => '1',
            'step' => '25',
        ]);
        Invitation::create([
            'date' => '2023-12-05',
            'title' => 'دعوة خطوبة',
            'image' => 'assets/uploads/users/70511688644149.png',
            'has_qrcode' => '1',
            'qrcode' => 'hello my friend',
            'send_date' => '1',
            'address' => 'cairo, sheppen alkom',
            'longitude' => '25 * 25',
            'latitude' => '50 * 65',
            'password' => bcrypt('123456'),
            'user_id' => '3',
            'status' => '1',
            'step' => '25',
        ]);
    }
}
