<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;

class ViewMoviesTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular?language=ja-JP' => $this->fakePopularMovie(),
            'https://api.themoviedb.org/3/movie/now_playing?language=ja-JP' => $this->fakeNowPlayingMovie(),
            'https://api.themoviedb.org/3/genre/movie/list?language=ja-JP' => $this->fakeGenres(),
        ]);
        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('フェイクムービー');
        // $html = $response->getContent();
        // $$this->assertEquals(1, preg_match('/サイエンスフィクション, *アクション, *アドベンチャー/', $html), 'Genres not found');
        $response->assertSee('サイエンスフィクション, アクション, アドベンチャー');
        $response->assertSee('Now Playing');
        $response->assertSee('フェイクナウプレイングムービー');
    }

    public function the_movie_page_shows_the_correct_info(){
        Http::fake([
            'https://api.themoviedb.org/3/movie/*/?language=ja-JP' => $this->fakeSingleMovie(),
        ]);

        $response = $this->get(route('movies.show', 12345));
        $response->assertSee('フェイクムービー');
        $response->assertSee('フェイクディレクター');
        $response->assertSee('フェイクスタッフ');
        $response->assertSee('フェイクキャスト');
    }

    public function the_search_dropdown_works_correctly(){
        Http::fake([
            'https://api.themoviedb.org/3/search/movie/?language=ja-JP&query=ラティアス' => $this->fakeSearchMovies(),
        ]);

        Livewire::test('search-dropdown')
            ->assertDontSee('ラティアス')
            ->set('search', 'ラティアス')
            ->assertSee('劇場版ポケットモンスター 水の都の護神 ラティアスとラティオス');
    }

    public function fakeSearchMovies(){
        return Http::response([
            'results' => [
                [
                "adult" => false,
                "backdrop_path" => "/6nfEmbfWMuMBenYMOY6Vdho3Ycg.jpg",
                "genre_ids" => [
                    16,
                    28,
                    12,
                    14
                ],
                "id" => 33875,
                "original_language" => "ja",
                "original_title" => "劇場版ポケットモンスター 水の都の護神 ラティアスとラティオス",
                "overview" => "世界で一番美しい町といわれる水の都「アルトマーレ」。そこでサトシは不思議な技を持つポケモン、ラティアスとラティオスに出会う。ラティオスは兄、ラティアスは妹でとても仲がよく、この町の秘宝「こころのしずく」を守っていた。この秘宝をねらう怪盗姉妹ザンナーとリオン。彼女たちが起こした事件に巻き込まれるサトシとピカチュウたち。隠された封印が解かれた時、町は大水害に見舞われる。奪われた「こころのしずく」を取り返す為、サトシとピカチュウが水の都を駆け抜ける！",
                "popularity" => 23.112,
                "poster_path" => "/vi9X72b5o3SUQ7fKh4N2eEUmeau.jpg",
                "release_date" => "2021-09-30",
                "title" => "劇場版ポケットモンスター 水の都の護神 ラティアスとラティオス",
                "video" => false,
                "vote_average" => 6.5,
                "vote_count" => 262,
                ]
            ]
        ], 200);
    }

    private function fakePopularMovie(){
        return Http::response([
            'results' => [
                [
                "adult" => false,
                "backdrop_path" => "/vIgyYkXkg6NC2whRbYjBD7eb3Er.jpg",
                "genre_ids" => [
                    878,
                    28,
                    12,
                ],
                "id" => 580489,
                "original_language" => "en",
                "original_title" => "Venom: Let There Be Carnage",
                "overview" => "これはテストに用いるポピュラームービーの概要のフェイクです。",
                "popularity" => 1258.832,
                "poster_path" => "/tLR2GqbjIQrpecJUvoKbtcmHv4v.jpg",
                "release_date" => "2021-09-30",
                "title" => "フェイクムービー",
                "video" => false,
                "vote_average" => 7,
                "vote_count" => 7135,
                ]
            ]
        ], 200);
    }

    private function fakeNowPlayingMovie(){
        return Http::response([
            'results' => [
                [
                "adult" => false,
                "backdrop_path" => "/vIgyYkXkg6NC2whRbYjBD7eb3Er.jpg",
                "genre_ids" => [
                    878,
                    28,
                    12,
                ],
                "id" => 580489,
                "original_language" => "en",
                "original_title" => "Venom: Let There Be Carnage",
                "overview" => "これはテストに用いるナウプレイングムービーの概要のフェイクです。",
                "popularity" => 1258.832,
                "poster_path" => "/tLR2GqbjIQrpecJUvoKbtcmHv4v.jpg",
                "release_date" => "2021-09-30",
                "title" => "フェイクナウプレイングムービー",
                "video" => false,
                "vote_average" => 7,
                "vote_count" => 7135,
                ]
            ]
        ], 200);
    }

    private function fakeGenres()
    {
        return Http::response([
            'genres' => [
                [
                    'id' => 28,
                    'name' => 'アクション'
                ],
                [
                    'id' => 12,
                    'name' => 'アドベンチャー'
                ],
                [
                    'id' => 16,
                    'name' => 'アニメーション'
                ],
                [
                    'id' => 35,
                    'name' => 'コメディ'
                ],
                [
                    'id' => 80,
                    'name' => '犯罪'
                ],
                [
                    'id' => 99,
                    'name' => 'ドキュメンタリー'
                ],
                [
                    'id' => 18,
                    'name' => 'ドラマ'
                ],
                [
                    'id' => 10751,
                    'name' => 'ファミリー'
                ],
                [
                    'id' => 14,
                    'name' => 'ファンタジー'
                ],
                [
                    'id' => 36,
                    'name' => '履歴'
                ],
                [
                    'id' => 27,
                    'name' => 'ホラー'
                ],
                [
                    'id' => 10402,
                    'name' => '音楽'
                ],
                [
                    'id' => 9648,
                    'name' => '謎'
                ],
                [
                    'id' => 878,
                    'name' => 'サイエンスフィクション'
                ],
                [
                    'id' => 10770,
                    'name' => 'テレビ映画'
                ],
                [
                    'id' => 53,
                    'name' => 'スリラー'
                ],
                [
                    'id' => 10752,
                    'name' => '戦争'
                ],
                [
                    'id' => 37,
                    'name' => '西洋'
                ],
            ]
        ], 200);
    }

    private function fakeSingleMovie(){
        return Http::response([
            "adult" => false,
            "backdrop_path" => "/192vHmAPbk5esL34XMKZ1YLGFjr.jpg",
            "belongs_to_collection" => null,
            "budget" => 40000000,
            "genres" => [
                ["id" => 28, "name" => "アクション"],
                ["id" => 80, "name" => "犯罪"],
                ["id" => 53, "name" => "スリラー"],
            ],
            "homepage" => "https://www.ambulance.movie",
            "id" => 763285,
            "imdb_id" => "tt4998632",
            "original_language" => "en",
            "original_title" => "Ambulance",
            "overview" => "",
            "popularity" => 1156.855,
            "poster_path" => "/zT5ynZ0UR6HFfWQSRf2uKtqCyWD.jpg",
            "production_companies" => [
                ["id" => 33, "logo_path" => "/8lvHyhjr8oUKOOy2dKXoALWKdp0.png" ,"name" => "Universal Pictures", "origin_country" => "US"],
                ["id" => 6734, "logo_path" => null, "name" => "Bay Films", "origin_country" => "US"],
                ["id" => 100640,"logo_path" => "/2jtYElf5T9r5II8L0Nmbk7TBLwl.png", "name" => "Endeavor Content", "origin_country" => "US"],
                ["id" => 114732, "logo_path" => "/tNCbisMxO5mX2X2bOQxHHQZVYnT.png", "name" => "New Republic Pictures", "origin_country" => "US"],
                ["id" => 130448,"logo_path" => null,"name" => "Project X Entertainment","origin_country" => "US"],
            ],
            "production_countries" => [
                ["iso_3166_1" => "US", "name" => "United States of America"]
            ],
            "release_date" => "2022-03-16",
            "revenue" => 41000000,
            "runtime" => 136,
            "spoken_languages" => [
                ["english_name" => "English", "iso_639_1" => "en", "name" => "English"],
            ],
            "status" => "Released",
            "tagline" => "",
            "title" => "Ambulance",
            "video" => false,
            "vote_average" => 6.8,
            "vote_count" => 382,
            "credits" => [
                [
                    'cast' => [
                        [
                            "adult" => false,
                            "gender" => 2,
                            "id" => 131,
                            "known_for_department" => "Acting",
                            "name" => "キャスト",
                            "original_name" => "Jake Gyllenhaal",
                            "popularity" => 27.07,
                            "profile_path" => "/oA6fp6SQBQQWZEzn4NfY3E8mJhV.jpg",
                            "cast_id" => 5,
                            "character" => "Danny Sharp",
                            "credit_id" => "5fac59f06cf3d5003e170af2",
                            "order" => 0,
                        ]
                    ],
                    'crew' => [
                        [
                            "adult" => false,
                            "gender" => 1,
                            "id" => 2215,
                            "known_for_department" => "Production",
                            "name" => "Denise Chamian",
                            "original_name" => "Denise Chamian",
                            "popularity" => 1.36,
                            "profile_path" => null,
                            "credit_id" => "60f012bbab1bc7005e3a4af8",
                            "department" => "Production",
                            "job" => "ディレクター",
                        ],
                        [
                            "adult" => false,
                            "gender" => 1,
                            "id" => 2215,
                            "known_for_department" => "Production",
                            "name" => "Denise Chamian",
                            "original_name" => "Denise Chamian",
                            "popularity" => 1.36,
                            "profile_path" => null,
                            "credit_id" => "60f012bbab1bc7005e3a4af8",
                            "department" => "Production",
                            "job" => "スタッフ",
                        ],

                    ]


                ]
            ],
            "videos" => [
                'results' => [],
            ],
            "images" => [
                "backdrops" => [],
                "logos" => [],
                "posters" => [],
            ]
        ], 200);
    }

}
