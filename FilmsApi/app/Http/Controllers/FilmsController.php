<?php

namespace App\Http\Controllers;

use App\Models\Films;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FilmsController extends Controller
{

    public function index()
    {
        $films = Films::all();
        return $this->successResponse($films);
    }

    public function show($film)
    {
        $films = Films::findOrFail($film);
        return $this->successResponse($films);
    }

    public function store(Request $request)
    {
        $rules = [
            'nom' => 'required|max:255',
            'annee' => 'required',
            'acteurs' => 'required',
        ];

        $this->validate($request, $rules);
        $films = Films::create($request->all());
        return $this->successResponse($films->id);

    }

    public function update(Request $request, $film)
    {
        $rules = [
            'nom' => 'max:255',
        ];

        $this->validate($request, $rules);
        $film = Films::findOrFail($film);

        $film = $film->fill($request->all());

        if ($film->isClean()) {
            return $this->errorResponse('at least one value must be change',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $film->save();
        return $this->successResponse($film);
    }


    public function destroy($film)
    {

        $film = Films::findOrFail($film);
        $film->delete();
        return $this->successResponse($film);
    }

    public function showFilmsInYear($year)
    {
        $films = DB::table('films')->where('annee', $year)->get();
        return $this->successResponse($films);
    }

    // valide lors appel direct service film
    public function showActeursFilm($idActeur)
    {
        $response = Http::get(env('ACTEUR_API_URL').'/api/acteurs/'.$idActeur);

        if($response->successful()){
            $nom = $response->json()['data']['nom'];
            if(isset($nom)){
                $films = DB::select("SELECT * FROM films where acteurs like '%".$nom."%'");
                return $this->successResponse($films);
            }
        }else{
            return $this->errorResponse('appel service failed !',
                Response::HTTP_BAD_REQUEST);
        }


    }

    // utiliser lors appel a partir de gateway
    public function showActorsFilm($nomActeur)
    {
        $nom = urldecode($nomActeur);
        $films = DB::select("SELECT * FROM films where acteurs like '%".$nom."%'");
        if(isset ($films)) return $this->successResponse($films);
        else return $this->errorResponse('resultat vide !',Response::HTTP_BAD_REQUEST);
    }


}
