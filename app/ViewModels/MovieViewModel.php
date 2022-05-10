<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public $images;

    public function __construct($movie, $images)
    {
        $this->movie = $movie;
        $this->images = $images;
    }

    public function movie()
    {
        return collect($this->movie)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('Y年m月d日'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(5),
            'cast' => collect($this->movie['credits']['cast'])->take(12),
            'images' => collect($this->images['images']['backdrops']),
        ])->only([
            'poster_path', 'id', 'credits', 'title', 'vote_average', 'overview', 'release_date', 'genres', 'videos', 'backdrop_path', 'crew', 'cast', 'homepage', 'images',
        ]);
    }
}
