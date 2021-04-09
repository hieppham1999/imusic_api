<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Song Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-3 gap-3 bg-gray-100">
                        <div class="col-span-2">
                            <form action="{{ route('songs.update', ['song_id' => $song->song_id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="grid grid-cols-3 gap-3 m-5">
                                    <div class="my-2 col-span-3 ">
                                        <label for="Title" class="form-label">Title</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="title" id="title" placeholder="" value="{{ $song->title }}">
                                    </div>
                                    <div class="my-2 col-span-3">
                                        <label for="Artist" class="form-label">Artist</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="artist_name" id="artist" placeholder="" value="{{ $song->artist }}">
                                    </div>
                                    <div class="my-2 col-span-3">
                                        <label for="Album" class="form-label">Album</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="album" id="album" placeholder="" value="{{ $song->album->album_name }}">
                                    </div>
                                    <div class="my-2">
                                        <label for="Release Date" class="form-label">Release Date</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="release_date" id="release_date" placeholder="" value="{{ $song->release_date ?: '' }}">
                                    </div>
                                    <div class="my-2">
                                        <label for="Language" class="form-label">Language</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="language" id="language" placeholder="" value="{{ $song->language_id ?? '' }}">
                                    </div>
                                    <div class="my-2">
                                        <label for="Genre" class="form-label">Genre</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="genre" id="genre" placeholder="" value="{{ $song->genre_id ?: '' }}">
                                    </div>
                                    <div class="my-2 col-span-3">
                                        <label for="URL" class="form-label">URL</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="URL" id="URL" placeholder="" value="{{ $song->song_url }}" readonly>
                                    </div>

                                </div>
                                <div class="my-2 col-span-3 text-center ">
                                    <button type="submit" class="bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-full py-2 px-10">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="m-5">Instruction</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>






