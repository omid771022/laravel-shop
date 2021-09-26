<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase

{
use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */







    public function registerNewuser(){
      return  $this->post(route('register'), [
    
            'name' => 'test',
            'email' => 'test@example.com',
            'mobile' => '09377689399',
            'password' => '1234567890',
            'password_confirmation' => '1234567890',
        ]);
    }
    



    public function test_user_can_see_registration()
    {
        $response = $this->get('register');
        $response->assertStatus(200);
    }


    public function test_user_can_register()
    {
        $this->withExceptionHandling();
        $this->registerNewuser();

        $this->assertCount(1, User::all());
    }

public function test_user_can_verfy_account(){
    $this->registerNewuser();
    
    $response= $this->get(route('home'));
    $response->assertRedirect(route('verification.notice'));
}
public function test_verfy_user_can__see_home_page(){
    $this->registerNewuser();
    $this->assertAuthenticated();
    auth()->user()->markEmailAsVerified();
    $response =$this->get(route('home'));
    $response->assertOk();
}

public function test_you_can_verify_account(){

$userr=User::create([
'name' => $this->faker->name,
'email'=>$this->faker->email,
'password' => $this->faker->password,
]);
$code =random_int(100000, 999999);

}
}
