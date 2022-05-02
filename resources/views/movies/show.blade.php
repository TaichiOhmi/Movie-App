@extends('layouts.app')

@section('content')
<div class="container">
    {{-- movie info --}}
    <div class="row mt-3">
        <div class="col-12 col-sm-12 col-lg-6 mb-3">
            <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" alt="poster" class="w-100 h-100 px-3">
        </div>
        <div class="col">
            <h1>{{ $movie['title'] }}</h1>
            {{-- <div class="text-uppercase d-block mt-2">John</div> --}}
            <div class="d-block">
                <i class="fas fa-star text-yellow"></i>レーティング
                <span class="ms-2">{{ $movie['vote_average'] * 10}}%</span>
            </div>
            <div class="d-block">
                公開日：
                {{ \Carbon\Carbon::parse($movie['release_date'])->format('Y年m月d日') }}
            </div>
            <div class="d-block">
                ジャンル：
                @foreach($movie['genres'] as $genre)
                    {{ $genre['name'] }} @if (!$loop->last),@endif
                @endforeach
            </div>
            @if ($movie['overview'])
                <h4 class="mt-4">概要</h4>
                <p class="mt-1">
                    {{ $movie['overview'] }}
                    <span class="float-end">
                        HP: <a href="{{ $movie['homepage'] }}">{{ $movie['homepage'] }}</a>
                    </span>
                </p>
            @else
                <h4 class="mt-4">詳細：<a href="{{ $movie['homepage'] }}">{{ $movie['homepage'] }}</a></h4>
                
            @endif
            <h4 class="mt-4">主な撮影スタッフ</h4>
            <div class="row">
                @foreach($movie['credits']['crew'] as $crew)
                @if($loop->index < 5)
                <div class="col">
                    <div class="mt-2 fw-bold fs-6">
                        {{ $crew['name'] }}
                    </div>
                    <span class="text-muted">
                        {{ $crew['job'] }}
                    </span>
                </div>
                @endif
                @endforeach
            </div>
            @if (count($movie['videos']['results']) == 1)
            <div class="mt-3">
                <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}" class="col mx-1 mt-1 btn-orange rounded text-dark" target="_blank"><i class="fas fa-play-circle"></i> トレーラーを再生</a>
            </div>
            @elseif(count($movie['videos']['results']) > 1)
            <div class="row mt-3">
                @for ($i=0;$i<count($movie['videos']['results']);$i++)
                <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][$i]['key'] }}" class="col mx-1 mt-1 btn-orange rounded text-dark" target="_blank"><i class="fas fa-play-circle"></i> トレーラー{{ $i+1 }}</a>
                @endfor
            </div>
            @endif
        </div>
    </div>
    {{-- movie info --}}
    {{-- cast info --}}
    <div class="row my-5 border-top border-secondary">
        <h2 class="mt-3">主なキャスト</h2>
        @foreach($movie['credits']['cast'] as $cast)
        @if($loop->index < 12)
        <div class="col-3 col-lg-2 mt-2">
            <a href="#" class="d-block">
                @if ($cast['profile_path'] == null)
                <img src="{{ asset('images/user.png') }}" alt="actor" class="w-100 my-4 py-1">
                @else
                <img src="{{ 'https://image.tmdb.org/t/p/w300/'.$cast['profile_path'] }}" alt="actor" class="w-100">
                @endif
            </a>
            <div class="text-uppercase d-block mt-2">{{ $cast['name'] }}</div>
            <div class="d-block text-muted">
                {{ $cast['character'] }}
            </div>
        </div>
        @endif
        @endforeach
    </div>
    {{-- cast info --}}
    {{-- image list --}}
    @if(count($movie['images']['backdrops']) > 0)
    <div class="row border-top border-secondary">
        <h2 class="mt-3">メディア</h2>
        @foreach($movie['images']['backdrops'] as $images)
        <div class="col-6 col-sm my-2">
            <a href="#" class="d-block">
                <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$images['file_path'] }}" alt="poster" class="w-100">
            </a>
        </div>
        @endforeach
    @endif
        {{-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @for($i=0;$i<5;$i++)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}" class="active" aria-current="true" aria-label="Slide {{$i}}"></button>
                @endfor
            </div>
            <div class="carousel-inner">
                @for($i=0;$i<5;$i++)
                <div class="carousel-item active">
                  <img src="{{ asset('images/arya.jpeg') }}" class="d-block h-50" alt="">
                </div>
                @endfor
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div> --}}
    </div>
    {{-- image list --}}
</div>
@endsection
