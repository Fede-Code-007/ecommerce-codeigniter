<?php
namespace App\Models;
use CodeIgniter\Model;

class perfiles_model extends Model
{
    protected $table = 'perfiles';
    protected $primaryKey = 'perfil_id';
    protected $allowedFields = ['descripcion', 'created_at'];
}