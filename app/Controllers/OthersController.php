<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class OthersController extends BaseController
{
    public function index_logo()
    {
        return view('/others/logo');
    }
    public function index_promotteur()
    {
        return view('/others/promotteur');
    }
    public function index_configuration()
    {
        return view('/others/configuration');
    }
}
