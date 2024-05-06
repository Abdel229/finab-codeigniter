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
        $data['categories'] = $model->findAll();

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
    
                return redirect()->to('admin/categories-gallerie')->with('success', 'Category created successfully.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Validation error.');
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
    
                return redirect()->to('/admin/categories-gallerie')->with('success', 'Category updated successfully.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Validation error.');
            }
        }
       
    }

    public function delete($id)
    {
        $model = new GalleriesCategoryModel();

        // Supprimer une catégorie en changeant son statut à "supprimé" (par exemple, statut_id = 3)
        if ($model->update($id, ['status_id' => 3])) {
            return redirect()->to('/admin/categories-gallerie')->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->to('/admin/categories-gallerie')->with('error', 'Failed to delete category.');
        }
    }
}
