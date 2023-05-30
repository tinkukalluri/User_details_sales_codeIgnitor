<?php

namespace App\Models;

use CodeIgniter\Model;

class WorldModel
{
    function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function getCountries()
    {
        // $db->reconnect();
        // print_r($db);
        $query   = $this->db->query('SELECT name , code FROM country;');
        $results = $query->getResultArray();
        return $results;
    }

    public function getStates($country)
    {
        $query   = $this->db->query('select distinct District from city where countrycode="' . $country . '";');
        $results = $query->getResultArray();
        return $results;
    }

    public function getCities($country, $distinct)
    {
        $query   = $this->db->query('select name from city where countrycode="' . $country . '" and district="' . $distinct . '";');
        $results = $query->getResultArray();
        return $results;
    }
}
