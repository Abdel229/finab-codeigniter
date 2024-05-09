<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class FinabController extends BaseController
{
    public function index()
    {
        return view('/finab/all_finab');
    }
    public function index_edition_finab()
    {
        return view('/finab/index_finab');
    }
}
