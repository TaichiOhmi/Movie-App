<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $social;
    public $credits;

    public function __construct($actor, $social, $credits)
    {
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }

    public function actor()
    {
        // もし、今回選んだ俳優のIDがデータベースに登録されていればデータベースの翻訳文を取得し、なければ新たに翻訳する。
        //firstOrCreate()調べる

        // $responseName = Http::get(
        //     'https://api-free.deepl.com/v2/translate',
        //     // GETパラメータ
        //     [
        //         'auth_key' => config('services.deepl.auth_key'),
        //         'source_lang' => 'en',
        //         'target_lang' => 'ja',
        //         'text' => $this->actor['name'],
        //     ]
        // )->json('translations')[0]['text'];

        // $responsePlaceOfBirth = Http::get(
        //     'https://api-free.deepl.com/v2/translate',
        //     // GETパラメータ
        //     [
        //         'auth_key' => config('services.deepl.auth_key'),
        //         'source_lang' => 'en',
        //         'target_lang' => 'ja',
        //         'text' => $this->actor['place_of_birth'],
        //     ]
        // )->json('translations')[0]['text'];

        // $responseBio = Http::get(
        //     'https://api-free.deepl.com/v2/translate',
        //     // GETパラメータ
        //     [
        //         'auth_key' => config('services.deepl.auth_key'),
        //         'source_lang' => 'en',
        //         'target_lang' => 'ja',
        //         'text' => $this->actor['biography'],
        //     ]
        // )->json('translations')[0]['text'];




        return collect($this->actor)->merge([
            'birthday' => Carbon::parse($this->actor['birthday'])->format('Y年m月d日'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path']
                ? 'https://image.tmdb.org/t/p/original/'.$this->actor['profile_path']
                : 'https://via.placeholder.com/300x450',
        ]);
    }

    public function social()
    {
        return collect($this->social)->merge([
            'twitter' => $this->social['twitter_id'] ? 'https://twitter.com/'.$this->social['twitter_id'] : null,
            'facebook' => $this->social['facebook_id'] ? 'https://facebook.com/'.$this->social['facebook_id'] : null,
            'instagram' => $this->social['instagram_id'] ? 'https://instagram.com/'.$this->social['instagram_id'] : null,
        ]);
    }

    public function knownForTitles()
    {
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)->sortByDesc('popularity')->take(5)->map(function($title) {
            if (isset($title['title'])){
                $Title = $title['title'];
            }else if (isset($title['name'])){
                $Title = $title['name'];
            }else{
                $Title = 'Untitled';
            }

            return collect($title)->merge([
                'poster_path' => $title['poster_path']
                ? 'https://image.tmdb.org/t/p/w185'.$title['poster_path']
                : 'https://via.placeholder.com/185x278',
                'title' => $Title,
                'linkToPage' => $title['media_type'] == 'movie' ? route('movies.show', $title['id']) : route('tv.show', $title['id']),
            ])->only([
                'poster_path', 'title', 'id', 'media_type','linkToPage',
            ]);
        });
    }

    public function credits()
    {
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)->map(function($title) {

            if (isset($title['release_date'])){
                $releaseDate = $title['release_date'];
            }else if (isset($title['first_air_date'])){
                $releaseDate = $title['first_air_date'];
            }else{
                $releaseDate = '';
            }

            if (isset($title['title'])){
                $Title = $title['title'];
            }else if (isset($title['name'])){
                $Title = $title['name'];
            }else{
                $Title = 'Untitled';
            }

            return collect($title)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $Title,
                'character' => isset($title['character']) ? $title['character'] : '',
            ]);
            })->sortByDesc('release_date');
    }
}
