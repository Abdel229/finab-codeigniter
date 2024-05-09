<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['email', 'password', 'created_at', 'updated_at', 'role','status_id'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function filterUsers($residence, $profession)
    {
        // Commencez à construire la requête
        $builder = $this->db->table($this->table);

        // Appliquer le filtrage si au moins un des champs a une valeur
        if (!empty($residence)) {
            $builder->where('home_residence', $residence)->where('role','user');
        }
        if (!empty($profession)) {
            $builder->where('profession', $profession)->where('role','user');
        }

        // Exécutez la requête et récupérez les résultats filtrés
        return $builder->get()->getResult();
    }
    public function searchUsers($searchTerm)
    {
        // Commencez à construire la requête
        $builder = $this->db->table($this->table);

        // Appliquer le filtrage si le terme de recherche n'est pas vide
        if (!empty($searchTerm)) {
            // Utilisez OR pour rechercher dans plusieurs champs
            $builder->groupStart()
                    ->like('last_name', $searchTerm)
                    ->orLike('first_names', $searchTerm)
                    ->orLike('country', $searchTerm)
                    ->orLike('whatsapp_number', $searchTerm)
                    ->orLike('email', $searchTerm)
                    ->orLike('home_residence', $searchTerm)
                    ->orLike('profession', $searchTerm)
                    ->groupEnd();
        }

        // Ajoutez la condition pour le rôle 'user'
        $builder->where('role', 'user');

        // Exécutez la requête et récupérez les résultats filtrés
        return $builder->get()->getResult();
    }

}
