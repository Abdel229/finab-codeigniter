<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PartenairesModel;
use App\Models\SponsoringPartenariatModel;
use CodeIgniter\HTTP\ResponseInterface;

class PartenerController extends BaseController
{
    public function index()
    {
        $method = $this->request->getMethod();
        if ($method === 'GET') {
            $partnerSponsModel = new SponsoringPartenariatModel();
            $partner_spon = $partnerSponsModel->where('id', 1)->first();
            return view('/partner/presentation', ['data' => $partner_spon]);
        } else if ($method === 'POST') {
            $title = $this->request->getPost('title');
            $subtitle = $this->request->getPost('subtitle');
            $miniText = $this->request->getPost('mini_text');
            $principalImg = $this->request->getFile('principal_img');

            $partnerSponsModel = new SponsoringPartenariatModel();
            $partner_spon = $partnerSponsModel->where('id', 1)->first();
            if ($partner_spon) {
                // mise à jour
                $data=[
                    'title'=> $title,
                    'subtitle'=>$subtitle,
                   'mini_text'=>$miniText,
                ];
                // principal img
                if ($principalImg->isValid() && !$principalImg->hasMoved()) {
                    // Déplacer la nouvelle image vers le dossier de destination
                    $newImageName = $principalImg->getRandomName();
                    $principalImg->move(ROOTPATH . 'public/uploads', $newImageName);
    
                    $data['principal_img'] = 'uploads/' . $newImageName;
                }

                // update youtube links
                $links = [];
                foreach ($_POST as $key => $value) {
                    // Vérifier si la clé correspond à un lien
                    if (strpos($key, 'lien') === 0 && !empty($value)) {
                        // Extraire le numéro de lien de la clé
                        $linkNumber = substr($key, 4);

                        // Ajouter le lien au tableau des liens
                        $links[] = $value;
                    }
                }
                $data['videos_links']=json_encode($links);

                 // enregistrement des images additionnels
                $photos = $this->request->getFiles();
                 $additionnalImg = [];
                 foreach ($photos['photos'] as $photo) {
                     if ($photo->isValid() && !$photo->hasMoved()) {
                         $newName = $photo->getRandomName();
                         $photo->move(ROOTPATH . 'public/uploads_galleries', $newName);
                         $additionnalImg = 'uploads_galleries/' . $newName;
                     }
                 }
                 $data['images']=json_encode($additionnalImg);

                 $partnerSponsModel->update($partner_spon['id'],$data);
                 $new_partner=$partnerSponsModel->where('id',1)->first();
                return view('/partner/presentation', ['data' => $new_partner]);

            } else {
                // Création
                // enregistrement de l'image principale
                if ($principalImg->isValid() && !$principalImg->hasMoved()) {
                    // Déplacer l'image vers le dossier de destination
                    $newName = $principalImg->getRandomName();
                    $principalImg->move(ROOTPATH . 'public/uploads', $newName);

                    // Enregistrer le lien de l'image dans la base de données
                    $imgPath = 'uploads/' . $newName;
                }
                // Enregistrer des liens de vidéos
                $links = [];
                foreach ($_POST as $key => $value) {
                    // Vérifier si la clé correspond à un lien
                    if (strpos($key, 'lien') === 0 && !empty($value)) {
                        // Extraire le numéro de lien de la clé
                        $linkNumber = substr($key, 4);

                        // Ajouter le lien au tableau des liens
                        $links[] = $value;
                    }
                }

                $photos = $this->request->getFiles();
                // enregistrement des images additionnels
                $additionnalImg = [];
                foreach ($photos['photos'] as $photo) {
                    if ($photo->isValid() && !$photo->hasMoved()) {
                        $newName = $photo->getRandomName();
                        $photo->move(ROOTPATH . 'public/uploads_galleries', $newName);
                        $additionnalImg = 'uploads_galleries/' . $newName;
                    }
                }

                // enregistrement des données
                $new_partner=$partnerSponsModel->insert([
                    'title'=> $title,
                    'subtitle'=>$subtitle,
                    'principal_img'=>$imgPath,
                   'mini_text'=>$miniText,
                   'images'=>json_encode($additionnalImg),
                   'video_links'=>json_encode($links)
                ]);
                return view('/partner/presentation', ['data' => $new_partner]);


            }
        }
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
        $partenaires = $partenairesModel->where('status_id', 2)->findAll();
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
            $partnerData = [
                'titre' => $titre,
                'lien' => $lien,
            ];
            $newImageFile = $this->request->getFile('img');
            if ($newImageFile->isValid() && !$newImageFile->hasMoved()) {
                $newImageName = $newImageFile->getRandomName();
                $newImageFile->move(ROOTPATH . 'public/uploads', $newImageName);
                $partnerData['img'] = 'uploads/' . $newImageName;
            }
            $partnerModel = new PartenairesModel();
            $partnerModel->update($id, $partnerData);
            session()->setFlashdata('success', ['Partenaire mis à jour avec succès!']);
            return redirect()->to('/partner/list')->withInput();
        }
    }
    public function delete($id)
    {
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
}
