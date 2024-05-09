<?php

namespace App\Controllers;

use App\Models\ArticlesModel;
use App\Models\GalleriesCategoryModel;
use App\Models\GalleriesInformationModel;
use App\Models\GalleriesModel;

class Admin extends BaseController
{
    public function index(): string
    {
        $articleModel=new ArticlesModel();
        $articles_category=$articleModel->where('status_id',2)->findAll();
        return view('dashboard/index', ["articles" => $articles_category]);
    }


    public function galeries(): string
    {
        $galleriesInformationModel = new GalleriesInformationModel();
        $galleriesInformation = $galleriesInformationModel->where('status_id', '2')->findAll();

        return view('dashboard/galeries',['galleries'=>$galleriesInformation]);
    }
}
