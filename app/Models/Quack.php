<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quack extends Model
{
    /** @use HasFactory<\Database\Factories\QuackFactory> */
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quashtags()
    {
        return $this->belongsToMany(Quashtag::class, 'quack_quashtag');
    }

        public function quavs() {
        return $this->belongsToMany(User::class, 'quavs');
    }

    public function requacks() {
        return $this->belongsToMany(User::class, 'requacks');
    }


}
