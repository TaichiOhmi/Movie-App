@extends('layouts.app')

@section('content')
<div class="container w-75">
    <div class="row d-flex justify-content-center">
        <h1 class="text-uppercase text-orange fw-bolder mt-3">{{ $season['showTitle'] }}</h1>
        <div class="d-block text-end">
            <a class="text-white" type="button" data-bs-toggle="collapse" data-bs-target="#showDetail" aria-expanded="false" aria-controls="showDetail">
                概要を見る</a>
            <a class="text-white" type="button" data-bs-toggle="modal" data-bs-target="#showPoster" aria-expanded="false" aria-controls="showPoster">
                ポスターを表示
            </a>
            <a href="{{ route('tv.show', $tvshow['id']) }}" class="text-white">
                {{ $tvshow['name'] }}
            </a>
        </div>
        <div class="collapse" id="showDetail">
            <p class="mt-1">
                {{ $season['overview'] }}
            </p>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="showPoster" tabindex="-1" aria-labelledby="showPoster" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    @if (isset($season['poster_path']))
                        <img src="{{ $season['poster_path'] }}" alt="poster" class="img-fluid img-thumbnail">
                    @else
                        <img src="{{ asset('images/searchImagePlaceholder.png') }}" alt="poster" class="img-fluid img-thumbnail">
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
    <ul class="list-group">
        @foreach($season['episodes'] as $episode)
        <li class="list-group-item">
            @if (Carbon\Carbon::now()->format('Y年m月d日') < $episode['air_date'])
                <div class="row">
                    <h5>
                        {{ $episode['name'] }}
                    </h5>
                    <div class="text-end">
                        {{ $episode['air_date'] }}
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <h5>
                            {{ $episode['name'] }}
                        </h5>
                        <div class="col">
                            <i class="fas fa-star text-yellow"></i>
                            <span class="">{{ $episode['vote_average'] }}</span>
                        </div>
                        <div class="col text-end">
                            {{ $episode['air_date'] }}
                        </div>
                    </div>
                    @if (isset($episode[('runtime')]))
                    <div class="row">
                        <div class="text-end">
                            {{ $episode[('runtime')] }}
                        </div>
                    </div>
                    @endif
                </div>
                @if ($episode['still_path'] != null)
                <div class="col">
                    <img src="{{ $episode['still_path'] }}" alt="still" class="img-fluid img-thumbnail">
                </div>
                @endif
            </div>
            <a class="text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#episodeDetail{{$episode['episode_number']}}" aria-expanded="false" aria-controls="episodeDetail">
                もっと見る
            </a>


            <div class="collapse" id="episodeDetail{{$episode['episode_number']}}">
                <div class="card card-body">
                    <h4>概要</h4>
                    {{ $episode['overview'] }}
                    @if ($episode['crew'] != [])
                    <h4 class="mt-2">
                        スタッフ
                    </h4>
                    @foreach ($episode['crew'] as $crew)
                    <div class="col">
                        {{ $crew['name'] }}
                        <span class="text-muted">
                            {{ $crew['job'] }}
                        </span>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            @endif
        </li>
        @endforeach
    </ul>

</div>
@endsection
