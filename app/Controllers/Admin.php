<?php

namespace App\Controllers;

use App\Models\ArticlesModel;
use App\Models\GalleriesCategoryModel;
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
        $galeryModel=new GalleriesModel();
        $galery=$galeryModel->where('status_id',2)->findAll();

        $galeryCategoryModel=new GalleriesCategoryModel();
        $galeriesCategory=$galeryCategoryModel->where('status_id',2)->findAll();
        return view('dashboard/galeries',["galeries"=>$galery,'galeriesCategory'=>$galeriesCategory]);
    }
}
