<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function last_played() {
        if (Auth::guest()) {
            return view('home');
        }

        $latest_played = Album::last_played_albums(24);
        return view('latest_played', [
            'albums' => $latest_played,
            'header' => 'Hello world',
        ]);
    }

    public function show(Album $album) {
        $user = Auth::user();
        $userinfo = $album->users()->where('user_id', $user->id)->first()->pivot;
        return view('album', [
            'album' => $album,
            'userinfo' => $userinfo,
        ]);
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $albums = Album::search($query);
        return view('search', [
            'albums' => $albums,
            'query' => $query,
        ]);
    }

    public function choose() {
        $albums = Album::inRandomOrder()->limit(5)->get();
        return view('album-choose', [
            'artist' => null,
            'albums' => $albums,
        ]);
    }
}
