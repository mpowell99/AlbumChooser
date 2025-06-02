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
        'name',
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

    // Many to many relationship with albums
    public function albums() {
        return $this->belongsToMany(Album::class)
            ->withPivot('num_plays', 'last_played')
            ->withTimestamps();
    }

    public function num_plays() {
        return $this->albums->sum('pivot.num_plays');
    }

    public function increment_plays(Album $album) {
        $this->albums()->updateExistingPivot($album->id, [
            'num_plays' => \DB::raw('num_plays + 1'),
            'last_played' => now(),
        ]);
    }
}
