<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use App\Models\MessageModel;
use App\Services\EmailService;
use CodeIgniter\HTTP\ResponseInterface;

class MessagesController extends BaseController
{
    public function index()
    {
        return view('/messages/index');
    }
    public function store(){
            $rules = [
                'nom_prenom' => 'required|max_length[255]',
                'email' => 'required',
                'object' => 'required',
                'message' => 'required',
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->to()->withInput();
            }
            $data = [
                'name' => $this->request->getPost('nom_prenom'),
                'email' => $this->request->getPost('email'),
                'object' => $this->request->getPost('object'),
               'message' => $this->request->getPost('message'),
               'status_id'=>2,
               'read_statut'=>1
            ];
            $messageModel=new MessageModel();
            $message=$messageModel->insert($data);
            $emailService = new EmailService();

            $to = 'bertrandorouganni@gmail.com';
            $subject = 'Demande de partenariat pour Finab';
            $body = '<h1>Votre message a été reçu avec succès</h1>';
    
            if ($emailService->sendMail($to, $subject, $body)) {
                echo "Email has been sent successfully.";
            } else {
                echo "Failed to send email.";
            }
            session()->setFlashdata('success', ['Message envoyé avec succès!']);
            return redirect()->to('/contact')->withInput();
    }

    public function delete($id){
        $contactModel = new MessageModel();
        $contact = $contactModel->where('id', $id);

        if (!$contact) {
            session()->setFlashdata('errors', ['Message non trouvé']);
                return redirect()->back()->withInput();
        }

        $contactModel->update($id, ['status_id' => 3]);

        session()->setFlashdata('success', ['Message supprimé avec succès']);
                return redirect()->back()->withInput();

    }

    public function setRead($id){
        $contactModel = new MessageModel();
        $contact = $contactModel->where('id', $id)->first();

        if (!$contact) {
            session()->setFlashdata('errors', ['Message non trouvé']);
                return redirect()->back()->withInput();
        }

        $contactModel->update($id, ['read_statut' => 2]);

        session()->setFlashdata('success', ['Message lu avec succès']);
                return redirect()->back()->withInput();

    }

    public function setUnRead($id){
        $contactModel = new MessageModel();
        $contact = $contactModel->where('id', $id);

        if (!$contact) {
            session()->setFlashdata('errors', ['Message non trouvé']);
                return redirect()->back()->withInput();
        }

        $contactModel->update($id, ['read_statut' => 1]);

        session()->setFlashdata('success', ['Message marqué comme non lus']);
                return redirect()->back()->withInput();

    }
    public function fetchMessages(){
        $messageModel=new MessageModel();
        $messages=$messageModel->where('status_id',2)->findAll();
        return $this->response->setJSON($messages);
    }
}
