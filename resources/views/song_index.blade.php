<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Song') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Song_index page!
                    <table class="table-auto md:w-full">
                        <thead>
                          <tr class="text-left">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Artist</th>
                            <th>Album</th>
                            <th>Genre</th>
                            <th>Language</th>
                            <th>Duration</th>
                            <th>URL</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($songs as $song)
                                @if ($loop->odd)
                                    <tr class="leading-7">
                                @elseif ($loop->even)
                                    <tr class="bg-green-100 leading-7">
                                @endif
                                        <td>{{ $song->song_id }}</td>
                                        <td>{{ $song->title }}</td>
                                        <td>{{ $song->artist }}</td>
                                        <td>{{ $song->album->album_name }}</td>
                                        <td>{{ $song->genre_id }}</td>
                                        <td>{{ $song->language_id }}</td>
                                        <td>{{ $song->duration }}</td>
                                        <td>{{ $song->song_url }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>