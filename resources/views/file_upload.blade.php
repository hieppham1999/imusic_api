<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-3 gap-3 bg-gray-100">
                        <div class="col-span-2">
                            <form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                @if (session('success'))
                                    <div class="alert alert-success text-green-400 text-center">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="grid grid-cols-3 gap-3 m-5">
                                    <div class="my-2 col-span-3 ">
                                        <label for="Title" class="form-label">Title</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="title" id="title" value="{{ old('title') }}" placeholder="" >
                                        @error('title')
                                            <div class="alert alert-danger text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-2 col-span-3">
                                        <label for="Artist" class="form-label">Artist</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="artist_name" id="artist" value="{{ old('artist_name') }}" placeholder="">
                                        @error('artist_name')
                                        <div class="alert alert-danger text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-2 col-span-3">
                                        <label for="Album" class="form-label">Album</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="album" id="album" value="{{ old('album') }}" placeholder="">
                                        @error('album')
                                        <div class="alert alert-danger text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-2 col-span-3">
                                        <label for="Composer" class="form-label">Composer</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="composer" id="composer" value="{{ old('composer') }}" placeholder="">
                                        @error('composer')
                                        <div class="alert alert-danger text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-2">
                                        <label for="Year" class="form-label">Year</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="year" id="year" value="{{ old('year') }}" placeholder="">
                                        @error('year')
                                        <div class="alert alert-danger text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-2">
                                        <label for="Language" class="form-label">Language</label>
                                        <select class="form-control md:w-full border-gray-300" name="language" id="language">
                                                <option disabled selected value> -- select an language -- </option>
                                            @foreach ($languages as $id => $language)
                                                <option value="{{ $id + 1 }}" {{ (old("language") == $id + 1 ? "selected":"") }} >
                                                    {{ $language->language_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('language')
                                        <div class="alert alert-danger text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="my-2">
                                        <label for="Genre" class="form-label">Genre</label>
                                        <select class="form-control md:w-full border-gray-300" name="genre" id="genre">
                                                <option disabled selected value> -- select an genre -- </option>
                                            @foreach ($genres as $id => $genre)
                                                <option value="{{ $id + 1 }}" {{ (old("genre") == $id + 1 ? "selected":"") }} >
                                                    {{ $genre->genre_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('genre')
                                        <div class="alert alert-danger text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <div class="my-2 col-span-3">
                                        <label for="File Select" class="form-label">Select mp3 file</label>
                                        <input class="form-control border-gray-300" type="file" id="formFile" name="_file" value="{{ old('_file') }}">
                                        @error('_file')
                                        <div class="alert alert-danger text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                    
                                </div>
                                <div class="my-2 col-span-3 text-center ">
                                    <button type="submit" class="bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-full py-2 px-10">Upload</button>
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






