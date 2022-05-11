@extends('layouts.app')

@section('content')
<div class="container w-75">
    <div class="row d-flex justify-content-center">
        <h1 class="text-uppercase text-orange fw-bolder mt-3">Popular Actors</h1>
    </div>
    <div class="row row-cols-xs-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 d-flex justify-content-center grid">
        @foreach($popularActors as $actor)
        <div class="pb-3 actor">
            <div class="card border-0 w-100 h-100">
                <a href="{{ route('actors.show', $actor['id']) }}">
                    <img src="{{ $actor['profile_path'] }}" class="card-img-top" alt="avator">
                </a>
                <div class="card-body text-dark">
                    <a href="{{ route('actors.show', $actor['id']) }}" class=" text-decoration-none text-dark">
                        <h5 class="card-title fw-bolder">{{$actor['name']}}</h5>
                    </a>
                    <p class="card-text">{{ $actor['known_for'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="page-load-status my-5">
        <p class="infinite-scroll-request spinner-grow mx-auto" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </p>
        <p class="infinite-scroll-last">End of content</p>
        <p class="infinite-scroll-error">Error</p>
    </div>
    {{-- <div class="d-flex">

        @if ($previous)
            <a href="/actors/page/{{ $previous }}" class="text-decoration-none text-muted me-auto">前</a>
        @endif
        @if ($next)
            <a href="/actors/page/{{ $next }}" class="text-decoration-none text-muted ms-auto">次</a>
        @endif
    </div> --}}
</div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll( elem, {
            path: "/actors/page/@{{#}}",
            append: '.actor',
            status: '.page-load-status',
            // history: false,
        });
    </script>
@endsection
