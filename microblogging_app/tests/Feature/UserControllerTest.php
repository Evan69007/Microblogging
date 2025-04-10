<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase; // Refresh the database after each test

    public function test_create_users()
    {

        // Simulate a user creating a new post through the web interface
        $response = $this->post(route('users.store'), [
            'name' => 'Jacque',
            'email' => 'j@test.com',
            'password' => 'admin'
        ]);
 
        // Assert that the post is successfully stored in the database
        $this->assertCount(1, User::all());
 
        // Assert that the user is redirected to the Posts Index page after post creation
        // $response->assertRedirect(route('posts.index'));
    }
}