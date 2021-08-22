<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Login()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('123456789'),
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => '123456789',
        ]);

        $this->assertAuthenticated();
    }


    public function test_user_can_login_mobile(){
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'mobile'=>'9377689399',
            'password' => bcrypt('123456789'),
        ]);

        $this->post(route('login'), [
            'email'=>'9377689399',
            'password' => '123456789',
        ]);

        $this->assertAuthenticated();




    }
}
