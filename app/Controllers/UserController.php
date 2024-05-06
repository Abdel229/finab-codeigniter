<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        return  view('formulaire/login');
    }

    public function login()
    {
        
    
        $data = $this->request->getPost();
        // Generate rules
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]'
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
    
        $email = $data['email'];
        $password = $data['password'];
        $userModel = new \App\Models\User();
        $user = $userModel->where('email', $email)->first();
    
        if ($user) {
            if (password_verify($password, $user->password)) {
                $session = session();
                $session->set('user_id', $user->id);
                $session->set('user_role', $user->role);
                $session->set('user_name', $user->first_names . ' ' . $user->last_name);
                return redirect()->to(base_url('/login'))->with('success', 'Connexion réussie');
            } else {
                session()->setFlashdata('errors', 'Mot de passe incorrect');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('errors', 'Email invalide');
            return redirect()->back()->withInput();
        }
    }
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}
