<?php  

namespace Tests;

trait UserLoginTest{
    public function setUpUserLogin(): void
    {
        $response = $this->post(route('login'), [
            'email' => 'testuser@gmail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('dashboard');
        $this->assertAuthenticated();
    }
}