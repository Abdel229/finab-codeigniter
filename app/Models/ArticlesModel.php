<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticlesModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'img', 'description', 'date_pub', 'category_id', 'status_id', 'created_at', 'updated_at'];

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
        'category_id' => [
            'model' => 'ArticlesCategoryModel',
            'foreign_key' => 'category_id'
        ],
        'status' => [
            'model' => 'StatusModel',
            'foreign_key' => 'status_id'
        ]
    ];
}
