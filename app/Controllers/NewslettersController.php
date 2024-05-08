<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class NewslettersController extends BaseController
{
    public function index_historique()
    {
        return view('/newsletters/historique');
    }
    public function index_followers()
    {
        return view('/newsletters/followers');
    }
    public function index_categories()
    {
        return view('/newsletters/categories');
    }
}
