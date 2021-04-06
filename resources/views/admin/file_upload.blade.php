<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href = {{ asset("bootstrap/css/bootstrap.css") }} rel="stylesheet" />

    <title>Document</title>
</head>
<body>
    <form action="{{ route('song.upload') }}" method="post" enctype="multipart/form-data">
    @csrf
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
</body>
</html>