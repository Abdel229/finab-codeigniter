<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContactModel;
use CodeIgniter\HTTP\ResponseInterface;

class ContactsController extends BaseController
{
    public function index()
    {
        $contactModel = new ContactModel();
        $contact = $contactModel->where('status_id', 2)->first();
        if ($contact) {
            return view('/contact/index', ['contact' => $contact]);
        } else {
            return view('/contact/index');
        }
    }
    public function setPhoneNumber()
    {
        $contactModel = new ContactModel();
        $contacts = $contactModel->where('status_id', 2)->findAll();
        $phoneNumber = $this->request->getPost('phoneNumber');
        if (count($contacts) > 0) {
            $activeContact = $contacts[0];
            $contactModel->update($activeContact['id'], ['phone_number' => $phoneNumber]);
            session()->setFlashdata('success', ['Numéro de téléphone mis à jour avec succès']);
            return redirect()->back()->withInput();
        } else {
            $contactModel->insert([
                'phone_number' => $phoneNumber,
                'status_id' => 2
            ]);
            session()->setFlashdata('success', ['Numéro ajouté avec succè']);
            return redirect()->back()->withInput();
        }
    }

    public function setEmail()
    {
        $method = $this->request->getMethod();
        if ($method == 'GET') {
            $contactModel = new ContactModel();
            $contact = $contactModel->where('status_id', 2)->first();
            if ($contact) {
                return view('/contact/email', ['contact' => $contact]);
            } else {
                return view('/contact/email');
            }
        } elseif ($method === 'POST') {
            $contactModel = new ContactModel();
            $contacts = $contactModel->where('status_id', 2)->findAll();
            $email = $this->request->getPost('email');
            if (count($contacts) > 0) {
                $activeContact = $contacts[0];
                $contactModel->update($activeContact['id'], ['email' => $email]);
                session()->setFlashdata('success', ['Email mis à jour avec succès']);
                return redirect()->back()->withInput();
            } else {
                $contactModel->insert([
                    'email' => $email,
                    'status_id' => 2
                ]);
                session()->setFlashdata('success', ['Email ajouté avec succè']);
                return redirect()->back()->withInput();
            }
        }
    }

    public function setAdresse()
    {
        $method = $this->request->getMethod();
        if ($method == 'GET') {
            $contactModel = new ContactModel();
            $contact = $contactModel->where('status_id', 2)->first();
            if ($contact) {
                return view('/contact/adresse', ['contact' => $contact]);
            } else {
                return view('/contact/adresse');
            }
        } elseif ($method === 'POST') {
            $contactModel = new ContactModel();
            $contacts = $contactModel->where('status_id', 2)->findAll();
            $adresse = $this->request->getPost('adresse');
            if (count($contacts) > 0) {
                $activeContact = $contacts[0];
                $contactModel->update($activeContact['id'], ['adresse' => $adresse]);
                session()->setFlashdata('success', ['Adresse mis à jour avec succès']);
                return redirect()->back()->withInput();
            } else {
                $contactModel->insert([
                    'adresse' => $adresse,
                    'status_id' => 2
                ]);
                session()->setFlashdata('success', ['Adresse ajouté avec succès']);
                return redirect()->back()->withInput();
            }
        }
    }
}
