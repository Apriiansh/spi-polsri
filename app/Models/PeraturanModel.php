<?php

namespace App\Models;

use CodeIgniter\Model;

class PeraturanModel extends Model
{
    protected $table            = 'peraturan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'judul',
        'kategori',
        'peraturan',
        'file_lampiran',
        'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get peraturan with user information
     */
    public function getPeraturanWithUser($id = null)
    {
        $builder = $this->db->table($this->table)
            ->select('peraturan.*, users.username, users.email')
            ->join('users', 'users.id = peraturan.user_id', 'left');

        if ($id !== null) {
            return $builder->where('peraturan.id', $id)->get()->getRowArray();
        }

        return $builder->get()->getResultArray();
    }

    /**
     * Get peraturan by kategori
     */
    public function getByKategori($kategori, $status = 'published')
    {
        return $this->where('kategori', $kategori)
            ->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Get peraturan by user
     */
    public function getByUser($userId)
    {
        return $this->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }

    /**
     * Search peraturan
     */
    public function searchPeraturan($keyword, $kategori = null)
    {
        $builder = $this->builder();

        $builder->groupStart()
            ->like('judul', $keyword)
            ->orLike('peraturan', $keyword)
            ->groupEnd();

        if ($kategori) {
            $builder->where('kategori', $kategori);
        }

        return $builder->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}
