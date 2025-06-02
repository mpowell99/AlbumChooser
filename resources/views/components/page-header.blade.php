<div class="p-4 bg-white border-b text-4xl flex justify-between gap-4 items-center">
    {{--  This will be where the logo goes
        <div></div>
    --}}
    <div><a href="{{ route('home') }}">Album Chooser</a></div>
    <div class="flex gap-4 text-sm">
        @guest
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
        @endguest

        @auth
            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">Profile</a>
        @endauth
    </div>
</div>