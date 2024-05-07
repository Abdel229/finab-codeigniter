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
        $articles_category = $articleModel->join('articles_category', 'articles.category_id = articles_category.id')
        ->select('articles.*') // Sélectionnez uniquement les colonnes de la table des articles
        ->where(['articles.status_id' => 2, 'articles_category.status_id' => 2]) // Filtrez en fonction des conditions requises
        ->findAll();

        return view('dashboard/index', ["articles" => $articles_category]);
    }


    public function galeries(): string
    {
        $categoryModel = new GalleriesCategoryModel();
        $categories = $categoryModel->findAll(6);

        $data = [];
        foreach ($categories as $category) {
            $imagesModel = new GalleriesModel();
            $image = $imagesModel->where('category_id', $category['id'])->findAll(1);

            $data[] = [
                'category' => $category,
                'image' => $image[0]
            ];
        }

        return view('dashboard/galeries',['galleries'=>$data]);
    }
}
