<x-app-layout>
    <div class="flex flex-col gap-4 justify-center w-full p-2">

        <x-header></x-header>
        <div class="flex flex-col px-16 max-w-max mx-auto">

        @if(isset($albums) && $albums->count() > 0)
            <div class="text-3xl pb-4">
                {{ $albums->count() }} albums matching your search
            </div>
            <x-album-list :albums="$albums"></x-album-list> 
        @elseif(isset($albums))
            <p class="text-muted">No albums found for your search.</p>
        @endif
    </div>
</x-app-layout>