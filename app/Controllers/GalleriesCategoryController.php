<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GalleriesCategoryController extends BaseController
{
    public function index()
    {
        $model = new GalleriesCategoryModel();
        $data['categories'] = $model->findAll();

        return view('galleries_categories/index', $data);
    }

    public function create()
    {
        return view('galleries_categories/create');
    }

    public function store()
    {
        $model = new GalleriesCategoryModel();

        if ($this->validate([
            'name' => 'required',
        ])) {
            $model->save([
                'name' => $this->request->getPost('name'),
                'status_id' =>2,
            ]);

            return redirect()->to('/galleries_category')->with('success', 'Category created successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Validation error.');
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
        $model = new GalleriesCategoryModel();

        if ($this->validate([
            'name' => 'required',
            'status_id' => 'required|integer',
        ])) {
            $model->update($id, [
                'name' => $this->request->getPost('name'),
                'status_id' => $this->request->getPost('status_id'),
            ]);

            return redirect()->to('/galleries_category')->with('success', 'Category updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Validation error.');
        }
    }

    public function delete($id)
    {
        $model = new GalleriesCategoryModel();

        // Supprimer une catégorie en changeant son statut à "supprimé" (par exemple, statut_id = 3)
        if ($model->update($id, ['status_id' => 3])) {
            return redirect()->to('/galleries_category')->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->to('/galleries_category')->with('error', 'Failed to delete category.');
        }
    }
}
