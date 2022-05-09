@extends('layouts.app')

@section('content')
<div class="container w-75">
    <div class="row d-flex justify-content-center">
        <h1 class="text-uppercase text-orange fw-bolder mt-3">Popular Movies</h1>
    </div>
    <div class="row row-cols-lg-5 d-flex justify-content-center">
        @foreach($popularMovies as $popularMovie)
            <x-movie-card :movie="$popularMovie"/>
        @endforeach
    </div>

    <div class="row d-flex justify-content-center">
        <h1 class="text-uppercase text-orange fw-bolder mt-3">Now Playing</h1>
    </div>
    <div class="row row-cols-lg-5 d-flex justify-content-center">
        @foreach($nowPlayingMovies as $nowPlayingMovie)
            <x-movie-card :movie="$nowPlayingMovie"/>
        @endforeach
    </div>

</div>
@endsection
