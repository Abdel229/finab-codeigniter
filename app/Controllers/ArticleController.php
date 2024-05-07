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
        $articleCategoryModel = new ArticlesModel();
        $articles_category = $articleCategoryModel->findAll();
        return view('formulaire/articles_form', ["articlescategory" => $articles_category]);
    }

    // Méthode pour traiter la soumission du formulaire de création
    public function store()
    {
        $method = $this->request->getMethod('true');

        if ($method === 'GET') {
            $categoryModel = new ArticlesCategoryModel();
            $category = $categoryModel->findAll();
            return view('dashboard/new_article', ['categories' => $category]);
        } elseif ($method === 'POST') {
            // Définir les règles de validation
            $rules = [
                'title' => 'required|max_length[255]',
                'description' => 'required',
                'date_pub' => 'required|date',
                'category' => 'required',
                'img' => 'uploaded[img]',
            ];

            // Vérifier si la validation échoue
            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            // Récupérer les données du formulaire
            $title = $this->request->getPost('title');
            $description = $this->request->getPost('description');
            $date_pub = $this->request->getPost('date_pub');
            $categoryName = $this->request->getPost('category'); // Nom de la catégorie

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
            foreach ($_POST as $key => $value) {
                // Vérifier si la clé correspond à un lien
                if (strpos($key, 'lien') === 0 && !empty($value)) {
                    // Extraire le numéro de lien de la clé
                    $linkNumber = substr($key, 4);

                    // Ajouter le lien au tableau des liens
                    $links[] = [
                        'link' => $value,
                        'article_id' => $articleModel->getInsertID(),
                        'status_id' => 2 // Statut par défaut pour les nouveaux liens
                    ];
                }
            }

            $articleLinksModel = new ArticleLinksModel();
            $articleLinksModel->insertBatch($links);


            // Rediriger l'utilisateur vers une autre page ou afficher un message de succès
            return redirect()->to('/admin')->with('success', 'Article ajouté avec succès!');
        }
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
    public function update($id)
    {
        $method = $this->request->getMethod();
        // dd($this->request->getPost());
        if ($method === 'GET') {
            $articleModel = new ArticlesModel();
            $article = $articleModel->find($id);
            // dd($article);
            $categoryModel = new ArticlesCategoryModel();
            $category = $categoryModel-> where('status_id',2)->findAll();

            // recuperation des liens 
            $LinksModel = new ArticleLinksModel();
            $links = $LinksModel->where('article_id', $id)->findAll();
            // dd($links);
            return view('dashboard/update_article', ['article' => $article, 'categories' => $category,'links'=>$links]);
        } else if ($method === 'POST') {
            // Définir les règles de validation
            // dd($this->request->getFile('new_img')) ;
            $rules = [
                'title' => 'required',
                // 'new_img' => 'uploaded[img]',
                'description' => 'required',
                'category' => 'required'
                // Ajoutez ici d'autres règles de validation si nécessaire
            ];
           
            // Vérifier si la validation échoue
            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
            
            $categoryModel = new ArticlesCategoryModel();
            $category = $categoryModel->where('name',$this->request->getPost('category'))->first();
            // Récupérer les données du formulaire
            $articleData = [
                'title' => $this->request->getPost('title'),
                'img' => $this->request->getPost('img'),
                'description' => $this->request->getPost('description'),
                'category_id' => $category['id']
                // Autres champs d'article
            ];
            // Vérifier si une nouvelle image a été fournie
            if ($newImageFile = $this->request->getFile('new_img')) {
                // Déplacer la nouvelle image vers le dossier de destination
                $newImageName = $newImageFile->getRandomName();
                $newImageFile->move(ROOTPATH . 'public/uploads', $newImageName);

                // Mettre à jour le chemin de l'image dans les données de l'article
                $articleData['img'] = 'uploads/' . $newImageName;

                // Supprimer l'ancienne image si nécessaire
                // if (!empty($article['img'])) {
                //     unlink(ROOTPATH . 'public/' . $article['img']);
                // }
            }

            // Mettre à jour l'article
            $articlesModel = new ArticlesModel();
            $articlesModel->update($id, $articleData);

            // Récupérer les données des liens YouTube
            $linksData = $this->request->getPost('youtube_links');

            // // Mettre à jour les liens YouTube associés à l'article
            $articleLinksModel = new ArticleLinksModel();
            $articleLinksModel->where('article_id', $id)->delete(); // Supprimer d'abord tous les liens existants pour cet article
            foreach ($linksData as $link) {
                $articleLinksModel->insert([
                    'link' => $link,
                    'article_id' => $id,
                    // Autres champs de lien YouTube
                ]);
            }

            // Rediriger avec un message de succès
            return redirect()->to('/admin')->with('success', 'Article updated successfully.');
        }
    }

    public function form_update($id_article)
    {
        // Charger le modèle de l'article
        $articleModel = new ArticlesModel();
        // Récupérer les données de l'article avec l'ID spécifié
        $article = $articleModel->find($id_article);

        if (!$article) {
            // Gérer le cas où l'article n'est pas trouvé
            return redirect()->to('/articles')->with('error', 'Article not found.');
        }

        // Charger le modèle des liens des articles
        $articleLinksModel = new ArticleLinksModel();
        // Récupérer les liens correspondant à l'article avec l'ID spécifié
        $articleLinks = $articleLinksModel->where('article_id', $id_article)->findAll();

        // Charger le modèle de la catégorie d'articles
        $articleCategoryModel = new ArticlesCategoryModel();
        // Récupérer la catégorie correspondant à l'article avec l'ID spécifié
        $articleCategory = $articleCategoryModel->find($article['category_id']);

        if (!$articleCategory) {
            // Gérer le cas où la catégorie n'est pas trouvée
            return redirect()->to('/articles')->with('error', 'Category not found.');
        }

        // Charger la vue du formulaire avec les données récupérées
        return view('formulaire/articles_form', [
            'article' => $article,
            'articleLinks' => $articleLinks,
            'articleCategory' => $articleCategory
        ]);
    }

    public function delete($id){
        $articleModel = new ArticlesModel();
        $article = $articleModel->find($id);

        if (!$article) {
            return redirect()->to('/articles')->with('error', 'Article not found.');
        }

        $articleModel->update($id, ['status_id' => 3]);

        return redirect()->to('/admin')->with('message', 'Article deleted.');
    }
}
