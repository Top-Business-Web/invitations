<?php

namespace Database\Seeders;

use App\Models\Invitee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InviteeSeeder extends Seeder
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
                'invitation_id' => '2',
                'name' => 'abdullah eladapour',
                'email' => 'admin@admin.com',
                'phone' => '01099614948',
                'invitees_number' => '29',
                'status' => '1',
            ],
            [
                'invitation_id' => '1',
                'name' => 'osama arafa',
                'email' => 'admin1@admin.com',
                'phone' => '01099614948',
                'invitees_number' => '22',
                'status' => '3',
            ],
            [
                'invitation_id' => '3',
                'name' => 'Abdullah alhumsi',
                'email' => 'admin2@admin.com',
                'phone' => '01099614948',
                'invitees_number' => '24',
                'status' => '2',
            ],
            [
                'invitation_id' => '1',
                'name' => 'eslam mohammed',
                'email' => 'admin3@admin.com',
                'phone' => '01099614948',
                'invitees_number' => '24',
                'status' => '2',
            ],
        ];
        DB::table('invitees')->insert($data);
    }
}
