<x-app-layout>
    <div class="flex flex-col gap-4 items-center h-screen w-screen justify-center">
        <div class="text-7xl">
            AlbumChooser
        </div>

        <div class="text-2xl">
            Keep track of what you're listening to, and pick what to listen to next.
        </div>

        <a
            href="{{ route('login') }}"
            class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300"
        >
            Log in
        </a>
    </div>
</x-app-layout>