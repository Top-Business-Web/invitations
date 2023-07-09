<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScannedSeeder extends Seeder
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
            ],
            [
                'invitation_id' => '1',
                'invitee_id' => '2',
            ],
            [
                'invitation_id' => '1',
                'invitee_id' => '3',
            ],
            [
                'invitation_id' => '1',
                'invitee_id' => '4',
            ],
            [
                'invitation_id' => '2',
                'invitee_id' => '1',
            ],
            [
                'invitation_id' => '2',
                'invitee_id' => '2',
            ],
            [
                'invitation_id' => '2',
                'invitee_id' => '3',
            ],
            [
                'invitation_id' => '2',
                'invitee_id' => '4',
            ],
        ];
        DB::table('scanneds')->insert($data);
    }
}
