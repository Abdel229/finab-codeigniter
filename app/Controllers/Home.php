<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
            return view('index');
    }

    public function programmation(): string
    {
        return view('programme');
    }


    public function partners(): string
    {
        return view('partners');
    }

    public function actualite(): string
    {
        return view('actualite');
    }

    public function media(): string
    {
        return view('media');
    }

    public function contact(): string
    {
        return view('contact');
    }
}
