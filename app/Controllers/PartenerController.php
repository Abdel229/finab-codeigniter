<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PartenairesModel;
use CodeIgniter\HTTP\ResponseInterface;

class PartenerController extends BaseController
{
    public function index()
    {
        return view('/partner/presentation');
    }
    public function index_demande()
    {
        return view('/partner/demande');
    }
    public function index_partners()
    {
        return view('partner/list_partners');
    }
    
    public function fetchParters()
    {
        $partenairesModel = new PartenairesModel();
        $partenaires = $partenairesModel->where('status_id',2)->orWhere('status_id',3)->orderBy('id', 'DESC')->findAll();
        return $this->response->setJSON($partenaires);
    }
    public function store()
    {
        $method = $this->request->getMethod();
        if ($method === 'GET') {
            return view('partner/new_partner');
        } else if ($method === 'POST') {
            $rules = [
                'titre' => 'required|max_length[255]',
                'img' => 'required|uploaded[img]',
                'lien' => 'required|max_length[255]'
            ];
            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
            }
            $titre = $this->request->getPost('titre');
            $lien = $this->request->getPost('lien');
            $img = $this->request->getFile('img');
            if ($img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $img->move(ROOTPATH . 'public/uploads', $newName);
                $imgPath = 'uploads/' . $newName;
            }
            $partenaireModel = new PartenairesModel();
            $partenaireModel->insert([
                'titre' => $titre,
                'lien' => $lien,
                'img' => $imgPath,
                'status_id' => 2
            ]);
            session()->setFlashdata('success', ['Partnenaire ajouté avec succès!']);
            return redirect()->to('/partner/list')->withInput();
        }
    }
    public function update($id)
    {
        $method = $this->request->getMethod();
        if ($method === 'GET') {
            $partenairesModel = new PartenairesModel();
            $partenaire = $partenairesModel->where('id', $id)->first();
            return view('partner/update_partner', ['partenaire' => $partenaire]);
        } else if ($method === 'POST') {
            $rules = [
                'titre' => 'required|max_length[255]',
                'lien' => 'required|max_length[255]'
            ];
            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }
            $titre = $this->request->getPost('titre');
            $lien = $this->request->getPost('lien');
            $partnerData=[
                'title' => $titre,
                'link' => $lien,
            ];
            $newImageFile = $this->request->getFile('img');
            if ($newImageFile->isValid() && !$newImageFile->hasMoved()) {
                $newImageName = $newImageFile->getRandomName();
                $newImageFile->move(ROOTPATH . 'public/uploads', $newImageName);
                $partnerData['img'] = 'uploads/' . $newImageName;
            }
            $partnerModel=new PartenairesModel();
            $partnerModel->update($id,$partnerData);
            session()->setFlashdata('success', ['Partenaire mis à jour avec succès!']);
                return redirect()->to('/partner/list')->withInput();
        }
    }
    public function delete($id){
        $partnerModel = new PartenairesModel();
        $partner = $partnerModel->find($id);

        if (!$partner) {
            session()->setFlashdata('errors', ['Article not found']);
                return redirect()->back()->withInput();
        }

        $partnerModel->update($id, ['status_id' => 3]);

        session()->setFlashdata('success', ['Partenaire supprimé avec succès']);
                return redirect()->back()->withInput();
    }
    public function Activer($id){
        $partnerModel = new PartenairesModel();
        $partner = $partnerModel->find($id);

        if (!$partner) {
            session()->setFlashdata('errors', ['Article not found']);
                return redirect()->back()->withInput();
        }

        $partnerModel->update($id, ['status_id' => 2]);

        session()->setFlashdata('success', ['Partenaire a été activer']);
                return redirect()->back()->withInput();
    }
    public function become_partner()
    {
        $method = $this->request->getMethod();
        if ($method === 'GET') {
            return view('become_partners');
        } else if ($method === 'POST') {
            $rules = [
                'nom' => 'required|max_length[255]',
                'email' => 'required|max_length[255]',
                'tel' => 'required|max_length[12]',
                'user_name' => 'required|max_length[255]',
                'lien' => 'max_length[255]',
                'object' => 'required|max_length[255]',
                'message' => 'required|max_length[1000]'
            ];
            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->to('/partner/become_partner')->withInput();;
            }
            $titre = $this->request->getPost('nom');
            $img = $this->request->getFile('img_partner');
            $email = $this->request->getPost('email');
            $phone = $this->request->getPost('tel');
            $user_name = $this->request->getPost('user_name');
            $link = $this->request->getPost('lien');
            $object = $this->request->getPost('object');
            $query = $this->request->getPost('message');
            // dd($img);
            if ($img->isValid() && !$img->hasMoved()) {
                $newName = $img->getRandomName();
                $img->move(ROOTPATH . 'public/uploads', $newName);
                $imgPath = 'uploads/' . $newName;
            }
            $partenaireModel = new PartenairesModel();
            if ($link) {
                $partenaireModel->insert([
                    'title' => $titre,
                    'img' => $imgPath,
                    'status_id' => 1,
                    'link' => $link,
                    'email' => $email,
                    'phone' => $phone,
                    'user_name' => $user_name,
                    'object' => $object,
                    'query' => $query
                ]);
            } else {
                $partenaireModel->insert([
                    'title' => $titre,
                    'img' => $imgPath,
                    'status_id' => 1,
                    'link' => '',
                    'email' => $email,
                    'phone' => $phone,
                    'user_name' => $user_name,
                    'object' => $object,
                    'query' => $query
                ]);
            }
            session()->setFlashdata('success', ['Votre demande a été envoyée avec succès']);
            return redirect()->to('/partner/become_partner')->withInput();
        }
    }
    public function fetchBecomePartners()
    {
        $partenairesModel = new PartenairesModel();
        $partenaires = $partenairesModel->where('status_id',1)->orderBy('id', 'DESC')->findAll();
        return $this->response->setJSON($partenaires);
    }
    public function Accepted($id){
        $partnerModel = new PartenairesModel();
        $partner = $partnerModel->find($id);

        if (!$partner) {
            session()->setFlashdata('errors', ['Article not found']);
                return redirect()->back()->withInput();
        }
        // Obtenir la date et l'heure actuelles
        $dateHeureActuelle = new \DateTime();

        // Formater la date et l'heure pour MySQL (optionnel)
        $dateHeureFormatMySQL = $dateHeureActuelle->format('Y-m-d H:i:s');

        $partnerModel->update($id, ['status_id' => 3,'accepted_at'=>$dateHeureFormatMySQL]);

        session()->setFlashdata('success', ['Partenaire supprimé avec succès']);
                return redirect()->back()->withInput();
    }
    public function Refused($id){
        $partnerModel = new PartenairesModel();
        $partner = $partnerModel->find($id);

        if (!$partner) {
            session()->setFlashdata('errors', ['Article not found']);
                return redirect()->back()->withInput();
        }
        // Obtenir la date et l'heure actuelles
        $dateHeureActuelle = new \DateTime();

        // Formater la date et l'heure pour MySQL (optionnel)
        $dateHeureFormatMySQL = $dateHeureActuelle->format('Y-m-d H:i:s');
        // dd($dateHeureFormatMySQL);

        $partnerModel->update($id, ['status_id' => 5,'accepted_at'=>$dateHeureFormatMySQL]);

        session()->setFlashdata('success', ['Partenaire a été activer']);
                return redirect()->back()->withInput();
    }
}
