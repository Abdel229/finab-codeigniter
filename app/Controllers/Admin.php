<?php

namespace App\Controllers;

use App\Models\ArticlesModel;
use App\Models\GalleriesCategoryModel;
use App\Models\GalleriesModel;

class Admin extends BaseController
{
    public function index()
    {
        return view('dashboard/index');
    }
    public function fetcharticles()
    {
        $articleModel = new ArticlesModel();
        $articles = $articleModel->where('status_id', 2)->findAll();
        return $this->response->setJSON( $articles);

    }

    public function galeries(): string
    {

        return view('dashboard/galeries');
    }
    public function fetchGalleriesAndCategories()
    {
        $categoryModel = new GalleriesCategoryModel();
        $categories = $categoryModel->findAll();

        $data = [];
        foreach ($categories as $category) {
            $imagesModel = new GalleriesModel();
            $images = $imagesModel->where('category_id', $category['id'])->first();
            if(!$images){
                continue;
            }
            $data[] = [
                'categories' => $category,
                'images' => $images
            ];
        }
        return $this->response->setJSON(['galleries' => $data]);
    }
}
