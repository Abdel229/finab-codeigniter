<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use App\Models\SocialLinkModel;
use CodeIgniter\HTTP\ResponseInterface;

class ContactsController extends BaseController
{
    public function index()
    {
        $contactModel = new ContactModel();
        $contact = $contactModel->where('status_id', 2)->first();

        $socialLinkModel = new SocialLinkModel();
        $socialLinks=$socialLinkModel->findAll();
        if ($contact) {
            return view('/contact/index', ['contact' => $contact,'socialLinks'=>$socialLinks]);
        } else {
            return view('/contact/index');
        }
    }
    public function setPhoneNumber()
    {
        $contactModel = new ContactModel();
        $contact = $contactModel->where('status_id', 2)->first();
        $phoneNumbers = $this->request->getPost('phone');
        $response = [];

        if (isset($contact)) {
           $contactModel->update($contact['id'],[
            'phone_number' => $phoneNumbers
           ]);
            $response['success'] = true;
            $response['message'] = 'Numéro de téléphone mis à jour avec succès';
            $response['result'] = $phoneNumbers;
        } else {
            $contactModel->insert([
                'phone_number' => $phoneNumbers,
            ]);
            $response['success'] = true;
            $response['message'] = 'Numéro ajouté avec succès';
            $response['result'] = $phoneNumbers;
        }

        // Renvoyer la réponse JSON
        return $this->response->setJSON($response);
    }


    public function setEmail()
    {
        $method = $this->request->getMethod();
        $response = []; // Initialisation d'un tableau pour stocker la réponse

        if ($method == 'GET') {
            $contactModel = new ContactModel();
            $contact = $contactModel->where('status_id', 2)->first();
            if ($contact) {
                $response['success'] = true;
                $response['contact'] = $contact;
            } else {
                $response['success'] = false;
                $response['message'] = 'Aucun contact trouvé';
            }
        } elseif ($method === 'POST') {
            $contactModel = new ContactModel();
            $contacts = $contactModel->where('status_id', 2)->findAll();
            $email = $this->request->getPost('email');
            if (count($contacts) > 0) {
                $activeContact = $contacts[0];
                $contactModel->update($activeContact['id'], ['email' => $email]);
                $newContact = $contactModel->where('status_id', 2)->where('id', $activeContact['id'])->first();
                $response['success'] = true;
                $response['message'] = 'Email mis à jour avec succès';
                $response['result'] = $newContact;
            } else {
                $newContact = $contactModel->insert([
                    'email' => $email,
                    'status_id' => 2
                ]);
                $response['success'] = true;
                $response['message'] = 'Email ajouté avec succès';
                $response['result'] = $newContact;
            }
        }

        // Renvoyer la réponse JSON
        return $this->response->setJSON($response);
    }


    public function setAdresse()
    {
        $method = $this->request->getMethod();
        $response = []; // Initialisation d'un tableau pour stocker la réponse JSON

        if ($method == 'GET') {
            $contactModel = new ContactModel();
            $contact = $contactModel->where('status_id', 2)->first();
            if ($contact) {
                $response['contact'] = $contact; // Ajout du contact à la réponse
            } else {
                $response['message'] = 'Aucun contact trouvé'; // Ajout d'un message d'erreur
            }
        } elseif ($method === 'POST') {
            $contactModel = new ContactModel();
            $contacts = $contactModel->where('status_id', 2)->findAll();
            $adresse = $this->request->getPost('adresse');
            if (count($contacts) > 0) {
                $activeContact = $contacts[0];
                $contactModel->update($activeContact['id'], ['adresse' => $adresse]);
                $newContact = $contactModel->where('status_id', 2)->where('id', $activeContact['id'])->first();
                $response['message'] = 'Adresse mise à jour avec succès';
                $response['result'] = $newContact;
            } else {
                $newContact = $contactModel->insert([
                    'adresse' => $adresse,
                    'status_id' => 2
                ]);
                $response['message'] = 'Adresse ajoutée avec succès';
                $response['result'] = $newContact;
            }
        }

        return $this->response->setJSON($response);
    }

    public function setLinks()
    {
        $response=[];
        $data = [
            'facebook' => $this->request->getPost('facebook'),
            'twitter' => $this->request->getPost('twitter'),
            'instagram' => $this->request->getPost('instagram'),
            'linkedin' => $this->request->getPost('linkedin'),
        ];
        foreach ($data as $key => $value){
        $socialLinkModel = new SocialLinkModel();
            $dbElement=$socialLinkModel->where('name',$key)->first();
            if(isset($dbElement)){
                $socialLinkModel->update($dbElement['id'],['link'=>$value]);
            }else{
                $socialLinkModel->insert([
                    'name'=>$key,
                    'link'=>$value,
                    'status'=>1 //active
                ]);
            }
        }
        $socialLinkModel = new SocialLinkModel();
        $result=$socialLinkModel->findAll();
        $response['success'] = true;
        $response['message'] = 'Liens sociaux mis jour';
        $response['result'] = $result;

        return $this->response->setJSON($response);
    }
}
