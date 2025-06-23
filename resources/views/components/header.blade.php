<div class="flex w-full justify-between items-center mb-4">
    <div class="flex gap-4">
        <a class="text-blue-500 hover:underline" href="{{ route('choose') }}">Choose</a>
        <a class="text-blue-500 hover:underline" href="{{ route('artists') }}">Artists</a>
    </div>

    <div class='flex gap-4'>
        @if ($showsort ?? false)
            <form action="/" method="GET">
                <select name="orderby" class="border border-gray-300 rounded-lg pl-4 pr-8 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                    <option value="last_played" {{ request('orderby', 'last_played') == 'last_played' ? 'selected' : '' }}>Last Played</option>
                    <option value="date_added" {{ request('orderby') == 'date_added' ? 'selected' : '' }}>Date Added</option>
                    <option value="year" {{ request('orderby') == 'year' ? 'selected' : '' }}>Year</option>
                </select>
            </form>
        @endif

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
</div>