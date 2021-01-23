<?php

namespace App\Http\Controllers;

use App\Services\ActeurService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;


class ActeursController extends Controller
{
    use ApiResponse;
    private $ActeurService;

    public function __construct(ActeurService $ActeurService)
    {
        $this->ActeurService = $ActeurService;
    }

    public function index()
    {
        return $this->successResponse($this->ActeurService->fetchActeurs());
    }

    public function show($idacteur)
    {
        return $this->successResponse($this->ActeurService->fetchActeur($idacteur));
    }

    public function store(Request $request)
    {
        return $this->successResponse($this->ActeurService->createActeur($request->all()));
    }

    public function update(Request $request, $acteur)
    {
        return $this->successResponse($this->ActeurService->updateActeur($acteur, $request->all()));
    }

    public function destroy($acteur)
    {
        return $this->successResponse($this->ActeurService->deleteActeur($acteur));
    }
}
