@extends('templates/template')
@section('title','Recognize face')
@section('css')
    <link rel="stylesheet" href="{{asset('css/recognizer.css')}}">
@endsection

@section('content')
    <form  enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <label for="image">Upload your image below</label>
            <input type="file" accept="image/*" onchange="loadImage(event)" class="form-control-file" id="image" name="image">
            <input type="submit" class="btn btn-primary" value="Check">
        </div>
    </form>

    <div id="photoContainer">

        <img id="targetImg" src="" alt="">
        <canvas id="detectionBox" />
    </div>

@endsection

@section('scripts')
    <script src="{{asset('js/recognizer.js')}}"></script>
@endsection