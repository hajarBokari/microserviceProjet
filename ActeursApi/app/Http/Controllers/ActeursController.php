<?php

namespace App\Http\Controllers;

use App\Models\Acteurs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActeursController extends Controller
{

    public function index()
    {
        $acteurs = Acteurs::all();
        return $this->successResponse($acteurs);
    }

    public function show($idacteur)
    {
        $acteur = Acteurs::findOrFail($idacteur);
        return $this->successResponse($acteur);
    }

    public function store(Request $request)
    {
        $rules = [
            'nom' => 'required'
        ];

        $this->validate($request, $rules);
        $acteur = Acteurs::create($request->all());
        return $this->successResponse($acteur);

    }

    public function update(Request $request, $acteur)
    {
        $rules = [
            
        ];

        $this->validate($request, $rules);
        $acteur = Acteurs::findOrFail($acteur);
        $acteur = $acteur->fill($request->all());

        if ($acteur->isClean()) {
            return $this->errorResponse('at least one value must be change',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $acteur->save();
        return $this->successResponse($acteur);
    }


    public function destroy($acteur)
    {

        $acteur = Acteurs::findOrFail($acteur);
        $acteur->delete();
        return $this->successResponse($acteur);
    }


}
