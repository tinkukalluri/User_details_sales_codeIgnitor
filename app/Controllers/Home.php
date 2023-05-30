<?php

namespace App\Controllers;

use App\Models\WorldModel;
use CodeIgniter\HTTP\IncomingRequest;

class Home extends BaseController
{
    public function index()
    {
        return view('customer_details');
    }

    public function submit()
    {
        $request = service('request');
        $name = $request->getGet('name');
        $data = array(
            'name' => $name
        );
        return view('submitted', $data);
    }
}
