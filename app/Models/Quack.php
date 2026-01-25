<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quack extends Model
{
    /** @use HasFactory<\Database\Factories\QuackFactory> */
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    //https://stackoverflow.com/questions/38686188/check-if-user-liked-post-laravel
    public function hasRequacked(int $user_id)
    {
        return $this->requacks()->where('user_id', $user_id)->exists();
    }

    public function authHasRequacked()
    {
        return $this->requacks()->where('user_id', auth()->id())->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quashtags()
    {
        return $this->belongsToMany(Quashtag::class, 'quack_quashtag');
    }

    public function quavs()
    {
        return $this->belongsToMany(User::class, 'quavs');
    }

    public function requacks()
    {
        return $this->belongsToMany(User::class, 'requacks');
    }
}
