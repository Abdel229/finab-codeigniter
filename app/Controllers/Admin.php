<?php

namespace App\Controllers;

use App\Models\ArticlesModel;
use App\Models\GalleriesCategoryModel;
use App\Models\ArticlesCategoryModel;
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
        $data = [];
        foreach ($articles as $article) {
            $categoriesModel = new ArticlesCategoryModel();
            $categories = $categoriesModel->where('id', $article['category_id'])->first();
            if(!$categories){
                continue;
            }
            $data[] = [
                'categories' => $categories,
                'articles' => $article
            ];
        }
        return $this->response->setJSON(['allarticles' => $data]);

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
