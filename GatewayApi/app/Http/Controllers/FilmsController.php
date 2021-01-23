<?php

namespace App\Http\Controllers;

use App\Services\ActeurService;
use App\Services\FilmService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FilmsController extends Controller
{  use ApiResponse;

    private $FilmService;
    private $ActeurService;

    public function __construct(FilmService $FilmService, ActeurService $ActeurService)
    {
        $this->FilmService = $FilmService;
        $this->ActeurService = $ActeurService;
    }

    public function index()
    {
        return $this->successResponse($this->FilmService->fetchFilms());

    }

    public function show($film)
    {
        return $this->successResponse($this->FilmService->fetchFilm($film));
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->FilmService->createFilm($request->all()));
    }

    public function update(Request $request, $film)
    {
        return $this->successResponse($this->FilmService->updateFilm($film, $request->all()));
    }

    public function destroy($film)
    {
        return $this->successResponse($this->FilmService->deleteFilm($film));
    }

    public function showFilmsInYear($year)
    {
        return $this->successResponse($this->FilmService->fetchshowFilmsInYear($year));
    }

    public function showActeursFilm($idActeur)
    {
        return $this->successResponse($this->FilmService->fetchshowActeursFilm($idActeur));
    }

    public function showActorsFilm($idActeur)
    {
        $acteur = json_decode($this->ActeurService->fetchActeur($idActeur));
        $nomActeur = $acteur->data->nom;
        return $this->successResponse($this->FilmService->fetchshowActorsFilm($nomActeur));
    }

}
