@extends('layouts.app')

@section('content')
<div class="container">
    {{-- movie info --}}
    <div class="row mt-5">
        <div class="col-12 col-sm-12 col-md-5 mb-3">
            <img src="{{ asset('images/john.jpeg') }}" alt="poster" class="w-100 h-100 px-3">
        </div>
        <div class="col">
            <h1>John Snow</h1>
            {{-- <div class="text-uppercase d-block mt-2">John</div> --}}
            <div class="d-block">
                <i class="fas fa-star text-yellow"></i><span class="ms-2">85%</span>
                <span class="mx-2">|</span>
                Feb 20, 2020
                <span class="mx-2">|</span>
                Category, Cotegory, Category
            </div>
            <h4 class="mt-4">概要</h4>
            <p class="mt-1">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime adipisci voluptates ipsa. Sed facilis quos optio sequi, totam atque perspiciatis autem tempora eligendi corrupti est architecto nesciunt ea deserunt in?
            </p>
            <div class="row">
                <h4 class="mt-4">注目のキャスト</h4>
                <div class="col">
                    <div class="mt-2 fw-bold fs-6">
                        Genndy Tartakovsky
                    </div>
                    <span class="text-muted">
                        Screenplay, Story
                    </span>
                </div>
                <div class="col">
                    <div class="mt-2 fw-bold fs-6">
                        Jennifer Kluska
                    </div>
                    <span class="text-muted">
                        Director
                    </span>
                </div>
                <div class="col">
                    <div class="mt-2 fw-bold fs-6">
                        Derek Drymon
                    </div>
                    <span class="text-muted">
                        Director
                    </span>
                </div>
            </div>
            <button type="" class="mt-4 btn-orange rounded text-dark"><i class="fas fa-play-circle"></i> トレーラーを再生</button>
        </div>
    </div>
    {{-- movie info --}}
    {{-- cast info --}}
    <div class="row mt-5 border-top border-secondary">
        <h2 class="mt-3">キャスト一覧</h2>
        @for($i=0;$i<5;$i++)
        <div class="col-6 col-sm my-2">
            <a href="#" class="d-block">
                <img src="{{ asset('images/john.jpeg') }}" alt="poster" class="w-100">
            </a>
            <div class="text-uppercase d-block mt-2">ピエトロ ロンバルディ</div>
            <div class="d-block text-muted">
                近江太一
            </div>
        </div>
        @endfor
    </div>
    {{-- cast info --}}
    {{-- image list --}}
    <div class="row mt-5 border-top border-secondary">
        <h2 class="mt-3">メディア</h2>
        @for($i=0;$i<5;$i++)
        <div class="col-6 col-sm my-2">
            <a href="#" class="d-block">
                <img src="{{ asset('images/arya.jpeg') }}" alt="poster" class="w-100">
            </a>
        </div>
        @endfor
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
