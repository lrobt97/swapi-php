<?php

namespace SWAPI\Endpoints;

use SWAPI\Models\Species;
use SWAPI\Models\Collection;

class SpeciesEndpoint extends Endpoint
{
    public function index($page = 1)
    {
        $request = $this->http->createRequest("GET", sprintf("species/?page=%d", $page));
        $response = $this->http->send($request);

        $collection = new Collection;

        if ($response->getStatusCode() == 200) {
            return $this->hydrateMany($response->json(), 'SWAPI\Models\Species');
        }

        return $this->handleResponse($response, $request, $collection);
    }

    public function get($id)
    {
        $request = $this->http->createRequest("GET", sprintf("species/%d/", $id));
        $response = $this->http->send($request);

        if ($response->getStatusCode() == 200) {
            return $this->hydrateOne($response->json(), new Species);
        }

        return $this->handleResponse($response, $request);
    }
}
