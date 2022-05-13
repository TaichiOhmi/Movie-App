<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowSeasonsViewModel;
use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvShowsViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularTv = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/popular?language=ja-JP&region=JP')
        ->json()['results'];

        $topRatedTv = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/top_rated?language=ja-JP&region=JP')
        ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/tv/list?language=ja-JP&region=JP')
        ->json()['genres'];

        $viewModel = new TvShowsViewModel(
            $popularTv,
            $topRatedTv,
            $genres,
        );

        return view('tvShows.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tvshow = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$id.'?language=ja-JP&region=JP&append_to_response=credits,videos,images')
        ->json();

        $tvshowEn = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$id.'?append_to_response=credits,videos,images')
        ->json();

        $viewModel = new TvShowViewModel($tvshow, $tvshowEn);

        // return view('movies.show')->with('movie', $movie);
        return view('tvShows.show', $viewModel);
    }

    public function season($id, $sid){
        $seasons = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$id.'/season/'.$sid.'?language=ja&region=JP&append_to_response=credits,videos,images')
        ->json();

        $seasonsEn = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$id.'/season/'.$sid.'?append_to_response=credits,videos,images')
        ->json();

        $tvshow = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/'.$id.'?language=ja-JP&region=JP&append_to_response=credits,videos,images')
        ->json();

        $viewModel = new TvShowSeasonsViewModel($seasons, $seasonsEn, $tvshow);

        return view('tvShows.season', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
