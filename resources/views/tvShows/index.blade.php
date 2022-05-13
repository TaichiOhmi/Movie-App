@extends('layouts.app')

@section('content')
<div class="container w-75">
    <div class="row d-flex justify-content-center">
        <h1 class="text-uppercase text-orange fw-bolder mt-3">Popular Shows</h1>
    </div>
    <div class="row row-cols-lg-5 d-flex justify-content-center">
        @foreach($popularTv as $tvshow)
            <x-tv-card :tvshow="$tvshow"/>
        @endforeach
    </div>

    <div class="row d-flex justify-content-center">
        <h1 class="text-uppercase text-orange fw-bolder mt-3">Top Rated Shows</h1>
    </div>
    <div class="row row-cols-lg-5 d-flex justify-content-center">
        @foreach($topRatedTv as $tvshow)
            <x-tv-card :tvshow="$tvshow"/>
        @endforeach
    </div>

</div>
@endsection
