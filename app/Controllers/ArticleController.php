<?php

namespace App\Controllers;

use App\Models\ArticlesCategoryModel;
use App\Models\ArticlesModel;
use App\Models\ArticleLinksModel;

class ArticleController extends BaseController
{
    // Méthode pour afficher une liste d'articles
    public function index()
    {
        $articleCategoryModel = new ArticlesCategoryModel();
        $articles_category = $articleCategoryModel->findAll();
        return view('formulaire/articles_form', ["articlescategory" => $articles_category]);
    }

    // Méthode pour traiter la soumission du formulaire de création
    public function store()
    {
        // Récupérer les données du formulaire
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $date_pub = $this->request->getPost('date_pub');
        $categoryName = $this->request->getPost('category'); // Nom de la catégorie

        // Vérifier que tous les champs sont remplis
        if (empty($title) || empty($description) || empty($date_pub) || empty($categoryName)) {
            // Rediriger avec un message d'erreur
            return redirect()->back()->withInput()->with('error', 'Veuillez remplir tous les champs du formulaire.');
        }

        // Récupérer l'ID de la catégorie en fonction de son nom
        $articlesCategoryModel = new ArticlesCategoryModel();
        $category = $articlesCategoryModel->where('name', $categoryName)->first();

        // Vérifier si la catégorie existe
        if (!$category) {
            // Rediriger avec un message d'erreur si la catégorie n'existe pas
            return redirect()->back()->withInput()->with('error', 'La catégorie sélectionnée n\'existe pas.');
        }

        // Traiter l'image
        $img = $this->request->getFile('img');
        if ($img->isValid() && !$img->hasMoved()) {
            // Déplacer l'image vers le dossier de destination
            $newName = $img->getRandomName();
            $img->move(ROOTPATH . 'public/uploads', $newName);

            // Enregistrer le lien de l'image dans la base de données
            $imgPath = 'uploads/' . $newName;
        }

        // Enregistrer les données de l'article dans la table articles
        $articleModel = new ArticlesModel();
        $articleData = [
            'title' => $title,
            'img' => $imgPath,
            'description' => $description,
            'date_pub' => $date_pub,
            'category_id' => $category['id'], // Utiliser l'ID de la catégorie récupérée
            'status_id' => 2 // Par exemple, 2 est l'ID du statut
        ];
        $articleModel->insert($articleData);

        // Enregistrer les liens dans la table article_links
        $links = [];
        for ($i = 1; $i <= 7; $i++) {
            $link = $this->request->getPost("lien$i");
            if (!empty($link)) {
                $links[] = [
                    'link' => $link,
                    'article_id' =>$articleModel->getInsertID(),
                    'status_id' =>2
                ];
            }
        }
        $articleLinksModel = new ArticleLinksModel();
        $articleLinksModel->insertBatch($links);

        // Rediriger l'utilisateur vers une autre page ou afficher un message de succès
        return redirect()->to('/')->with('success', 'Article ajouté avec succès !');
    }
    public function show($id)
    {
        // Charger le modèle des articles
        $articleModel = new ArticlesModel();

        // Récupérer les informations de l'article
        $article = $articleModel->find($id);

        if (!$article) {
            // Gérer le cas où l'article n'est pas trouvé
            return redirect()->to('/')->with('error', 'Article non trouvé.');
        }

        // Charger le modèle des liens d'articles
        $articleLinksModel = new ArticleLinksModel();

        // Récupérer les liens associés à l'article
        $links = $articleLinksModel->where('article_id', $id)->findAll();

        // Passer les données à la vue
        $data = [
            'article' => $article,
            'links' => $links
        ];

        // Charger la vue correspondante
        return view('formulaire/show', $data);
    }


}
