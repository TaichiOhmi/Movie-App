<!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
<div class="col-12 col-sm-6 col-md-3 my-2">
    <a href="{{ route('movies.show', $movie['id']) }}" class="d-block">
        <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" alt="poster" class="w-100 h-100">
    </a>
    <div class="text-uppercase d-block mt-2"><a href="{{ route('movies.show', $movie['id']) }}" class="text-white text-decoration-none">{{ $movie['title'] }}</a></div>
    <div class="d-block">
        <i class="fas fa-star text-yellow"></i><span class="ms-1">{{ $movie['vote_average'] * 10}}%</span>
        <span class="mx-1">|</span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('Y年m月d日') }}
    </div>
    <div class="d-block">ジャンル：@foreach($movie['genre_ids'] as $genre_id){{ $genres->get($genre_id) }}@if(!$loop->last),@endif @endforeach
    </div>
</div>