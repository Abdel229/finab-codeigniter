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
        $categoryModel = new GalleriesCategoryModel();
        $categories = $categoryModel->where('status_id', '2')->findAll();
        $data = [];
        foreach ($categories as $category) {
            $imagesModel = new GalleriesModel();
            $image = $imagesModel->where('category_id', $category['id'])->first();
            if(!$image){
                continue;
            }
            $data[] = [
                'category' => $category,
                'image' => $image
            ];
        }

        return view('dashboard/galeries',['galleries'=>$data]);
    }
}
