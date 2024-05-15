<?php

namespace App\Controllers;

use App\Models\ArticleLinksModel;
use App\Models\ArticlesModel;
use App\Models\ContactModel;
use App\Models\SocialLinkModel;
use App\Models\SponsoringPartenariatModel;
use Config\Services;
use App\Models\PartenairesModel;

class Home extends BaseController
{
    public function index(): string
    {
        $gallerieController=new GalleriesController();
        $partnersModel=new PartenairesModel();
        $gallerieData=$gallerieController->category_image();
        $partnersData = $partnersModel->where('status_id',2)->findAll();
            return view('index',['galleries'=>$gallerieData,'partners'=>$partnersData]);
    }

    public function programmation(): string
    {
        return view('programme');
    }


    public function partners(): string
    {
        $partnerSponsModel = new SponsoringPartenariatModel();
        $partner_spon = $partnerSponsModel->where('id', 1)->first();
        return view('partners',['data'=>$partner_spon]);
    }

    public function actualite(): string
    {
        $actualiteModel=new ArticlesModel();
        $actualite=$actualiteModel->where('status_id',2)->findAll();
        $pager = $actualiteModel->pager;

        return view('actualite',['actualites'=>$actualite,'pager' => $pager]);
    }

    public function singleActualite($id){
              $articleModel = new ArticlesModel();

              $article = $articleModel->find($id);
              $randomArticles = $articleModel->where('status_id',2)->orderBy('RAND()')->limit(3)->findAll();
              if (!$article) {
                session()->setFlashdata('success', ['Article non trouvé.']);
            return redirect()->back()->withInput();
              }
      
              $articleLinksModel = new ArticleLinksModel();
      
              $links = $articleLinksModel->where('article_id', $id)->where('status_id',2)->findAll();
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
        $contactModel = new ContactModel();
        $contact = $contactModel->where('status_id', 2)->first();

        $socialLinkModel = new SocialLinkModel();
        $socialLinks=$socialLinkModel->findAll();
        if ($contact) {
            return view('contact', ['contact' => $contact,'socialLinks'=>$socialLinks]);
        } else {
            return view('contact');
        }
    }
}
