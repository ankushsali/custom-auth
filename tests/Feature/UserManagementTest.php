<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserManagementTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_register(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Test User',
            'email' => 'testuser@gmail.com',
            'phone' => '0987654321',
            'password' => 'password'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@gmail.com'
        ]);
    }

    public function test_user_login(): void
    {
        $this->setUpUserLogin();
    }

    public function test_user_dashboard(): void
    {
        $this->setUpUserLogin();

        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.dashboard');
    }

    public function test_profile_update(): void
    {
        $this->setUpUserLogin();

        $response = $this->post(route('profile'), [
            'name' => 'Test User Updated',
            'phone' => '1234567890'
        ]);

        $user = User::where('name', 'Test User Updated')->first('name');

        $response->assertStatus(302);
        $this->assertEquals($user->name, 'Test User Updated');
        $response->assertRedirect('dashboard');
    }

    public function test_user_logout(): void
    {
        $this->setUpUserLogin();

        $response = $this->get(route('logout'));

        $response->assertStatus(302);
        $response->assertRedirect('/login');

        $this->assertGuest();
    }
}
