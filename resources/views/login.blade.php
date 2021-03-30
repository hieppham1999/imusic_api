<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Login Page</h1>
    <form action="{{ route('auth.check') }}" method="post">
        @csrf
        <div class="result">
            @if(Session::get('fail'))
                <div>{{ Session::get('fail')}}</div>
            @endif
        </div>
        <div>
            <label>Email</label> <br>
            <input type="text" name="email" id="" placeholder="Enter email here..." value="{{ old('email') }}"> <br> <br>  
            <span class="warning-text">@error('email') {{ $message }} @enderror</span>
        </div>
        <br> 
        <div>
            <label>Password</label> <br> 
            <input type="password" name="password" id="" placeholder="password"> <br> <br> 
            <span class="warning-text">@error('password') {{ $message }} @enderror</span> <br>
        </div>
        <br> 
        <div>
            <button type="submit">Login</button>
        </div>

        
    </form>
</body>
</html>