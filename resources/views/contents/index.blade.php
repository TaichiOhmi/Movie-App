@extends('layouts.app')

@section('content')
<div class="container w-75">
    <div class="row d-flex justify-content-center">
        <h2 class="text-uppercase text-orange fw-bolder">Popular Movies</h2>
    </div>
    <div class="row my-2 d-flex justify-content-center">
        @for($i=0;$i<12;$i++)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 my-2">
            <a href="#" class="d-block">
                <img src="{{ asset('images/john.jpeg') }}" alt="poster" class="w-100">
            </a>
            <div class="text-uppercase d-block mt-2">John</div>
            <div class="d-block">
                <i class="fas fa-star text-yellow"></i><span class="ms-2">85%</span>
                <span class="mx-2">|</span>Feb 20, 2020
            </div>
            <div class="d-block">Category, Cotegory, Category</div>
        </div>
        @endfor
    </div>
        
    <div class="row justify-content-center">
        <h2 class="text-uppercase text-orange fw-bolder">Now Playing</h2>
    </div>
    <div class="row my-2 d-flex justify-content-center">
        @for($i=0;$i<12;$i++)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 my-2">
            <a href="#" class="d-block">
                <img src="{{ asset('images/daenerys.jpeg') }}" alt="poster" class="w-100">
            </a>
            <div class="text-uppercase d-block mt-2">John</div>
            <div class="d-block">
                <i class="fas fa-star text-yellow"></i><span class="ms-2">85%</span>
                <span class="mx-2">|</span>Feb 20, 2020
            </div>
            <div class="d-block">Category, Cotegory, Category</div>
        </div>
        @endfor
    </div>

</div>
@endsection
