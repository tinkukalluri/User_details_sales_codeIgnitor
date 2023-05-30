<?php

namespace App\Controllers;

use App\Models\WorldModel;
use CodeIgniter\HTTP\IncomingRequest;

class World extends BaseController
{
    public function country()
    {
        header('Content-Type: application/json');
        $world = new WorldModel;
        $countries = $world->getCountries();
        return $this->response->setJson($countries);
    }

    public function state()
    {
        $world = new WorldModel;
        $request = service('request');
        $country = $request->getGet('country');
        $t_state = $world->getStates($country);
        $states = array("country" => $country, "states" => $t_state);
        return $this->response->setJson($states);
    }

    public function city()
    {
        $world = new WorldModel;
        $request = service('request');
        $country = $request->getGet('country');
        $state = $request->getGet('state');
        $t_cities = $world->getCities($country, $state);
        $cities = array("country" => $country, "states" => $state, "cities" => $t_cities);
        return $this->response->setJson($cities);
    }
}
