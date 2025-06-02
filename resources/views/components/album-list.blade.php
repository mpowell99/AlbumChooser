@props(['albums'])

<div class="flex flex-row flex-wrap justify-center gap-4 w-[978px] mx-auto">
    @foreach($albums as $album)
        <div class="flex flex-col gap-4 border-b border-gray-300 pb-2 bg-white p-4 rounded-lg shadow w-[480px]">
            <div class="flex gap-4">
                <a href="{{ route('album', $album->id) }}" class="">
                    <img src="{{ $album->cover() }}" class="card-img-top w-[150px] rounded" alt="{{ $album->name }}">
                </a>
                <div class="card-body">
                    <div class="text-xl">{{ $album->name }}</div>
                    <div class="">{{ $album->artist->name }}</div>
                    <div><span class='font-semibold'>Release year:</span> {{ $album->year }}</div>
                    <div><span class='font-semibold'>Num plays:</span> {{ $album->num_plays() }}</div>
                    <div><span class='font-semibold'>Last played:</span> {{ \Carbon\Carbon::parse($album->last_played())->format('F jS, Y') }}</div>
                </div>
            </div>
            <div class="w-full pb-4">
                <a href="{{ route('album.listen', $album->id) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded text-center transition">
                    Listen to this
                </a>
            </div>
        </div>
    @endforeach
</div>