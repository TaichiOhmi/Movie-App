@extends('layouts.app')

@section('content')
<div class="container">
    {{-- movie info --}}
    <div class="row">
        <div class="col-sm-12 col-md-4 mt-3 p-3 pt-0">
            <img src="{{ $actor['profile_path'] }}" alt="poster" class="w-100 d-block mx-auto">
            <div class="d-flex justify-content-start mt-1">
                <ul class="list-unstyled list-inline">
                    @if ($actor['homepage'] != null)
                        <li class="list-inline-item">
                            <a href="{{ $actor['homepage'] }}" title="Homepage"><i class="fas fa-home text-white nav-icon"></i></a>
                        </li>
                    @endif
                    @if ($social['facebook'] != null)
                        <li class="list-inline-item">
                            <a href="{{ $social['facebook'] }}" title="Facebook"><i class="fab fa-facebook text-white nav-icon"></i></a>
                        </li>
                    @endif
                    @if ($social['instagram'] != null)
                        <li class="list-inline-item">
                            <a href="{{ $social['instagram'] }}" title="Instagram"><i class="fab fa-instagram text-white nav-icon"></i></a>
                        </li>
                    @endif
                    @if ($social['twitter'] != null)
                        <li class="list-inline-item">
                            <a href="{{ $social['twitter'] }}" title="Twitter"><i class="fab fa-twitter text-white nav-icon"></i></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 mt-3">
            <h1>{{ $actor['name'] }}</h1>
            <div class="d-block">
                <i class="fas fa-birthday-cake me-2"></i>{{$actor['birthday']}}({{$actor['age']}}歳)<span class="ms-2">{{ $actor['place_of_birth'] }}</span>
            </div>
            {{-- <div class="d-block">
                もっと見る
            </div> --}}
            <div class="d-block">
                <h4 class="mt-3">経歴</h4>
                <p>
                    @if (strlen($actor['biography']) > 0)
                        {{ $actor['biography'] }}
                    @else
                        経歴は追加されていません。
                    @endif
                </p>
            </div>
            <div class="d-block">
                <h4 class="mt-3">出演</h4>
                <div class="row row-cols-5 flex-nowrap">
                    @foreach( $knownForTitles as $title)
                    <div class="col">
                        <a href="{{ $title['linkToPage'] }}" class="text-decoration-none text-white">
                            <img class="card-img-top" src="{{ $title['poster_path'] }}" alt="poster" class="img-fluid">
                            {{ $title['title'] }}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- movie info --}}

    {{-- credits info --}}
    <div class="row my-5 border-top border-secondary">
        <h2 class="mt-3">クレジット</h2>
        <ul class="list-group bg-dark">
            @foreach ($credits as $credit)
                <li class="list-group-item list-group-item-dark">
                    {{ $credit['release_year'] }} &middot; <strong>{{ $credit['title'] }}</strong>
                    @if ($credit['character'])
                     as {{ $credit['character'] }}
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    {{-- credits info --}}
</div>
@endsection
