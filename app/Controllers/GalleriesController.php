<?php

namespace App\Controllers;

use App\Models\GalleriesCategoryModel;
use App\Models\GalleriesInformationModel;
use App\Models\GalleriesModel;
use App\Models\ArticleLinksModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GalleriesController extends BaseController
{
    public function index()
    {
        $categoryModel = new GalleriesCategoryModel();
        $galleryInformationModel = new GalleriesInformationModel();
        $imagesModel = new GalleriesModel();
    
        // Récupère toutes les catégories avec status_id = 2, triées par ordre décroissant de création
        $categories = $categoryModel->where('status_id', 2)->orderBy('created_at', 'DESC')->findAll();
    
        // Récupère toutes les informations de galerie avec status_id = 2
        $galleriesInformation = $galleryInformationModel->where('status_id', 2)->findAll();
    
        // Récupère toutes les images avec status_id = 2
        $images = $imagesModel->where('status_id', 2)->findAll();
    
        // Crée un tableau pour stocker les données
        $data = [];
    
        // Parcoure chaque catégorie
        foreach ($categories as $category) {
            // Trouve les informations de galerie correspondantes
            $galleriesInformationForCategory = array_filter($galleriesInformation, function($gallerieInformation) use ($category) {
                return $gallerieInformation['category_id'] == $category['id'];
            });
            if(empty($galleriesInformationForCategory)){
                continue;
            }
            // Trouve les images correspondantes
            $imagesForCategory = array_filter($images, function($image) use ($category) {
                return $image['category_id'] == $category['id'];
            });
            // Ajoute les données à la structure souhaitée
            $data[] = [
                'category' => $category,
                'galleries' => $galleriesInformationForCategory,
                'images' => $imagesForCategory
            ];
        }
        $allCategorie=$categoryModel->where('status_id', 2)->orderBy('created_at', 'DESC')->findAll();
        // Retourne la vue avec les données
        return view('galleries', ['data' => $data,'allCategories' => $allCategorie]);
    }
   public function perCategorie($id){
    $categoryModel = new GalleriesCategoryModel();
    $galleryInformationModel = new GalleriesInformationModel();
    $imagesModel = new GalleriesModel();

    // Récupère toutes les catégories avec status_id = 2, triées par ordre décroissant de création
    $categories = $categoryModel->where('status_id', 2)->where('id',$id)->first();

    // Récupère toutes les informations de galerie avec status_id = 2
    $galleriesInformation = $galleryInformationModel->where('status_id', 2)->findAll();

    // Récupère toutes les images avec status_id = 2
    $images = $imagesModel->where('status_id', 2)->findAll();

    // Crée un tableau pour stocker les données
    $data = [];

    // Parcoure chaque catégorie
    foreach ($categories as $category) {
        // Trouve les informations de galerie correspondantes
        $galleriesInformationForCategory = array_filter($galleriesInformation, function($gallerieInformation) use ($category) {
            return $gallerieInformation['category_id'] == $category['id'];
        });
        if(empty($galleriesInformationForCategory)){
            continue;
        }
        // Trouve les images correspondantes
        $imagesForCategory = array_filter($images, function($image) use ($category) {
            return $image['category_id'] == $category['id'];
        });
        // Ajoute les données à la structure souhaitée
        $data[] = [
            'category' => $category,
            'galleries' => $galleriesInformationForCategory,
            'images' => $imagesForCategory
        ];
    }
    $allCategorie=$categoryModel->where('status_id', 2)->orderBy('created_at', 'DESC')->findAll();
    // Retourne la vue avec les données
    return view('galleries', ['data' => $data,'allCategories' => $allCategorie]);
   }
    public function store()
    {
        $method = $this->request->getMethod();
        if ($method === 'GET') {
            $gallerieCategoryModel = new GalleriesCategoryModel();
            $gallerieCategory = $gallerieCategoryModel->where('status_id', 2)->findAll();
            return view('dashboard/new_gallerie', ['categories' => $gallerieCategory]);
        } else if ($method === 'POST') {
            // Récupérer les photos envoyées par le formulaire
            $photos = $this->request->getFiles();

            // Récupérer la catégorie sélectionnée
            $categoryName = $this->request->getPost('category_id');
            $gallerieInformation = new GalleriesInformationModel();
            $gallerytitle = $this->request->getPost('title');
            $galleryImg = $this->request->getFile('img');
            if ($galleryImg->isValid() && !$galleryImg->hasMoved()) {
                // Déplacer l'image vers le dossier de destination
                $newName = $galleryImg->getRandomName();
                $galleryImg->move(ROOTPATH . 'public/uploads', $newName);

                // Enregistrer le lien de l'image dans la base de données
                $imgPath = 'uploads/' . $newName;
            }
            $galleryInformationId = $gallerieInformation->insert([
                'name' => $gallerytitle,
                'img_principales' => $imgPath,
                'category_id' => $categoryName,
                'status_id' => 2
            ]);
            $galleriesCategoryModel = new GalleriesCategoryModel();
            $category = $galleriesCategoryModel->where('id', $categoryName)->first();
            foreach ($photos['photos'] as $photo) {
                if ($photo->isValid() && !$photo->hasMoved()) {
                    $newName = $photo->getRandomName();
                    $photo->move(ROOTPATH . 'public/uploads_galleries', $newName);
                    $galleryModel = new GalleriesModel();
                    $galleryModel->insert((array)[
                        'img' => 'uploads_galleries/' . $newName,
                        'category_id' => $category['id'],
                        'status_id' => 2,
                        'gallery_information_id' => $galleryInformationId
                    ]);
                }
            }
            session()->setFlashdata('success', ['Photos enregistrées avec succès !']);
            return redirect()->to('/admin/galeries')->withInput();
        }
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
        // Charger la vue et passer les données
        return view('formulaire/galleries_photo', ['images' => $images]);
    }

    public function category_image()
    {
        $categoryModel = new GalleriesInformationModel();
        $categories = $categoryModel->findAll(6);
        return $categories;
    }
    public function galleries_photo()
    {
        return view('formulaire/galleries_photo', ['images' => $images]);
    }

    public function update($id)
    {
        $method = $this->request->getMethod();

        if ($method === 'GET') {
            $galleryModel = new GalleriesModel();
            $galleries = $galleryModel->where('category_id', $id)->first();
            $categoryModel = new GalleriesCategoryModel();
            $categories = $categoryModel->where('id', $id)->first();
            return view('dashboard/update_gallerie', ['data' => $galleries, 'categories' => $categories]);
        } else if ($method === 'POST') {
            $rules = [
                'category' => 'required',
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            $categoryName = $this->request->getPost('category');
            $galleriesCategoryModel = new GalleriesCategoryModel();
            $category = $galleriesCategoryModel->where('name', $categoryName)->first();

            if (!$category) {
                session()->setFlashdata('errors', ['La catégorie sélectionnée n\'existe pas.']);
                return redirect()->back()->withInput()->withInput();
            }

            $photos = $this->request->getFiles();

            $galleryModel = new GalleriesModel();
            $data = [
                'category_id' => $category['id']
            ];
            $galleryModel->update($id, $data);

            foreach ($photos['photos'] as $photo) {
                if ($photo->isValid() && !$photo->hasMoved()) {
                    $newName = $photo->getRandomName();

                    $photo->move(ROOTPATH . 'public/uploads_galleries', $newName);

                    $galleryModel->insert([
                        'img' => 'uploads_galleries/' . $newName,
                        'category_id' => $category['id'],
                        'status_id' => 2
                    ]);
                }
            }

            session()->setFlashdata('success', ['Galerie mise à jour avec succès.']);
            return redirect()->to('/admin/galeries')->withInput();
        }
    }

    public function updateGallery($id)
    {

        $method = $this->request->getMethod();
        if ($method === 'GET') {
            // gallerie information
            $galleryInformation = new GalleriesInformationModel();
            $galleryInformation = $galleryInformation->where('id', $id)->first();

            // categories
            $categoryModel = new GalleriesCategoryModel();
            $categories = $categoryModel->where('status_id', 2)->findAll();
            $category = $categoryModel->where('id', $id)->first();

            // get gallery information
            $galleryModel = new GalleriesModel();
            $galleries = $galleryModel->where('gallery_information_id', $id)->where('status_id', 2)->findAll();
            return view('dashboard/update_gallerie', ["galleries" => $galleries, "categories" => $categories, "category_single" => $category, "galleryInformation" => $galleryInformation]);
        } else if ($method === 'POST') {
            // Récupérer les données du formulaire
            $categoryName = $this->request->getPost('category');
            $galleriesCategoryModel = new GalleriesCategoryModel();
            $category = $galleriesCategoryModel->where('name', $categoryName)->first();

            $gallerieInformationModel = new GalleriesInformationModel();
            $gallerieInformation = $gallerieInformationModel->where('id', $id)->first();
            $gallerieInformationImg = $this->request->getFile('img_principale');
            if ($gallerieInformationImg->isValid() && !$gallerieInformationImg->hasMoved()) {
                $newName = $gallerieInformationImg->getRandomName();
                // Déplacer le fichier vers le dossier de destination
                $gallerieInformationImg->move(ROOTPATH . 'public/uploads_galleries', $newName);
                $gallerieInformationData = [
                    'name' => $this->request->getPost('name'),
                    'img_principales' => 'uploads_galleries/' . $newName
                ];
                $gallerieInformationModel->update($id, $gallerieInformationData);
            } else {
                $gallerieInformationData = [
                    'name' => $this->request->getPost('name')
                ];
            }

            // Vérifier si la catégorie existe
            if (!$category) {
                // Rediriger avec un message d'erreur si la catégorie n'existe pas
                session()->setFlashdata('errors', ['La catégorie sélectionnée n\'existe pas.']);
                return redirect()->back()->withInput()->withInput();
            }

            // suppression des images supprime
            $deletedImg = $this->request->getPost('removedImg');
            if ($deletedImg) {
                foreach (json_decode($deletedImg) as $image) {
                    // Mettre à jour le statut de la galerie à "Supprimée" (statut_id = 3)
                    $galleryModel = new GalleriesModel();
                    $data = [
                        'status_id' => 3
                    ];
                    $galleryModel->update($image, $data);
                }
            }
            // Récupérer les photos envoyées par le formulaire
            $photos = $this->request->getFiles();
            $galleryModel = new GalleriesModel();
            $galleries = $galleryModel->findAll();
            foreach ($galleries as $gallery) {
                $inputName = 'input_' . $gallery['id'];
                if (!empty($this->request->getPost($inputName))) {
                    $galleryModel->update($gallery['id'], [
                        'name' => $this->request->getPost($inputName),
                        'category_id' => $category['id'] // Assurez-vous d'avoir $category défini au préalable
                    ]);
                }
            }
            // Enregistrer les nouvelles photos
            foreach ($photos['photos'] as $photo) {
                if ($photo->isValid() && !$photo->hasMoved()) {

                    // Générer un nouveau nom de fichier unique
                    $newName = $photo->getRandomName();

                    // Déplacer le fichier vers le dossier de destination
                    $photo->move(ROOTPATH . 'public/uploads_galleries', $newName);
                    $galleryModel = new GalleriesModel();
                    // Enregistrer le chemin du fichier dans la base de données
                    $galleryModel->insert([
                        'img' => 'uploads_galleries/' . $newName,
                        'category_id' => $category['id'], // Assurez-vous d'avoir $category défini au préalable
                        'name' => $this->request->getPost($inputName),
                        'status_id' => 2,
                        'gallery_information_id' => $gallerieInformation['id']
                    ]);
                }
            }


            // Rediriger l'utilisateur ou afficher un message de confirmation
            session()->setFlashdata('success', ['Galerie mise à jour avec succès.']);
            return redirect()->to('/admin/galeries')->withInput();
        }
    }
    public function deleteGallery($id)
    {
        $galleryInformationModel = new GalleriesInformationModel();
        $galleryInformations = $galleryInformationModel->where('id', $id)->first();

        $galleriesModel = new GalleriesModel();
        $galleries = $galleriesModel->where('gallery_information_id', $id)->findAll();
        $data = [
            'status_id' => 3
        ];
        foreach ($galleries as $gallerie) {
            $galleriesModel->update($gallerie['id'], $data);
        }
        if ($galleryInformationModel->update($id, $data)) {
            session()->setFlashdata('success', ['Galerie supprimée avec succès.']);
            return redirect()->to('/admin/galeries')->withInput();
        } else {
            session()->setFlashdata('errors', ['Échec de la suppression de la galerie.']);
            return redirect()->to('/admin/galeries')->withInput();
        }
    }
    public function delete($id)
    {
        // Mettre à jour le statut de la galerie à "Supprimée" (statut_id = 3)
        $galleryModel = new GalleriesModel();
        $image = $galleryModel->where('id', $id)->first();
        $data = [
            'status_id' => 3
        ];
        if ($galleryModel->update($id, $data)) {
            // Rediriger avec un message de succès si la suppression réussit
            session()->setFlashdata('success', ['Image supprimé avec succès.']);
            return redirect()->back()->withInput();
        } else {
            // Rediriger avec un message d'erreur si la suppression échoue
            session()->setFlashdata('errors', ['Échec de la suppression de l\'image.']);
            return redirect()->back()->withInput();
        }
    }
}
