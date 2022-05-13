<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowSeasonsViewModel extends ViewModel
{
    public $seasons;
    public $seasonsEn;
    public $tvshow;

    public function __construct($seasons, $seasonsEn, $tvshow)
    {
        $this->seasons = $seasons;
        $this->seasonsEn = $seasonsEn;
        $this->tvshow = $tvshow;
    }

    public function season()
    {
        // dump($this->seasons);
        // dump($this->seasonszEn);
        // dump($this->tvshow);

        if($this->seasons['overview'] == ""){
            $overview = $this->seasonsEn['overview'];
        }else{
            $overview = $this->seasons['overview'];
        }

        if($this->seasons['images']['posters'] == []){
            $images = $this->seasonsEn['images']['posters'];
        }else{
            $images = $this->seasons['images']['posters'];
        }

        for($i=0;$i<count($this->seasons['episodes']);$i++){
            $this->seasons['episodes'][$i]['air_date'] = Carbon::parse($this->seasons['episodes'][$i]['air_date'])->format('Y年m月d日');
            if($this->tvshow['original_language'] == 'en'){
                $this->seasons['episodes'][$i]['name'] = '第'.str($i+1).'話 '.$this->seasonsEn['episodes'][$i]['name'];
            }else{
                $this->seasons['episodes'][$i]['name'] = '第'.str($i+1).'話 '.$this->seasons['episodes'][$i]['name'];
            }
            $this->seasons['episodes'][$i]['vote_average'] = round($this->seasons['episodes'][$i]['vote_average'] * 10) . '%';
            if(isset($this->seasons['episodes'][$i]['runtime'])){
                $this->seasons['episodes'][$i]['runtime'] = $this->seasons['episodes'][$i]['runtime'].'分';
            }
            if ($this->seasons['episodes'][$i]['still_path'] != null){
                $this->seasons['episodes'][$i]['still_path'] = 'https://image.tmdb.org/t/p/w500/'.$this->seasons['episodes'][$i]['still_path'];
            }
            if($this->seasons['episodes'][$i]['overview'] == ""){
                $this->seasons['episodes'][$i]['overview'] = $this->seasonsEn['episodes'][$i]['overview'];
            }
        }

        return collect($this->seasons)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->seasons['poster_path'],
            'air_date' => Carbon::parse($this->seasons['air_date'])->format('Y年m月d日'),
            'cast' => collect($this->seasons['credits']['cast'])->take(12),
            'overview' => $overview,
            'images' => $images,
            'showTitle' => $this->tvshow['name'].' '.$this->seasons['name'],
        ])->only([
            'air_date', 'episodes', 'name', 'overview', 'id', 'poster_path', 'season_number', 'credits', 'images', 'cast', 'crew','showTitle',
        ]);
    }

    public function tv()
    {
        return collect($this->tvshow);
    }
}
