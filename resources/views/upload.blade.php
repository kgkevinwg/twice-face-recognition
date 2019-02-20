@extends('templates/template')
@section('title','Upload Model')
@section('css')
    <link rel="stylesheet" href="{{asset('css/upload.css')}}">
    @endsection

@section('content')
    <form enctype="multipart/form-data">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="name">Model's Name (unique)</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">

        </div>
        <div class="form-group">
            <label for="image">Example file input</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="key">Insert Key</label>
            <input type="password" class="form-control" id="key" name="key" placeholder="Ask site administrator">
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>

    <div>
        <div class="alert alert-danger" id="errorContainer">
            <ul class="errors">

            </ul>
        </div>

    </div>

    <div>
        <div class="alert alert-primary" id="noticeContainer">
            <ul class="notices">

            </ul>
        </div>

    </div>

    <div id="test-descriptor">

    </div>

    <div id="photoContainer">

    </div>




    @endsection

@section('scripts')
    <script src="{{asset('js/upload.js')}}"></script>
    @endsection