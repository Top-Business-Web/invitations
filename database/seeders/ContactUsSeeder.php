<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactUsSeeder extends Seeder
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
                'name' => 'osama arfa',
                'phone' => '01061994948',
                'subject' => 'دعوة لحضور زفاف',
                'message' => 'الرجاء عدم اصحاب الاطفال',
            ],
            [
                'name' => 'Abdullah Alhumsi',
                'phone' => '01061994948',
                'subject' => 'دعوة لحضور حفل تخرج',
                'message' => 'الرجاء عدم اصحاب الاطفال',
            ],
            [
                'name' => 'Abdullah eldapour',
                'phone' => '01061994948',
                'subject' => 'دعوة لحضور حفل تكريم',
                'message' => 'الرجاء عدم اصحاب الاطفال',
            ],
            [
                'name' => 'eslam mohammed',
                'phone' => '01061994948',
                'subject' => 'دعوة لحضور عزاء ',
                'message' => 'الرجاء عدم اصحاب الاطفال',
            ],
        ];
        DB::table('contact_us')->insert($data);
    }
}
