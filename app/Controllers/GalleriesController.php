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
        
        return view('galleries');
    }
   
    public function store()
    {
        $method = $this->request->getMethod();
        if ($method === 'GET') {
            $gallerieCategoryModel = new GalleriesCategoryModel();
            $gallerieCategory = $gallerieCategoryModel->where('status_id',2)->findAll();
            return view('dashboard/new_gallerie', ['categories' => $gallerieCategory]);
        } else if ($method === 'POST') {
            // Récupérer les photos envoyées par le formulaire
            $photos = $this->request->getFiles();

            // Récupérer la catégorie sélectionnée
            $categoryName = $this->request->getPost('category_id');
            $galleriesCategoryModel = new GalleriesCategoryModel();
            $category = $galleriesCategoryModel->where('id', $categoryName)->first();

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
            return redirect()->to('/admin/galeries')->with('success', 'Photos enregistrées avec succès !');
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
        $categoryModel = new GalleriesCategoryModel();
        $categories = $categoryModel->findAll(6);

        $data = [];
        foreach ($categories as $category) {
            $imagesModel = new GalleriesModel();
            $image = $imagesModel->where('category_id', $category['id'])->findAll(1);
            if(!$image){
                continue;
            }
            $data[] = [
                'category' => $category,
                'image' => $image[0]
            ];
        }
        return $data;
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
                return redirect()->back()->withInput()->with('error', 'La catégorie sélectionnée n\'existe pas.');
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

            return redirect()->to('/')->with('success', 'Galerie mise à jour avec succès.');
        }
    }

    public function updateGallery($id)
    {
        
        $method = $this->request->getMethod();
        if ($method === 'GET') {
            $galleryModel = new GalleriesModel();
            $galleries = $galleryModel->where('category_id', $id)->where('status_id',2)->findAll();
            $categoryModel = new GalleriesCategoryModel();
            $categories = $categoryModel->where('status_id',2)->findAll();
            $category = $categoryModel->where('id', $id)->first();
            return view('dashboard/update_gallerie', ["galleries"=>$galleries,"categories"=>$categories,"category_single"=>$category]);
        } else if ($method === 'POST') {
            
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

                // // Vérifier si une nouvelle image a été téléchargée pour cette galerie
                // $photos = $photos['photos'];
                // dd($photos);
                // foreach($photos as $photo){

                // }
                // if ($photo && $photo->isValid() && !$photo->hasMoved()) {
                //     // Générer un nouveau nom de fichier unique
                //     $newName = $photo->getRandomName();

                //     // Déplacer le fichier vers le dossier de destination
                //     $photo->move(ROOTPATH . 'public/uploads_galleries', $newName);

                //     // Mettre à jour le chemin de l'image dans la base de données
                //     $galleryModel->update($gallery['id'], [
                //         'img' => 'uploads_galleries/' . $newName,
                //         'status_id' => 2
                //     ]);
                // }
            }
            // Enregistrer les nouvelles photos
            foreach ($photos['photos'] as $index => $photo) {
                // Vérifier si l'input correspondant à cette photo a été rempli
                // $inputName = 'input_' . $index;
                // if (!empty($this->request->getPost($inputName))) {
                //     if ($photo->isValid() && !$photo->hasMoved()) {
                        // Générer un nouveau nom de fichier unique
                        $newName = $photo->getRandomName();

                        // Déplacer le fichier vers le dossier de destination
                        $photo->move(ROOTPATH . 'public/uploads_galleries', $newName);

                        // Enregistrer le chemin du fichier dans la base de données
                        $galleryModel->insert([
                            'img' => 'uploads_galleries/' . $newName,
                            'category_id' => $category['id'], // Assurez-vous d'avoir $category défini au préalable
                            'name' => $this->request->getPost($inputName),
                            'status_id' => 2
                        ]);
                    }
            //     }
            // }


        
            // Rediriger l'utilisateur ou afficher un message de confirmation
            return redirect()->to('/admin/galeries')->with('success', 'Galerie mise à jour avec succès.');
        }
        
    }


    public function deleteGallery($id)
    {
        $galleryModel = new GalleriesCategoryModel();
        $data = [
            'status_id' => 3
        ];
        if ($galleryModel->update($id, $data)) {
            return redirect()->to('/admin/galeries')->with('success', 'Galerie supprimée avec succès.');
        } else {
            return redirect()->to('/admin/galeries')->with('error', 'Échec de la suppression de la galerie.');
        }
    }
    public function delete($id)
    {
        // Mettre à jour le statut de la galerie à "Supprimée" (statut_id = 3)
        $galleryModel = new GalleriesModel();
        $image=$galleryModel->where('id', $id)->first();
        $categoryModel=new GalleriesCategoryModel();
        $category=$categoryModel->where('id', $image['category_id'])->first();
        $data = [
            'status_id' => 3
        ];
        if ($galleryModel->update($id, $data)) {
            // Rediriger avec un message de succès si la suppression réussit
            return redirect()->to('/galleries/update/'.$category['id'])->with('success', 'Galerie mise à jour avec succès.');

        } else {
            // Rediriger avec un message d'erreur si la suppression échoue
            return redirect()->to('/')->with('error', 'Échec de la suppression de la galerie.');
        }
    }
}
