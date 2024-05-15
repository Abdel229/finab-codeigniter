<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UsersController extends BaseController
{
    public function index(){
        return view('dashboard/all_users');
    }
    public function fetchusers(){
        $userModel=new User();
        $users=$userModel->where('status_id',2)->orWhere('status_id',1)->orderBy('id', 'DESC')->findAll();
        return $this->response->setJSON($users);
    }

    public function store(){
        $method = $this->request->getMethod('true');
        if ($method === 'GET') {
            return view('dashboard/new_user');
        } elseif ($method === 'POST') {
            $data = $this->request->getPost();
            // Generate rules
            $rules = [
                'email' =>'required|valid_email|is_unique[user.email]',
                'password' => 'required|min_length[8]',
                'role' => 'required'
            ];

            if(!$this->validate($rules)){
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->to(base_url('/users/store'))->with('success', 'Une erreur est survenu');;
            }
            $data['status_id']=2;
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            // Register
            $user = new \App\Models\User();
            $user->save($data);
            session()->setFlashdata('success', ['Registered successfully!']);
                return redirect()->to(base_url('users'))->withInput();
        }
    }

    public function block($id){
        $userId = session()->get('user_id');
        if ($userId === $id) {
            session()->setFlashdata('errors', ['Blockage échoué']);
            return redirect()->back();
        }
        $userModel = new User();
        $data = [
            'status_id' => 1
        ];

        if (!$userModel->update($id, $data)) {
            session()->setFlashdata('errors', ['Blockage échoué']);
            return redirect()->back()->withInput();
        }
        session()->setFlashdata('success',['Blockage réussi']);
        return redirect()->to('/users')->withInput();
    }

    public function unblock($id){

        $userModel = new User();
        $data = [
            'status_id' => 2
        ];

        if (!$userModel->update($id, $data)) {
            session()->setFlashdata('errors', ['Débloquage échoué']);
            return redirect()->back()->withInput();
        }
        session()->setFlashdata('success',['Débloquage réussi']);
        return redirect()->to('/users')->withInput();
    }
    public function delete($id){
        $userId = session()->get('user_id');
        if ($userId === $id) {
            session()->setFlashdata('errors', ['Suppression échoué']);
            return redirect()->back();
        }
        $userModel = new User();
        $data = [
            'status_id' => 3
        ];

        if (!$userModel->update($id, $data)) {
            session()->setFlashdata('errors', ['Erreur lors de la suppression de l\utilisateur']);
            return redirect()->back()->withInput();
        }
        session()->setFlashdata('success',['Suppression de l\'utilisateur réussi']);
        return redirect()->to('/users')->withInput();
    }
}
