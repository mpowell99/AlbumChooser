<x-app-layout>
    <div class="flex flex-col gap-4 justify-center w-full p-2">
        <x-header></x-header>
        <div class="flex flex-col justify-center align-center gap-4 max-w-[1200px] mx-auto">
            <table class="bg-white p-4 rounded-lg shadow-md">
                <tr>
                    <th class="px-8 pt-4 pb-1 text-left">Name</th>
                    <th class="px-8 pt-4 pb-1 text-left">Num Albums</th>
                </tr>
            @foreach ($artists as $artist)
                <tr>
                    <td class="px-8 py-1">
                        <a class="hover:text-blue-500" href="/artist/{{ $artist->id }}">{{ $artist->name }}</a>
                    </td>
                    <td class="px-8 py-1">{{ $artist->albums->count() }}</td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>
</x-app-layout>
