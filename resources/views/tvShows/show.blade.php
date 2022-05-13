@extends('layouts.app')

@section('content')
<div class="container">
    {{-- @dump($tvshow) --}}
    {{-- tvshow info --}}
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-6 mt-3">
            @if (isset($tvshow['poster_path']))
                <img src="{{ $tvshow['poster_path'] }}" alt="poster" class="w-100 h-100 px-3">
            @else
                <img src="{{ asset('images/searchImagePlaceholder.png') }}" alt="poster" class="w-100 h-100 px-3">
            @endif
        </div>
        <div class="col-12 col-sm-12 col-lg-6 mt-3">
            <h1>{{ $tvshow['name'] }}</h1>
            {{-- <div class="text-uppercase d-block mt-2">John</div> --}}
            <div class="d-block">
                <i class="fas fa-star text-yellow"></i>レーティング
                <span class="ms-2">{{ $tvshow['vote_average'] }}</span>
            </div>
            <div class="d-block">
                公開日：
                {{ $tvshow['first_air_date'] }}
            </div>
            <div class="d-block">
                ジャンル：{{ $tvshow['genres'] }}
            </div>
            <div class="d-block">
                @if ($tvshow['overview'])
                    <h4 class="mt-4">概要</h4>
                    <p class="mt-1">
                        {{ $tvshow['overview'] }}
                        <span class="d-inline-block text-end w-100">
                            HP: <a href="{{ $tvshow['homepage'] }}" target="_blank">{{ $tvshow['homepage'] }}</a>
                        </span>
                    </p>
                @else
                    <h4 class="mt-4">詳細：
                        <a href="{{ $tvshow['homepage'] }}"  target="_blank">
                            @if(str_word_count($tvshow['homepage'])>10)
                            {{-- URLの最後の部分が長い大文字だと自動改行されない --}}
                            {{ $tvshow['name'] }}
                            @else
                            {{ $tvshow['homepage'] }}
                            @endif
                        </a>
                    </h4>
                @endif
            </div>
            <div class="d-block">
                <h4>主な撮影スタッフ</h4>
                <div class="row">
                    @foreach($tvshow['created_by'] as $crew)
                    <div class="col">
                        <div class="mt-1 fw-bold fs-6">
                            {{ $crew['name'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="d-block">
                <h4 class="mt-4">シーズン</h4>
                <div class="row">
                    @foreach($tvshow['seasons'] as $season)
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                        <div class="mt-1 fw-bold fs-6">
                            <a href="{{ route('tv.season', ['id'=>$tvshow['id'], 'sid'=>$season['season_number']]) }}" class="text-decoration-none">
                                <img class="card-img-top" src="{{ 'https://image.tmdb.org/t/p/w185/'.$season['poster_path'] }}" alt="poster" class="img-fluid">
                                <span class="text-white">{{ $season['name'] }}</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- @dump($tvshow['videos']) --}}
            @if (count($tvshow['videos']) == 1)
            <div class="my-5">
                {{-- <a href="https://youtube.com/watch?v={{ $tvshow['videos'][0]['key'] }}" class="col mx-1 mt-1 btn-orange rounded text-dark" target="_blank"><i class="fas fa-play-circle"></i> トレーラーを再生</a> --}}
                <button class="btn-orange text-dark" data-bs-toggle="modal" data-bs-target="#tvshow0"><i class="fas fa-play-circle"></i> トレーラーを再生</button>
            </div>
            @elseif(count($tvshow['videos']) > 1)
            <div class="row d-block mt-3">
                @for ($i=0;$i<count($tvshow['videos']);$i++)
                {{-- <a href="https://youtube.com/watch?v={{ $tvshow['videos'][$i]['key'] }}" class="col mx-1 mt-1 btn-orange rounded text-dark" target="_blank"><i class="fas fa-play-circle"></i> トレーラー{{ $i+1 }}</a> --}}
                <button class="col-5 mx-2 mt-1 btn-orange text-dark" data-bs-toggle="modal" data-bs-target="#tvshow{{$i}}"><i class="fas fa-play-circle"></i> トレーラー{{$i+1}}を再生</button>
                @endfor
            </div>
            @endif
    </div>
    </div>

    {{-- modal  --}}
    {{-- モーダルを閉じてもyoutubeの再生が続いてしまうのがまだ修正できていない。alpineで直そうとしたけど上手くいかなかった --}}
    @if (count($tvshow['videos']) > 0)
    @for ($i=0;$i<count($tvshow['videos']);$i++)
    <div class="modal fade bg-dark" id="tvshow{{$i}}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="ModalLabel">
                        {{ $tvshow['videos'][$i]['name'] }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://youtube.com/embed/{{ $tvshow['videos'][$i]['key'] }}" frameborder="0" width="560" height="315" class="position-absolute top-0 left-0 w-100 h-100" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endfor
    @endif
    {{-- modal --}}

    {{-- tvshow info --}}

    {{-- cast info --}}
    <div class="row my-5 border-top border-secondary">
        <h2 class="mt-3">主なキャスト</h2>
        @foreach($tvshow['cast'] as $cast)
        <div class="col-3 col-lg-2 mt-2">
            <a href="{{ route('actors.show', $cast['id']) }}" class="d-block">
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
        {{-- @dump($tvshow) --}}
        <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
            @if ($tvshow['images'] != null)
                <div class="carousel-indicators">
                    @foreach ($tvshow['images'] as $image)
                    @if ($loop->index == 0)
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="{{ $loop->index }}" class="active" aria-current="true" aria-label="Slide {{ $loop->index }}"></button>
                    @else
                        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="{{ $loop->index }}" aria-label="Slide {{ $loop->index }}"></button>
                    @endif
                    @endforeach
                </div>
                <div class="carousel-inner">
                @foreach ($tvshow['images'] as $image)
                    @if ($loop->index == 0)
                        <div class="carousel-item active">
                            <img src="{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}" class="d-block mx-auto w-75" alt="backdrop">
                        </div>
                    @else
                        <div class="carousel-item">
                            <img src="{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}" class="d-block mx-auto w-75" alt="backdrop">
                        </div>
                    @endif
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
            @else
                <img src="{{ 'https://image.tmdb.org/t/p/original/'.$tvshow['backdrop_path'] }}" class="d-block w-100" alt="backdrop">
            @endif
        </div>
    </div>
    {{-- image list --}}
</div>
@endsection
