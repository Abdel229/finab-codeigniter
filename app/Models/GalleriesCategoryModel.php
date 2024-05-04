<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleriesCategoryModel extends Model
{
    protected $table = 'galleries_category';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'status_id', 'created_at', 'updated_at'];

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
        'status' => [
            'model' => 'StatusModel',
            'foreign_key' => 'status_id'
        ]
    ];
}
