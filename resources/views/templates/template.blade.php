<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" content="{{csrf_token()}}">

    @yield('css')
    <title>@yield('title')</title>
</head>
<body>
<script src="{{asset('js/jquery-min.js')}}"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{url('/')}}">Huehehehehe</a>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/upload')}}">Upload Model <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/recognizer')}}">Recognize image</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Past Predictions
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Nayeon (나연)</a>
                    <a class="dropdown-item" href="#">Jeongyeon (정연)</a>
                    <a class="dropdown-item" href="#">Momo (모모)</a>
                    <a class="dropdown-item" href="#">Sana (사나)</a>
                    <a class="dropdown-item" href="#">Jihyo (지효)</a>
                    <a class="dropdown-item" href="#">Mina (미나)</a>
                    <a class="dropdown-item" href="#">Dahyun (다현)</a>
                    <a class="dropdown-item" href="#">Chaeyoung (채영)</a>
                    <a class="dropdown-item" href="#">Tzuyu (쯔위)</a>
                </div>
            </li>
        </ul>

    </div>
</nav>
    <div class="container">
        @yield('content')
    </div>


<script src="{{asset('js/face-api.js')}}"></script>
@yield('scripts')
</body>
</html>