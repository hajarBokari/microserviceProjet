<?php

namespace App\Services;

use App\Traits\RequestService;

class FilmService
{
    use RequestService;

    public $baseUri;
    public $secret;

    public function __construct()
    {
        $api = \DB::table('microservices')->where('nom', 'movies')->first();
        if (isset($api)){
                $this->baseUri = $api->base_url;
                $this->secret = $api->token;
        }
    }

    public function fetchFilms()
    {
        return $this->request('GET', '/api/film');
    }

    public function fetchFilm($film)
    {
        return $this->request('GET', "/api/film/{$film}");
    }

    public function fetchshowFilmsInYear($year)
    {
        return $this->request('GET', "/api/film/inYear/{$year}");
    }

    public function fetchshowActeursFilm($idActeur)
    {
        return $this->request('GET', "/api/film/acteur/{$idActeur}");
    }

    public function fetchshowActorsFilm($nomActeur)
    {
        return $this->request('GET', "/api/film/actor/{$nomActeur}");
    }

    public function createFilm($data)
    {
        return $this->request('POST', '/api/film', $data);
    }

    public function updateFilm($film, $data)
    {
        return $this->request('PATCH', "/api/film/{$film}", $data);
    }

    public function deleteFilm($film)
    {
        return $this->request('DELETE', "/api/film/{$film}");
    }
}
