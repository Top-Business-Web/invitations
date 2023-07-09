<?php

namespace Database\Seeders;

use App\Models\Invitee;
use Illuminate\Database\Seeder;

class InviteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invitee::create([
            'invitation_id' => '1',
            'name' => 'Abdullah alhumsi',
            'phone' => '01099614948',
            'invitees_number' => '24',
            'status' => '2',
        ]);
        Invitee::create([
            'invitation_id' => '2',
            'name' => 'osama arafa',
            'phone' => '01099614948',
            'invitees_number' => '22',
            'status' => '3',
        ]);
        Invitee::create([
            'invitation_id' => '2',
            'name' => 'abdullah eladapour',
            'phone' => '01099614948',
            'invitees_number' => '29',
            'status' => '1',
        ]);
    }
}
