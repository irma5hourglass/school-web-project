<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelekstrakurikuler extends Model
{
    protected $table      = 'ekstrakurikuler';
    protected $primaryKey = 'ekstra_id';
    protected $allowedFields = ['nama_ekstra', 'gbr'];

    //backend
    public function list()
    {
        return $this->table('ekstrakurikuler')
            ->orderBy('nama_ekstra', 'ASC')
            ->get()->getResultArray();
    }
}
