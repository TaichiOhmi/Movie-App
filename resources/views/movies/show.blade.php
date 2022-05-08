@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @dump($movie) --}}
    {{-- movie info --}}
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-6 mt-3">
            @if (isset($movie['poster_path']))
                <img src="{{ $movie['poster_path'] }}" alt="poster" class="w-100 h-100 px-3">
            @else
                <img src="{{ asset('images/searchImagePlaceholder.png') }}" alt="poster" class="w-100 h-100 px-3">
            @endif
        </div>
        <div class="col-12 col-sm-12 col-lg-6 mt-3">
            <h1>{{ $movie['title'] }}</h1>
            {{-- <div class="text-uppercase d-block mt-2">John</div> --}}
            <div class="d-block">
                <i class="fas fa-star text-yellow"></i>レーティング
                <span class="ms-2">{{ $movie['vote_average'] }}</span>
            </div>
            <div class="d-block">
                公開日：
                {{ $movie['release_date'] }}
            </div>
            <div class="d-block">
                ジャンル：{{ $movie['genres'] }}
            </div>
            <div class="d-block">
                @if ($movie['overview'])
                    <h4 class="mt-4">概要</h4>
                    <p class="mt-1">
                        {{ $movie['overview'] }}
                        <span class="float-end w-100">
                            HP: <a href="{{ $movie['homepage'] }}" target="_blank">{{ $movie['homepage'] }}</a>
                        </span>
                    </p>
                @else
                    <h4 class="mt-4">詳細：
                        <a href="{{ $movie['homepage'] }}"  target="_blank">
                            @if(str_word_count($movie['homepage'])>10)
                            {{-- URLの最後の部分が長い大文字だと自動改行されない --}}
                            {{ $movie['title'] }}
                            @else
                            {{ $movie['homepage'] }}
                            @endif
                        </a>
                    </h4>
                @endif
            </div>
            <div class="d-block mt-5">
                <h4>主な撮影スタッフ</h4>
                <div class="row">
                    @foreach($movie['crew'] as $crew)
                    <div class="col">
                        <div class="mt-1 fw-bold fs-6">
                            {{ $crew['name'] }}
                        </div>
                        <span class="text-muted">
                            {{ $crew['job'] }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- @dump($movie['videos']['results']) --}}
            @if (count($movie['videos']['results']) == 1)
            <div class="my-3">
                {{-- <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}" class="col mx-1 mt-1 btn-orange rounded text-dark" target="_blank"><i class="fas fa-play-circle"></i> トレーラーを再生</a> --}}
                <button class="btn-orange text-dark" data-bs-toggle="modal" data-bs-target="#movie0"><i class="fas fa-play-circle"></i> トレーラーを再生</button>
            </div>
            @elseif(count($movie['videos']['results']) > 1)
            <div class="row">
                @for ($i=0;$i<count($movie['videos']['results']);$i++)
                {{-- <a href="https://youtube.com/watch?v={{ $movie['videos']['results'][$i]['key'] }}" class="col mx-1 mt-1 btn-orange rounded text-dark" target="_blank"><i class="fas fa-play-circle"></i> トレーラー{{ $i+1 }}</a> --}}
                <button class="col-5 mx-2 mt-1 btn-orange text-dark" data-bs-toggle="modal" data-bs-target="#movie{{$i}}"><i class="fas fa-play-circle"></i> トレーラー{{$i+1}}を再生</button>
                @endfor
            </div>
            @endif
        </div>
    </div>

    {{-- modal  --}}
    {{-- モーダルを閉じてもyoutubeの再生が続いてしまうのがまだ修正できていない。alpineで直そうとしたけど上手くいかなかった --}}
    @if (count($movie['videos']['results']) > 0)
    @for ($i=0;$i<count($movie['videos']['results']);$i++)
    <div class="modal fade bg-dark" id="movie{{$i}}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="ModalLabel">
                        {{ $movie['videos']['results'][$i]['name'] }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://youtube.com/embed/{{ $movie['videos']['results'][$i]['key'] }}" frameborder="0" width="560" height="315" class="position-absolute top-0 left-0 w-100 h-100" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endfor
    @endif
    {{-- modal --}}

    {{-- movie info --}}

    {{-- cast info --}}
    <div class="row my-5 border-top border-secondary">
        <h2 class="mt-3">主なキャスト</h2>
        @foreach($movie['cast'] as $cast)
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
        @endforeach
    </div>
    {{-- cast info --}}

    {{-- image list --}}
    <div class="row border-top border-secondary">
        <h2 class="mt-3">メディア</h2>
        {{-- @dump($movie) --}}
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            @if ($movie['belongs_to_collection'] != null)
                <div class="carousel-item active">
                    <img src="{{ 'https://image.tmdb.org/t/p/original/'.$movie['belongs_to_collection']['backdrop_path'] }}" class="d-block w-100" alt="backdrop">
                </div>
                <div class="carousel-item">
                    <img src="{{ 'https://image.tmdb.org/t/p/original/'.$movie['backdrop_path'] }}" class="d-block w-100" alt="backdrop">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
            @else
                <img src="{{ 'https://image.tmdb.org/t/p/original/'.$movie['backdrop_path'] }}" class="d-block w-100" alt="backdrop">
            @endif
        </div>
    </div>
    {{-- image list --}}
</div>
@endsection
