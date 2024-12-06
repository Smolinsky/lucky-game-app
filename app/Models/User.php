<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone'
    ];

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
