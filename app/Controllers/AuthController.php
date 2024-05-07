<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return  view('formulaire/login');
    }

    public function login()
    {
        if(session()->has('user_id')){
            return redirect()->to(base_url('/admin'));
        }

        $method=$this->request->getMethod();
        if($method==='GET'){
            return view('auth/login');
        }else if($method==='POST'){

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
                    $session->set('user_name', $user->first_names . ' ' . $user->last_name);
                    return redirect()->to(base_url('/admin'))->with('success', 'Connexion réussie');
                } else {
                    session()->setFlashdata('errors', ['Mot de passe incorrect']);
                    return redirect()->back()->withInput();
                }
            } else {
                session()->setFlashdata('errors', ['Utilisateur non existant']);
                return redirect()->to(base_url('/auth/login'))->with('success', 'Utilisateur inconnue');
            }
        }
    }

    public function register()
    {
        if(session()->has('user_id')){
            return redirect()->to(base_url('/admin'));
        }
        $method = $this->request->getMethod('true');
        if ($method === 'GET') {
            return view('auth/register');
        } elseif ($method === 'POST') {
            $data = $this->request->getPost();
            // Generate rules
            $rules = [
                'email' =>'required|valid_email|is_unique[user.email]',
                'password' => 'required|min_length[8]',
                'password_confirm' => 'required|matches[password]'
            ];

            if(!$this->validate($rules)){
                session()->setFlashdata('errors', $this->validator->getErrors());
                return redirect()->to(base_url('/auth/register'))->with('success', 'Une erreur est survenu');;
            }
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            // Register
            $user = new \App\Models\User();
            $user->save($data);
            return redirect()->to(base_url('admin'))->with('success', 'Registered successfully!');
        }

    }
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/auth/login'));
    }
}
