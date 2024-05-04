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
        $photos = $this->request->getFiles('photos');

        // Récupérer la catégorie sélectionnée
        $categoryName = $this->request->getPost('category');
        $galleriesCategoryModel = new GalleriesCategoryModel();
        $category = $galleriesCategoryModel->where('name', $categoryName)->first();

        // Parcourir chaque champ de fichier individuellement
        $photosCount = count($photos);
        for ($i = 0; $i < $photosCount; $i++) {
            $photo = $photos[$i];
            // Vérifier si le champ de fichier est un objet de fichier téléchargé valide
            if ($photo->isValid() && !$photo->hasMoved()) {
                // Générer un nouveau nom de fichier unique
                $newName = $photo->getRandomName();

                // Déplacer le fichier vers le dossier de destination
                $photo->move(ROOTPATH . 'public/uploads_galleries', $newName);

                // Enregistrer le chemin du fichier dans la base de données
                $galleryModel = new GalleryModel();
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



}
