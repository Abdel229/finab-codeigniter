<?php

namespace App\Controllers;

use App\Models\ArticlesCategoryModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ArticlesCategoryController extends BaseController
{
    public function index()
    {
        $categoryModel = new ArticlesCategoryModel();
        $categories = $categoryModel->where('status_id',2)->findAll();

        return view('dashboard/article_category', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories/create');
    }

    public function store()
    {
        $categoryModel = new ArticlesCategoryModel();

        // Récupérer les données du formulaire
        $data = [
            'name' => $this->request->getPost('name'),
            'status_id' => 2
        ];

        // Valider les données
        if (!$categoryModel->save($data)) {
            // En cas d'échec de validation, rediriger avec un message d'erreur
            return redirect()->back()->withInput()->with('error', 'Failed to create category.');
        }

        // Redirection avec un message de succès si la catégorie est enregistrée avec succès
        return redirect()->to('/categories')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $categoryModel = new ArticlesCategoryModel();
        $category = $categoryModel->find($id);

        return view('categories/edit', ['category' => $category]);
    }

    public function update($id)
    {
        $method = $this->request->getMethod();
        if ($method === 'GET') {
            $categoryModel = new ArticlesCategoryModel();
            $category = $categoryModel->find($id);
            return view('dashboard/update_article_category', ['category' => $category]);
        } else if ($method === 'POST') {
            $categoryModel = new ArticlesCategoryModel();

            // Récupérer les données du formulaire
            $data = [
                'name' => $this->request->getPost('name'),
            ];

            // Mettre à jour la catégorie dans la base de données
            if (!$categoryModel->update($id, $data)) {
                // En cas d'échec de mise à jour, rediriger avec un message d'erreur
                return redirect()->back()->withInput()->with('error', 'Failed to update category.');
            }

            // Redirection avec un message de succès si la mise à jour réussit
            return redirect()->to('/admin/categories')->with('success', 'Category updated successfully.');
        }
    }

    public function delete($id)
    {
        $categoryModel = new ArticlesCategoryModel();

        // Modifier le statut de la catégorie à "Supprimé"
        $data = [
            'status_id' => 3 // Assume que le statut "Supprimé" a l'ID 3
        ];

        // Mettre à jour le statut de la catégorie dans la base de données
        if (!$categoryModel->update($id, $data)) {
            // En cas d'échec de mise à jour, rediriger avec un message d'erreur
            return redirect()->back()->with('error', 'Failed to delete category.');
        }

        // Redirection avec un message de succès si la suppression réussit
        return redirect()->to('/admin/catgories')->with('success', 'Category deleted successfully.');
    }
}
