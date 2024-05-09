<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GalleriesCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class GalleriesCategoryController extends BaseController
{
    public function index()
    {
        $model = new GalleriesCategoryModel();
        $data['categories'] = $model->where('status_id',2)->findAll();

        return view('dashboard/gallerie_category', $data);
    }

    public function create()
    {
        return view('galleries_categories/create');
    }

    public function store()
    {
        $method=$this->request->getMethod();
        if($method==='GET'){
            return view('dashboard/new_gallery_category');
        }else if($method==='POST'){
            $model = new GalleriesCategoryModel();

            if ($this->validate([
                'name' => 'required',
            ])) {
                $model->save([
                    'name' => $this->request->getPost('name'),
                    'status_id' =>2,
                ]);
                session()->setFlashdata('success',['Category created successfully.']);
                return redirect()->to('admin/categories-gallerie')->withInput();
            } else {
                session()->setFlashdata('errors', ['Validation error.']);
                return redirect()->back()->withInput();
            }
        }
      
    }

    public function edit($id)
    {
       
        $model = new GalleriesCategoryModel();
        $data['category'] = $model->find($id);

        return view('galleries_categories/edit', $data);
    }

    public function update($id)
    {
        $method=$this->request->getMethod();
        if($method==='GET'){
            $model = new GalleriesCategoryModel();
            $data['category'] = $model->find($id);
            return view('dashboard/update_gallery_category', $data);
        }else if($method==='POST'){
            $model = new GalleriesCategoryModel();

            if ($this->validate([
                'name' => 'required',
            ])) {
                $model->update($id, [
                    'name' => $this->request->getPost('name'),
                    'status_id' => $this->request->getPost('status_id')?$this->request->getPost('status_id'):2,
                ]);
                session()->setFlashdata('success',['Categorie mis à jour avec succès']);
                return redirect()->to('admin/categories-gallerie')->withInput();
            } else {
                session()->setFlashdata('errors', ['Validation error.']);
                return redirect()->back()->withInput();
            }
        }
       
    }

    public function delete($id)
    {
        $model = new GalleriesCategoryModel();

        // Supprimer une catégorie en changeant son statut à "supprimé" (par exemple, statut_id = 3)
        if ($model->update($id, ['status_id' => 3])) {
            session()->setFlashdata('success',['Categorie supprimé avec succès']);
            return redirect()->to('/admin/categories-gallerie')->withInput();
        } else {
            session()->setFlashdata('errors', ['Echec de suppression de catégorie']);
            return redirect()->to('/admin/categories-gallerie')->withInput();
        }
    }
}
