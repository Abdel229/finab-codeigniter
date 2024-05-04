<?php

namespace App\Controllers;

class latest extends BaseController
{
    public function index()
  {
    return view('2023/index');
  }

  public function qui()
  {
    return view('2023/qui');
  }

  public function partenaire()
  {
    return view('2023/partenaire');
  }

  public function programmation()
  {
    return view('2023/programme');
  }

  public function media()
  {
    return view('2023/media');
  }

  public function portfolio()
  {
    return view('2023/portfolio');
  }
  public function contact()
  {
    return view('2023/contact');
  }
}
