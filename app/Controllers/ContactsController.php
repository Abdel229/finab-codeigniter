<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ContactsController extends BaseController
{
    public function index()
    {
        return view('/contact/index');
    }
}
