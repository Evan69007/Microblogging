<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostCreationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function testPostCreation()
    {
        // Create a new post and save it to the database
        $user = User::create([
            'name' => 'Jacque',
            'email' => 'j@test.com',
            'password' => 'admin'
           
        
        ]);

        $post = Post::create([
            'user_id' => 1,
            'titre' => 'Sample Post Title',
            'description' => 'Sample Post Description',
        
        ]);
 
        // Retrieve the post from the database and assert its existence
        $createdPost = Post::find($post->id);
        $this->assertNotNull($createdPost);
        $this->assertEquals('Sample Post Title', $createdPost->titre);
    }
}
