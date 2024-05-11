<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use CodeIgniter\HTTP\ResponseInterface;

class ContactsController extends BaseController
{
    public function index()
    {
        return view('/contact/index');
    }
    public function store(){
            
            $rules = [
                'nom_prenom' => 'required|max_length[255]',
                'email' => 'required',
                'objet' => 'required',
                'message' => 'required',
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
            $data = [
                'name' => $this->request->getPost('nom_prenom'),
                'email' => $this->request->getPost('email'),
                'object' => $this->request->getPost('object'),
               'message' => $this->request->getPost('message'),
               'status_id'=>2,
               'read_statut'=>1
            ];
            $contactModel=new ContactModel();
            $contact=$contactModel->insert($data);
            session()->setFlashdata('success', ['Message envoyé avec succès!']);
            return redirect()->to('/contact')->withInput();
    }

    public function delete($id){
        $contactModel = new ContactModel();
        $contact = $contactModel->where('id', $id);

        if (!$contact) {
            session()->setFlashdata('errors', ['Message non trouvé']);
                return redirect()->back()->withInput();
        }

        $contact->update($id, ['status_id' => 3]);

        session()->setFlashdata('success', ['Article supprimé avec succès']);
                return redirect()->back()->withInput();

    }
}
