<x-app-layout>
    <div class="flex flex-col gap-4 justify-center w-full p-16 pt-4">
        <x-header></x-header>
        <div class="flex flex-wrap rounded-xl overflow-hidden">
        @foreach ($albums as $album)
            <a
                class="w-1/4 lg:w-1/6 relative cursor-pointer"
                href="{{ route('album', $album) }}"
                x-data="{ show: false }"
                @mouseover="show = true"
                @mouseleave="show = false"
            >
                <img src='{{ $album->cover() }}'>
                <div
                    x-show="show"
                    class="absolute bg-white bottom-0 left-0 w-full opacity-80 p-2 flex flex-col text-xs"
                >
                    <div class="font-semibold">{{ $album->artist->name }}</div>
                    <div>{{ $album->name }}</div>
                </div>
            </a>
        @endforeach
        </div>
        <div class="pt-4">{{ $albums->links() }}</div>
    </div>
</x-app-layout>