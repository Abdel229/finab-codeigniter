<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleriesModel extends Model
{
    protected $table = 'galleries';
    protected $primaryKey = 'id';
    protected $allowedFields = ['img', 'category_id', 'status_id', 'created_at', 'updated_at'];

    protected $useTimestamps = true;

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $useSoftDeletes = false;

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = '';

    protected $useForeignKeys = true;
    protected $belongsTo = [
        'category' => [
            'model' => 'GalleriesCategoryModel',
            'foreign_key' => 'category_id'
        ],
        'status' => [
            'model' => 'StatusModel',
            'foreign_key' => 'status_id'
        ]
    ];
}
