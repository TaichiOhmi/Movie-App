<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/popular?language=ja-JP&region=JP')
        ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/now_playing?language=ja-JP&region=JP')
        ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list?language=ja-JP&region=JP')
        ->json()['genres'];

        // $genres = collect($genresArray)->mapWithKeys(function ($genre) {
        //     return [$genre['id'] => $genre['name']];
        // });

        // dump($popularMovies);
        // dump($nowPlayingMovies);
        // dump($genresArray);
        // dump($genres);

        // return view('movies.index')
        //     ->with('popularMovies', $popularMovies)
        //     ->with('nowPlayingMovies', $nowPlayingMovies)
        //     ->with('genres',$genres);

        // return view('movie.index', [
        //     'popularMovies' => $popularMovies,
        //     'nowPlayingMovies', $nowPlayingMovies,
        //     'genres',$genres,
        // ]);

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres,
        );

        return view('movies.index', $viewModel);
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
        $movie = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$id.'?language=ja-JP&region=JP&append_to_response=credits,videos,images')
        ->json();

        $images = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
        ->json();

        $viewModel = new MovieViewModel($movie, $images);

        // return view('movies.show')->with('movie', $movie);
        return view('movies.show', $viewModel);
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
