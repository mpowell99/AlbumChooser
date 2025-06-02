<x-app-layout>
    <div class="py-12">
        <div class="flex flex-col gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col gap-4 p-6 text-gray-900">
                    <div><b>Email:</b> {{ Auth::user()->email }}</div>
                    <div><b>Number of Album Plays:</b> {{ Auth::user()->num_plays() }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
