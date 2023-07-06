<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactUs::create([
            'name' => 'Abdullah Alhumsi',
             'phone' => '01061994948',
             'subject' => 'دعوة لحضور حفل تخرج',
             'message' => 'الرجاء عدم اصحاب الاطفال',
         ]);
        ContactUs::create([
            'name' => 'osama arfa',
             'phone' => '01061994948',
             'subject' => 'دعوة لحضور زفاف',
             'message' => 'الرجاء عدم اصحاب الاطفال',
         ]);
    }
}
