<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticlesCategoryModel extends Model
{
    protected $table = 'articles_category';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['name', 'status_id', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = '';

    protected $useForeignKeys = true;
    protected $belongsTo = [
        'status' => [
            'model' => 'StatusModel',
            'foreign_key' => 'status_id'
        ]
    ];

    // Validation rules
    protected $validationRules = [
        'name' => 'required',
        'status_id' => 'required|integer'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Le nom de la catégorie est requis.'
        ],
        'status_id' => [
            'required' => 'L\'identifiant du statut est requis.',
            'integer' => 'L\'identifiant du statut doit être un entier.'
        ]
    ];
}
