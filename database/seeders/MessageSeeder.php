<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $data = [
                [
                    'invitation_id' => '1',
                    'invitee_id' => '1',
                    'title' => 'دعوة خطوبة',
                    'message' => 'الرجاء عدم اصحاب الاطفال',
                ],
                [
                    'invitation_id' => '2',
                    'invitee_id' => '2',
                    'title' => 'دعوة زفاف',
                    'message' => 'الرجاء عدم اصحاب الاطفال',
                ],
                [
                    'invitation_id' => '3',
                    'invitee_id' => '2',
                    'title' => 'دعوة تخرج',
                    'message' => 'الرجاء عدم اصحاب الاطفال',
                ],
                [
                    'invitation_id' => '1',
                    'invitee_id' => '1',
                    'title' => 'دعوة عزاء',
                    'message' => 'الرجاء عدم اصحاب الاطفال',
                ],
                [
                    'invitation_id' => '2',
                    'invitee_id' => '2',
                    'title' => 'دعوة تكريم',
                    'message' => 'الرجاء عدم اصحاب الاطفال',
                ],
            ];
            DB::table('messages')->insert($data);
    }
}
