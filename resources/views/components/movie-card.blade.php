<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
<div class="col-12 col-sm-6 col-md-3 my-2">
    <a href="{{ route('movies.show', $movie['id']) }}" class="d-block">
        <img src="{{ $movie['poster_path'] }}" alt="poster" class="w-100 h-100">
    </a>
    <div class="text-uppercase d-block mt-2"><a href="{{ route('movies.show', $movie['id']) }}" class="text-white text-decoration-none">{{ $movie['title'] }}</a></div>
    <div class="d-block">
        <i class="fas fa-star text-yellow"></i><span class="ms-1">{{ $movie['vote_average'] }}</span>
        <span class="mx-1">|</span>{{ $movie['release_date'] }}
    </div>
    <div class="d-block">
        ジャンル：{{ $movie['genres'] }}
    </div>
</div>
