<x-app-layout>
    <div class="flex flex-col gap-4 justify-center w-full p-2">
        <x-header :showsort="false"></x-header>
        <div class="flex justify-center items-center gap-4">
            <div class="flex gap-4">
            <img class="rounded-lg shadow" src='{{ $album->cover() }}'>
            <div class="flex flex-col gap-2 align-start">
                <div class="text-4xl font-black">{{ $album->name }}</div>
                <div class="text-2xl font-bold"><a href="{{ route('artist', $album->artist) }}">{{ $album->artist->name }}</a></div>
                <div><span class='font-semibold'>Release year:</span> {{ $album->year }}</div>
                <div><span class='font-semibold'>Num plays:</span> {{ $userinfo->num_plays }}</div>
                <div><span class='font-semibold'>Last played:</span> {{ \Carbon\Carbon::parse($userinfo->last_played)->format('F jS, Y') }}</div>
                <div><a class="text-blue-500 underline hover:text-blue-600" href='spotify:album:{{ $album->spotify_id }}'>Open in Spotify</a></div>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
