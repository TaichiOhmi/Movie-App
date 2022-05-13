<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvshow;
    public $tvshowEn;

    public function __construct($tvshow, $tvshowEn)
    {
        $this->tvshow = $tvshow;
        $this->tvshowEn = $tvshowEn;
    }

    public function tvshow()
    {
        // dump($this->tvshowEn);
        // dump($this->tvshow);

        if($this->tvshow['overview'] == ""){
            $overview = $this->tvshowEn['overview'];
        }else{
            $overview = $this->tvshow['overview'];
        }

        if($this->tvshow['videos']['results'] == []){
            $videos = $this->tvshowEn['videos']['results'];
        }else{
            $videos = $this->tvshow['videos']['results'];
        }

        return collect($this->tvshow)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/original/'.$this->tvshow['poster_path'],
            'vote_average' => $this->tvshow['vote_average'] * 10 . '%',
            'first_air_date' => Carbon::parse($this->tvshow['first_air_date'])->format('Y年m月d日'),
            'genres' => collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->tvshow['credits']['crew'])->take(5),
            'cast' => collect($this->tvshow['credits']['cast'])->take(12),
            'images' => collect($this->tvshowEn['images']['backdrops']),
            'overview' => $overview,
            'videos' => $videos,
        ])->only([
            'poster_path', 'id', 'credits', 'name', 'vote_average', 'overview', 'first_air_date', 'genres', 'videos', 'backdrop_path', 'seasons', 'cast', 'homepage', 'images','created_by',
        ]);
    }
}
