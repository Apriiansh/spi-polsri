<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table            = 'articles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'title',
        'slug',
        'content',
        'status'
    ];

    public function getArticlesWithUser()
    {
        return $this->select('articles.*, users.username')
            ->join('users', 'users.id = articles.user_id')
            ->orderBy('articles.created_at', 'DESC')
            ->findAll();
    }

    public function getArticleBySlugWithUser($slug)
    {
        return $this->select('articles.*, users.username')
            ->join('users', 'users.id = articles.user_id')
            ->where('articles.slug', $slug)
            ->first();
    }

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
