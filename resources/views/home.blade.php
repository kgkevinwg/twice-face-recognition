@extends('templates/template')
@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    @endsection
@section('title','Twice Facial Recognition')

@section('content')

    <div id="title"><h1>Facial Recognition for Twice Idol Group using face-api.js</h1></div>
    <div id="content">
        <div class="sub"><b>Past Predictions</b></div>
        <div class="listWrapper">
            <div class="list">
                <ul>
                    <li><a href="">Nayeon (나연)</a></li>
                    <li><a href="">Jeongyeon (정연)</a></li>
                    <li><a href="">Momo (모모)</a></li>
                    <li><a href="">Sana (사나)</a></li>
                    <li><a href="">Jihyo (지효)</a></li>
                    <li><a href="">Mina (미나)</a></li>
                    <li><a href="">Dahyun (다현)</a></li>
                    <li><a href="">Chaeyoung (채영)</a></li>
                    <li><a href="">Tzuyu (쯔위)</a></li>
                </ul>
            </div>
        </div>

    </div>



    @endsection


@section('scripts')
    <script src="{{asset('js/home.js')}}"></script>
    @endsection
