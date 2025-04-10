<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    /** @var list<string>
    */
    // indique ce qu'on va remplir avec le seeder
   protected $fillable = [
       'user_id',
       'titre',
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

    public function user(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id');

}
public function likes(): HasMany
{
    return $this->hasMany(Likes::class, 'post_id');
}

public function commentaires(): HasMany
{
    return $this->hasMany(Commentaires::class, 'post_id');
}
}
