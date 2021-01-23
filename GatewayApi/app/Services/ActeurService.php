<?php

namespace App\Services;

use App\Traits\RequestService;

class ActeurService
{
    use RequestService;
    public $baseUri;
    public $secret;

    public function __construct()
    {
        $api = \DB::table('microservices')->where('nom', 'actors')->first();
        if (isset($api)){
                $this->baseUri = $api->base_url;
                $this->secret = $api->token;
        }
    }


    public function fetchActeurs()
    {
        return $this->request('GET', '/api/acteurs');
    }

    public function fetchActeur($idacteur)
    {
        return $this->request('GET', "/api/acteurs/{$idacteur}");
    }

    public function createActeur($acteur)
    {
        return $this->request('POST', '/api/acteurs', $acteur);
    }

    public function updateActeur($acteur, $data)
    {
        return $this->request('PATCH', "/api/acteurs/{$acteur}", $data);
    }

    public function deleteActeur($acteur)
    {
        return $this->request('DELETE', "/api/acteurs/{$acteur}");
    }

}
