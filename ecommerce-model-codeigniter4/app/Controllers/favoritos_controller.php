<?php

namespace App\Controllers;
use CodeIgniter\Controller;
Use App\Models\productos_model;
Use App\Models\usuario_model;
Use App\Models\favoritos_model;


class favoritos_controller extends BaseController
{
    public function agregarFavorito($idProducto)
    {
        $idUsuario = session()->get('id_usuario');
        
        if (is_int($idProducto) && is_int($idUsuario)) {
            try {
                $favoritoModel = new favoritos_model();
                
                // Validar si el producto ya está en favoritos
                $existeFav = $favoritoModel->where([
                    'id_usuario' => $idUsuario,
                    'id_producto' => $idProducto
                ])->first();
                
                if ($existeFav) {
                    session()->setFlashdata('success', 'Producto añadido a favoritos!');
                } else {
                    $favoritoModel->save([
                        'id_usuario' => $idUsuario,
                        'id_producto' => $idProducto,
                    ]);
                    session()->setFlashdata('success', 'Producto añadido a favoritos!');
                }
            } catch (\Exception $e) {
                // Manejar errores de base de datos
                session()->setFlashdata('fail', 'Error al añadir el producto a favoritos: ' . $e->getMessage());
            }
        } else {
            session()->setFlashdata('fail', 'Oh no! ha ocurrido un problema. Intente nuevamente');
        }
        return redirect()->back();
    }

    public function quitarFavorito($idProducto)
    {
        $idUsuario = session()->get('id_usuario');
        
        if (is_int($idProducto) && is_int($idUsuario)) {
            try {
                $favoritoModel = new favoritos_model();
                // Comprobar si el registro existe
                $favorito = $favoritoModel->where([
                    'id_usuario' => $idUsuario,
                    'id_producto' => $idProducto
                ])->first();
                
                if ($favorito) {
                    // Eliminar el registro
                    $favoritoModel->where([
                        'id_usuario' => $idUsuario,
                        'id_producto' => $idProducto
                    ])->delete();
                    
                    session()->setFlashdata('success', 'Producto eliminado de favoritos!');
                } else {
                    session()->setFlashdata('success', 'Producto eliminado de favoritos!');
                }
            } catch (\Exception $e) {
                // Manejar errores de base de datos
                session()->setFlashdata('fail', 'Error al eliminar el producto de favoritos: ' . $e->getMessage());
            }
        } else {
            session()->setFlashdata('fail', 'Oh no! ha ocurrido un problema. Intente nuevamente');
        }
        return redirect()->back();
    }

    public function mostrarFavoritos(){
        $idUsuario = session()->get('id_usuario');
        $favoritoModel = new favoritos_model();
        $favoritos = $favoritoModel->where('id_usuario', $idUsuario)->findAll();

        $productosFavoritos = [];
        $productosModel = new productos_model();

        foreach ($favoritos as $favorito) {
            // Obtener los detalles del producto asociado al ID de producto del favorito
            $producto = $productosModel->find($favorito['id_producto']);
            
            // Si el producto se encontró, agregarlo a la lista de productos favoritos
            if ($producto) {
                $productosFavoritos[] = $producto;
            }
        }

        $data['favoritos'] = $productosFavoritos;
        $data['titulo']='Favoritos';
        echo view('\header', $data);
        echo view('\favoritos', $data);
        echo view('\footer');
    }
}