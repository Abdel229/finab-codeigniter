<?php

namespace App\Controllers;

use App\Models\ArticleLinksModel;
use App\Models\ArticlesModel;

class Home extends BaseController
{
    public function index(): string
    {
        $gallerieController=new GalleriesController();
        $gallerieData=$gallerieController->category_image();
            return view('index',['galleries'=>$gallerieData]);
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
        $actualiteModel=new ArticlesModel();
        $actualite=$actualiteModel->findAll();
        return view('actualite',['actualites'=>$actualite]);
    }

    public function singleActualite($id){
              $articleModel = new ArticlesModel();

              $article = $articleModel->find($id);
              $randomArticles = $articleModel->orderBy('RAND()')->limit(3)->findAll();
              if (!$article) {
                  return redirect()->to('/')->with('error', 'Article non trouvé.');
              }
      
              $articleLinksModel = new ArticleLinksModel();
      
              $links = $articleLinksModel->where('article_id', $id)->findAll();
      
              $data = [
                  'article' => $article,
                  'links' => $links
              ];
      
        return view('singleActualite',['article'=>$article,'links'=>$links,'randomArticles'=>$randomArticles]);
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
