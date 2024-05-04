<?php

namespace App\Controllers;

use App\Models\GalleriesCategoryModel;
use App\Models\GalleriesModel;
use App\Models\ArticleLinksModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GalleriesController extends BaseController
{
    public function index()
    {
        $galleryCategoryModel = new GalleriesCategoryModel();
        $galleries_category = $galleryCategoryModel->findAll();
        return view('formulaire/galleries_form', ["gallerycategory" => $galleries_category]);
    }

    public function store()
    {
        // Récupérer les photos envoyées par le formulaire
        $photos = $this->request->getFiles();

        // Récupérer la catégorie sélectionnée
        $categoryName = $this->request->getPost('category');
        $galleriesCategoryModel = new GalleriesCategoryModel();
        $category = $galleriesCategoryModel->where('name', $categoryName)->first();

        // Parcourir chaque champ de fichier individuellement
        foreach ($photos['photos'] as $photo) {
            // Vérifier si le champ de fichier est un objet de fichier téléchargé valide
            if ($photo->isValid() && !$photo->hasMoved()) {
                // Générer un nouveau nom de fichier unique
                $newName = $photo->getRandomName();

                // Déplacer le fichier vers le dossier de destination
                $photo->move(ROOTPATH . 'public/uploads_galleries', $newName);

                // Enregistrer le chemin du fichier dans la base de données
                $galleryModel = new GalleriesModel();
                $galleryModel->insert([
                    'img' => 'uploads_galleries/' . $newName,
                    'category_id' => $category['id'],
                    'status_id' => 2
                ]);
            }
        }

        // Rediriger l'utilisateur ou afficher un message de confirmation
        return redirect()->to('/create_gallery')->with('success', 'Photos enregistrées avec succès !');
    }

    public function fetchCategories()
    {
        // Charger le modèle des catégories de galeries
        $categoryModel = new GalleriesCategoryModel();

        // Récupérer toutes les catégories de galeries
        $categories = $categoryModel->findAll();

        // Passer les données à la vue
        $data = [
            'categories' => $categories
        ];

        // Charger la vue correspondante et passer les données
        return view('formulaire/galleries', $data);
    }
    
    public function showImagesByCategory()
    {
        // Récupérer la catégorie sélectionnée depuis la requête POST
        $categoryName = $this->request->getPost('category');
        
        // Charger le modèle de catégorie
        $categoryModel = new GalleriesCategoryModel();
        $category = $categoryModel->where('name', $categoryName)->first();
        // Charger le modèle de la galerie
        $galleryModel = new GalleriesModel();
    
        // Récupérer les photos de la galerie en fonction de l'ID de la catégorie
        $images = $galleryModel->where('category_id', $category['id'])->findAll();
        
        // dd($images);
        // Charger la vue et passer les données
        return view('formulaire/galleries_photo', ['images' => $images]);
    }
    
    public function galleries_photo(){
        return view('formulaire/galleries_photo', ['images' => $images]);
    }

    public function update($id)
    {
        // Récupérer les données du formulaire
        $categoryName = $this->request->getPost('category');
        $galleriesCategoryModel = new GalleriesCategoryModel();
        $category = $galleriesCategoryModel->where('name', $categoryName)->first();

        // Vérifier si la catégorie existe
        if (!$category) {
            // Rediriger avec un message d'erreur si la catégorie n'existe pas
            return redirect()->back()->with('error', 'La catégorie sélectionnée n\'existe pas.');
        }

        // Récupérer les photos envoyées par le formulaire
        $photos = $this->request->getFiles();

        // Mettre à jour les données de la galerie (y compris la catégorie)
        $galleryModel = new GalleriesModel();
        $data = [
            'category_id' => $category['id']
        ];
        $galleryModel->update($id, $data);

        // Parcourir chaque champ de fichier individuellement
        foreach ($photos['photos'] as $photo) {
            // Vérifier si le champ de fichier est un objet de fichier téléchargé valide
            if ($photo->isValid() && !$photo->hasMoved()) {
                // Générer un nouveau nom de fichier unique
                $newName = $photo->getRandomName();

                // Déplacer le fichier vers le dossier de destination
                $photo->move(ROOTPATH . 'public/uploads_galleries', $newName);

                // Enregistrer le chemin du fichier dans la base de données
                $galleryModel->insert([
                    'img' => 'uploads_galleries/' . $newName,
                    'category_id' => $category['id'],
                    'status_id' => 2
                ]);
            }
        }

        // Rediriger l'utilisateur ou afficher un message de confirmation
        return redirect()->to('/')->with('success', 'Galerie mise à jour avec succès.');
    }

    public function delete($id)
    {
        // Mettre à jour le statut de la galerie à "Supprimée" (statut_id = 3)
        $galleryModel = new GalleriesModel();
        $data = [
            'status_id' => 3
        ];
        if ($galleryModel->update($id, $data)) {
            // Rediriger avec un message de succès si la suppression réussit
            return redirect()->to('/')->with('success', 'Galerie supprimée avec succès.');
        } else {
            // Rediriger avec un message d'erreur si la suppression échoue
            return redirect()->to('/')->with('error', 'Échec de la suppression de la galerie.');
        }
    }

}
