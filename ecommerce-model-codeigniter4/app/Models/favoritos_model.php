<?php
namespace App\Models;
use CodeIgniter\Model;

class favoritos_model extends Model
{
    protected $table = 'favoritos';
    protected $primaryKey = 'id_usuario', 'id_producto';
    protected $allowedFields = ['id_usuario', 'id_producto', 'created_at'];
}