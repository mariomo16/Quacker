<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quack extends Model
{
    /** @use HasFactory<\Database\Factories\QuackFactory> */
    use HasFactory;

    protected $fillable = ['content', 'display_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quashtag()
    {
        return $this->hasMany(Quashtag::class);
    }
}
