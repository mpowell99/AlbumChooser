<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
{
    public function show(Artist $artist) {
        $user = Auth::user();

        $albums = $artist->albums()->get();

        return view('album-choose', [
            'artist' => $artist,
            'albums' => $albums,
        ]);
    }

    public function index() {
        $user = Auth::user();

        $artists = Artist::orderBy('name')->get();

        return view('artists', [
            'artists' => $artists,
        ]);
    }
}