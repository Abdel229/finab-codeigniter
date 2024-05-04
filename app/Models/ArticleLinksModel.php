<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleLinksModel extends Model
{
    protected $table = 'article_links';
    protected $primaryKey = 'id';
    protected $allowedFields = ['link', 'status_id', 'article_id', 'created_at', 'updated_at'];

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
        'article' => [
            'model' => 'ArticleModel',
            'foreign_key' => 'article_id'
        ],
        'status' => [
            'model' => 'StatusModel',
            'foreign_key' => 'status_id'
        ]
    ];
}
