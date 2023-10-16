<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
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
                'title' => 'دعوة خطوبة',
                'body' => 'في المنوفية شبين الكوم شارع الجلاء',
                'invitation_id' => '1',
                'invitee_id' => '1',
                'user_id' => '1',
                'image' => $imagePath,
                'type' => 'message',
            ],
            [
                'title' => 'دعوة زفاف',
                'body' => 'في المنوفية شبين الكوم شارع الجلاء',
                'invitation_id' => '2',
                'invitee_id' => '2',
                'user_id' => '2',
                'image' => $imagePath,
                'type' => 'message',
            ],
            [
                'title' => 'دعوة عيد ميلاد',
                'body' => 'في المنوفية شبين الكوم شارع الجلاء',
                'invitation_id' => '3',
                'invitee_id' => '3',
                'user_id' => '3',
                'image' => $imagePath,
                'type' => 'message',
            ],
            [
                'title' => 'دعوة عزاء',
                'body' => 'في المنوفية شبين الكوم شارع الجلاء',
                'invitation_id' => '1',
                'invitee_id' => '2',
                'user_id' => '3',
                'image' => $imagePath,
                'type' => 'message',
            ],
            [
                'title' => 'دعوة تخرج',
                'body' => 'في المنوفية شبين الكوم شارع الجلاء',
                'invitation_id' => '2',
                'invitee_id' => '2',
                'user_id' => '3',
                'image' => $imagePath,
                'type' => 'message',
            ],
        ];

        DB::table('notifications')->insert($data);
    }
}
