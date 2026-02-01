<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'display_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function quacks()
    {
        return $this->hasMany(Quack::class);
    }

    public function quavs()
    {
        return $this->belongsToMany(Quack::class, 'quavs')->withTimestamps();
    }

    public function requacks()
    {
        return $this->belongsToMany(Quack::class, 'requacks')->withTimestamps();
    }

    //https://copyprogramming.com/howto/php-laravel-code-for-follow-users-code-example
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id')->withTimestamps();
    }

    public function feed()
    {
        $userIds = $this->following()->pluck('users.id')->push($this->id);

        $quacks = Quack::query()
            ->select('quacks.*', 'quacks.created_at as feed_date')
            ->whereIn('user_id', $userIds);

        $requacks = Quack::query()
            ->join('requacks', 'quacks.id', '=', 'requacks.quack_id')
            ->select('quacks.*', 'requacks.created_at as feed_date')
            ->whereIn('requacks.user_id', $userIds);

        $feed = $quacks->unionAll($requacks)
            ->with(['user', 'quashtags'])
            ->orderByDesc('feed_date')
            ->get();

        return $feed;
    }

    public function activity()
    {
        $feed = $this
            ->quacks()
            ->select('quacks.*', 'created_at AS feed_date')
            ->unionAll(
                $this
                    ->requacks()
                    ->select('quacks.*', 'requacks.created_at AS feed_date')
                    ->getQuery()
            )
            ->with(['user', 'quashtags'])
            ->orderByDesc('feed_date')
            ->get();

        return $feed;
    }
}
