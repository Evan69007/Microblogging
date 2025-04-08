<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    /** @var list<string>
    */
    // indique ce qu'on va remplir avec le seeder
   protected $fillable = [
       'user_id',
       'description',
       'hashtags',

   ];
   /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'hashtags'=>'array',
        ];
    }
}
