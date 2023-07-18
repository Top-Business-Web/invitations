<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
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
                "user_id" => "1",
                "name" => "abdo",
                "email" => "abdo@abod.com",
                "phone" => "012645751236",
            ],
            [
                "user_id" => "2",
                "name" => "osama",
                "email" => "osama@osama.com",
                "phone" => "012645751236",
            ],
            [
                "user_id" => "3",
                "name" => "elsam",
                "email" => "abdo@abod.com",
                "phone" => "012645751236",
            ],
            [
                "user_id" => "4",
                "name" => "eldapour",
                "email" => "eldapour@eldapour.com",
                "phone" => "012645751236",
            ],
        ];
        DB::table('contacts')->insert($data);
    }
}
