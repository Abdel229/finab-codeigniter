<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PartenerController extends BaseController
{
    public function index()
    {
        return view('/partner/presentation');
    }
    public function index_demande()
    {
        return view('/partner/demande');
    }
    public function index_partners()
    {
        return view('/partner/list_partners');
    }
}
