<?php

namespace App\Controllers;

use App\Models\ArticlesModel;
use App\Models\GalleriesCategoryModel;
use App\Models\GalleriesInformationModel;
use App\Models\ArticlesCategoryModel;
use App\Models\GalleriesModel;

class Admin extends BaseController
{
    public function index()
    {
        return view('dashboard/index');
    }
    public function home()
    {
        return view('dashboard/home');
    }
    public function fetcharticles()
    {
        $articleModel = new ArticlesModel();
        $articles = $articleModel->where('status_id', 2)->orWhere('status_id',3)->orderBy('id','DESC')->findAll();
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
        $categoryModel = new GalleriesInformationModel();
        $categories = $categoryModel->where('status_id',2)->findAll();
        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'categories' => $category
            ];
        }
        return $this->response->setJSON(['galleries' => $data]);
    }
}
