<?php

namespace App\Controllers;

use App\Models\ArticlesCategoryModel;

class Admin extends BaseController
{
    public function index(): string
    {
        $articleCategoryModel = new ArticlesCategoryModel();
        $articles_category = $articleCategoryModel->findAll();
        return view('dashboard/index', ["articlescategory" => $articles_category]);
    }
}
