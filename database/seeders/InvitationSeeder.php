<?php

namespace Database\Seeders;

use App\Models\Invitation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagePath = 'assets/front/photo/blog2.jpg';
        $data = [
            [
                'date' => '2023-12-05',
                'title' => 'دعوة عيد ميلاد',
                'image' => $imagePath,
                'has_qrcode' => true,
                'qrcode' => 'hello my friend 1',
                'send_date' => true,
                'address' => 'cairo, sheppen alkom',
                'longitude' => '25 * 25',
                'latitude' => '50 * 65',
                'password' => '123456',
                'user_id' => 2,
                'status' => 1,
                'step' => 25,
            ],
            [
                'date' => '2023-12-05',
                'title' => 'دعوة خطوبة',
                'image' => $imagePath,
                'has_qrcode' => true,
                'qrcode' => 'hello my friend',
                'send_date' => true,
                'address' => 'cairo, sheppen alkom',
                'longitude' => '25 * 25',
                'latitude' => '50 * 65',
                'password' => '123456',
                'user_id' => 3,
                'status' => 1,
                'step' => 25,
            ],
            [
                'date' => '2023-12-05',
                'title' => 'دعوة عزاء',
                'image' => $imagePath,
                'has_qrcode' => true,
                'qrcode' => 'hello my friend',
                'send_date' => true,
                'address' => 'cairo, sheppen alkom',
                'longitude' => '25 * 25',
                'latitude' => '50 * 65',
                'password' => '123456',
                'user_id' => 1,
                'status' => 1,
                'step' => 25,
            ],
        ];
        DB::table('invitations')->insert($data);
    }
}
