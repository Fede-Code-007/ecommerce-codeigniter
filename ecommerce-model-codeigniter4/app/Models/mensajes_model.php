<?php
namespace App\Models;
use CodeIgniter\Model;

class mensajes_model extends Model
{
    protected $table = 'mensajes';
    protected $primaryKey = 'id_mensaje';
    protected $allowedFields = ['fecha_envio','fuente','nombre_emisor', 'nombre_usuario', 'email','telefono', 'mensaje', 'estado','created_at'];
}