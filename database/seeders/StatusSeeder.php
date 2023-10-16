<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
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
                "type" => "whatsapp",
                "invitation_id" => "1",
                "invitee_id" => "1",
                "status" => "2",
            ],
            [
                "type" => "qr_code",
                "invitation_id" => "1",
                "invitee_id" => "2",
                "status" => "3",
            ],
            [
                "type" => "qr_code",
                "invitation_id" => "2",
                "invitee_id" => "2",
                "status" => "4",
            ],
        ];
        DB::table('statuses')->insert($data);
    }
}
