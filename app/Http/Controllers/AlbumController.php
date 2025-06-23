<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function index(Request $request) {
        if (Auth::guest()) {
            return view('home');
        }

        $orderBy = $request->input('orderby');
        if ($orderBy === 'year') {
            $albums = Album::orderBy('year', 'desc')->paginate(24);

        } elseif ($orderBy === 'date_added') {
            $albums = Album::orderBy('created_at', 'desc')->paginate(24);

        } else {
            $albums = Album::last_played_albums(24);
        }

        return view('album_grid', [
            'albums' => $albums,
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
        $order_by = $request->input('orderby') ?? "last_played";
        if (in_array($order_by, array("year", "last_played", "date_added"))) {
            $order_dir = "desc";
        } else {
            $order_dir = "asc";
        }

        $query = $request->input('query');
        $albums = Album::search($query, $order_by, $order_dir)->get();

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

    public function listen(Album $album) {
        $user = Auth::user();
        $user->increment_plays($album);

        $userinfo = $album->users()->where('user_id', $user->id)->first()->pivot;
        return view('album', [
            'album' => $album,
            'userinfo' => $userinfo,
        ]);
    }
}
