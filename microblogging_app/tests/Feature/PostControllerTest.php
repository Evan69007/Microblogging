<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase; // Refresh the database after each test

    public function test_create_post()
    {
        $user = User::create([
            'name' => 'Jacque',
            'email' => 'j@test.com',
            'password' => 'admin'
           
        
        ]);

        // Simulate a user creating a new post through the web interface
        $response = $this->post(route('posts.store'), [
            'user_id' => 1,
            'titre' => 'Sample Post Title',
            'description' => 'Sample Post Description',
        ]);
 
        // Assert that the post is successfully stored in the database
        $this->assertCount(1, Post::all());
 
        // Assert that the user is redirected to the Posts Index page after post creation
        // $response->assertRedirect(route('posts.index'));
    }
}
