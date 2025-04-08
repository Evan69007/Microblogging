<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    /** @use HasFactory<\Database\Factories\LikesFactory> */
    use HasFactory;
      /** @var list<string>
    */
    // indique ce qu'on va remplir avec le seeder
   protected $fillable = [
    'user_id',
    'post_id',

];
}
