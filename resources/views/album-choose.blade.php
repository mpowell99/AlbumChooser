<x-app-layout>
    <div class="flex flex-col gap-4 justify-center w-full p-2">
        <x-header :showsort="false"></x-header>
        <div class="flex flex-col px-16 max-w-max mx-auto">
            <div class="text-3xl pb-4">
            @if ($artist) 
                {{ $artist->name }}: {{ $albums->count() }} albums
            @else
                Choose one from these five albums
            @endif
            </div>
            <x-album-list :albums="$albums"></x-album-list> 
        </div>
    </div>
</x-app-layout>