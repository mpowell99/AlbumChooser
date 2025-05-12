<?php

namespace App\Models;

use App\Models\Artist;
use App\Providers\Spotify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Album extends Model
{
    // Return the albums ordered by last_played
    public static function last_played_albums($limit = 12) {
        $userId = Auth::id();
        return Album::join('album_user', 'albums.id', '=', 'album_user.album_id')
            ->where('album_user.user_id', $userId)
            ->orderBy('album_user.last_played', 'desc')
            ->select('albums.*')
            ->paginate($limit);
    }

    public function cover() {
        if ($this->image_url) {
            return $this->image_url;
        }
        $album_info = Spotify::album_info($this);
        if (isset($album_info->images[1])) {
            $this->image_url = $album_info->images[1]->url ?? null;
        }
        $this->save();

        return $this->image_url;
    }

    public function artist() {
        return $this->belongsTo(Artist::class);
    }

    // Many-to-many relationship with User
    public function users() {
        return $this->belongsToMany(User::class)
            ->withPivot('num_plays', 'last_played')
            ->withTimestamps();
    }

    public function scopeSearch($query, $searchTerm) {
        return $query->where('name', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('artist', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('name')
            ->get(); // Ensure results are hydrated as models
    }

    public function num_plays() {
        $pivotRecord = $this->users()->where('user_id', Auth::id())->first();

        return $pivotRecord ? $pivotRecord->pivot->num_plays : 0;
    }

    public function last_played() {
        $pivotRecord = $this->users()->where('user_id', Auth::id())->first();

        return $pivotRecord ? $pivotRecord->pivot->last_played : null;
    }
}
