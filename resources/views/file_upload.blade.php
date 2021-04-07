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
                    <form action="{{ route('song.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Artist</label>
                                <input type="text" class="form-control" name="artist_name" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Album</label>
                                <input type="text" class="form-control" name="album" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Release Date</label>
                                <input type="text" class="form-control" name="release_date" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Language</label>
                                <input type="text" class="form-control" name="language" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Genre</label>
                                <input type="text" class="form-control" name="genre" id="exampleFormControlInput1" placeholder="">
                            </div>
                    
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Select mp3 file</label>
                                <input class="form-control" type="file" id="formFile" name="_file">
                            </div>
                    
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>






