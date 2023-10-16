<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessfulLogin()
    {

        DB::beginTransaction();

        try {
            DB::table('admins')->insert([
                'name' => 'test',
                'email' => 'admin6@admin.com',
                'password' => Hash::make('password123'),
                'image' => 'assets/uploads/users/70511688644149.png',
            ]);


            $response = $this->post('admin/login', [
                'email' => 'admin6@admin.com',
                'password' => 'password123',
            ]);

            $response->assertStatus(200);
        } finally {
            DB::rollBack();
        }
    }
}
