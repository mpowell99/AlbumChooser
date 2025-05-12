<div class="flex w-full justify-between items-center mb-4">
    <div class="flex gap-4">
        <a class="text-blue-500 hover:underline" href="{{ route('choose') }}">Choose</a>
        <a class="text-blue-500 hover:underline" href="{{ route('artists') }}">Artists</a>
    </div>
    <form action="{{ route('search') }}" method="GET">
        <input 
            class="border border-gray-300 rounded-lg px-4 py-2 w-72 focus:outline-none focus:ring-2 focus:ring-blue-500"
            type="text" 
            name="query" 
            placeholder="Search..." 
            class="search-input" 
            required 
        />
    </form>
</div>