@props(['albums'])

<div class="flex flex-row flex-wrap justify-center gap-4 w-[978px] mx-auto">
    @foreach($albums as $album)
        <div class="flex gap-4 border-b border-gray-300 pb-4 bg-white p-4 rounded-lg shadow w-[480px]">
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
    @endforeach
</div>