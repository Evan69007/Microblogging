<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaires extends Model
{
    /** @use HasFactory<\Database\Factories\CommentairesFactory> */
    use HasFactory;
    /** @var list<string>
    */
    // indique ce qu'on va remplir avec le seeder
   protected $fillable = [
    'user_id',
    'post_id',
    'description',

];
}
