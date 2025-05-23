<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Profil_Users extends Model
{
    /** @use HasFactory<\Database\Factories\ProfilUsersFactory> */
    use HasFactory;
    /** @var list<string>
    */
    // indique ce qu'on va remplir avec le seeder
   protected $fillable = [
		'user_id',
		'biographie',
	];

	protected $table = 'profil_users';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
