<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

namespace App\Controllers;

class Api extends BaseController {
    public function get_data() {
       
        $data = array(
            array(
                'id' => 1,
                'name' => 'Finab 2023'
            ),
            array(
                'id' => 2,
                'name' => 'finab 2024'
            ),
            array(
                'id' => 3,
                'name' => 'finab 2025'
            ),
            array(
                'id' => 4,
                'name' => 'finab 2026'
            ),
            array(
                'id' => 5,
                'name' => 'finab 2027'
            ),
        );
    
        // Envoyer les données sous forme de réponse JSON
        return $this->response->setJSON($data);
    }
}

