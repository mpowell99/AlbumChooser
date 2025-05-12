<?php

namespace App\Providers;

use App\Models\Album;
use Illuminate\Support\Facades\Cache;

class Spotify {
    protected static $clientID = '6b00146e8e274f1f90df9bdf324ca30b';

    protected static $clientSecret = 'a015ac270fb34f8abe0d843caa9107ae';

    /*
    curl -X POST "https://accounts.spotify.com/api/token" \
     -H "Content-Type: application/x-www-form-urlencoded" \
     -d "grant_type=client_credentials&client_id=6b00146e8e274f1f90df9bdf324ca30b&client_secret=a015ac270fb34f8abe0d843caa9107ae"

     https://open.spotify.com/artist/7Eu1txygG6nJttLHbZdQOh?si=3dC_oGDXS6CY1q99YoSSzQ

     curl "https://api.spotify.com/v1/artists/7Eu1txygG6nJttLHbZdQOh" \
     -H "Authorization: Bearer BQALd7Sg6bTi34fYc7Uj7w22um6DUAEIDWx6qDp8Rtec7f9l4ICr4-8aByLFtULNiJXehMKM34jsz_MWwl7rJgIf1fTUFlOIvNxrM9NN8h7C1Z1m3YiFjaGbihxVoo65bXJ0sbwEMR4"


    */

    private static function get_access_token() {
        // Check if the token is already cached
        if (Cache::has('spotify_access_token')) {
            return Cache::get('spotify_access_token');
        }

        $endpoint = 'https://accounts.spotify.com/api/token'; 
        $data = [
            'grant_type' => 'client_credentials',
            'client_id' => self::$clientID,
            'client_secret' => self::$clientSecret,
        ];

        $results = self::request($endpoint, $data, 'post', true);
        $access_token = $results->access_token;

        // Cache the token for 1 hour
        Cache::put('spotify_access_token', $access_token, 3600);

        return $access_token;
    }

    public static function artist_info(string $artist_id) {
        $endpoint = 'https://api.spotify.com/v1/artists/' . $artist_id;

        $results = self::request($endpoint, [], 'get');

        return $results;
    }

    public static function album_info(Album $album) {
        $album_id = $album->spotify_id;

        $endpoint = 'https://api.spotify.com/v1/albums/' . $album_id;

        $results = self::request($endpoint, [], 'get');

        return $results;
    }

    private static function request(string $endpoint, array $query = [], string $request_type = 'post', bool $get_token = false) {
        $headers = [
            'Accept: application/json',
        ];

        if (!$get_token) {
            $headers[] = 'Authorization: Bearer '. self::get_access_token();
        } else {
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        }

        $ch = curl_init();

        if ($request_type == 'post') {
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
        } else {
            curl_setopt($ch, CURLOPT_URL, $endpoint . '?' . http_build_query($query));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Error:' . curl_error($ch));
        }
        curl_close($ch);

        return json_decode($response);
    }
}

?>