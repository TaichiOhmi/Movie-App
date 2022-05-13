<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
<div class="col-12 col-sm-6 col-md-3 my-2">
    <a href="{{ route('tv.show', $tvshow['id']) }}" class="d-block">
        <img src="{{ $tvshow['poster_path'] }}" alt="poster" class="w-100 h-100">
    </a>
    <div class="text-uppercase d-block mt-2"><a href="{{ route('tv.show', $tvshow['id']) }}" class="text-white text-decoration-none">{{ $tvshow['name'] }}</a></div>
    <div class="d-block">
        <i class="fas fa-star text-yellow"></i><span class="ms-1">{{ $tvshow['vote_average'] }}</span>
        <span class="mx-1">|</span>{{ $tvshow['first_air_date'] }}
    </div>
    <div class="d-block">
        ジャンル：{{ $tvshow['genres'] }}
    </div>
</div>
