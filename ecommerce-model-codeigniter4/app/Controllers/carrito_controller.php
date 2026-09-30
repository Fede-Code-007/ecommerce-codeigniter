<?php

namespace App\Controllers;
use CodeIgniter\Controller;
Use App\Models\ventas_cabecera_model;
Use App\Models\ventas_detalle_model;
Use App\Models\productos_model;
Use App\Models\usuario_model;

class carrito_controller extends BaseController
{
    public function __construct()
    {   
        helper(['form', 'url', 'cart']);
        $session = session();
        $cart = \Config\Services::cart();
        $cart->contents();
    }

    public function agregarAlCarrito(){
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();
        $cart->insert(array(
            'id' => $request->getVar('id'),
            'qty' => $request->getVar('qty'),
            'price' => $request->getVar('precio_vta'),
            'name' => $request->getVar('nombre_prod'),
        ));
        session()->setFlashdata('msg', 'Producto añadido con exito!');
        return redirect()->back()->withInput();
    }

    public function modificar_cant($rowid){
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();
        $qty = $request->getPost('qty');
        $cart->update(array('rowid'=> $rowid, 'qty'=>$qty,));
        return redirect()->back();
    }

    public function quitarDelCarrito ($rowid){
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

        if ($rowid==="all"){
            $cart->destroy();
        }
        else {
            $cart->remove($rowid);
        }
        return redirect()->back()->withInput();
    }

    public function borrarCarrito (){
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();

       
        $cart->destroy();
        return redirect()->back()->withInput();
    }

    public function mostrarCarrito(){
        helper(['form', 'url', 'cart']);
        $cart = \Config\Services::cart();
        $cart = $cart->contents();

        $session = session();
        $nombre = $session->get('nombre');
        $perfil_id = $session->get('perfil_id');
        $email = $session->get('email');
        $productos = new productos_model();
        $data['productos'] = $productos->findAll();

        $data['titulo']='Confirmar compra';     
        echo view('\header', $data);
        echo view('\carrito');
        echo view('\footer');
    }

    public function comprarCarrito() {
        
        $cart = \Config\Services::cart();
        $productos = $cart->contents();
        $request = \Config\Services::request();
        $montoTotal = 0;
        $db = \Config\Database::connect();
        $db->transStart();
    
        foreach ($productos as $producto) {
            $montoTotal += $producto["price"] * $producto["qty"];
        }
    
        $ventaCabecera = new ventas_cabecera_model();
        if ($ventaCabecera->insert(["total_venta" => $montoTotal, "usuario_id" => session()->get('id_usuario')])){
            $idCabecera = $ventaCabecera->insertID();
            $ventaDetalle = new ventas_detalle_model();
            $productoModel = new productos_model();

            foreach ($productos as $producto) {
                if($ventaDetalle->insert(["venta_id" => $idCabecera, "producto_id" => $producto["id"], "cantidad" => $producto["qty"], "precio" => $producto["price"]])){
                    // Obtener el producto de la base de datos para obtener el stock actualizado
                    $productoDB = $productoModel->find($producto["id"]);
            
                    // Verificar si el producto existe en la base de datos
                    if ($productoDB) {
                        // Actualizar el stock y las unidades vendidas
                        $nuevoStock = $productoDB["stock"] - $producto["qty"];
                        $productoModel->update($producto["id"], [
                            "stock" => $nuevoStock,
                            "unidadesVendidas" => $productoDB["unidadesVendidas"] + $producto["qty"]
                        ]);
                    } else {
                        $db->transRollback();
                        session()->setFlashdata('fail', 'Hubo un problema al procesar tu compra. Por favor, intenta de nuevo.');
                        return redirect()->back();
                    }
                } else {
                    $db->transRollback();
                    session()->setFlashdata('fail', 'Hubo un problema al procesar tu compra. Por favor, intenta de nuevo.');
                    return redirect()->back();
                }   
            }
        } else {
            session()->setFlashdata('fail', 'Hubo un problema al procesar tu compra. Por favor, intenta de nuevo.');
            return redirect()->back();
        }
       
        $db->transComplete();
        if($db->transStatus()===FALSE){
            log_message('error', 'Error en la transacción de la compra: ' . $db->error()['message']);
            session()->setFlashdata('fail', 'Hubo un problema al procesar tu compra. Por favor, intenta de nuevo.');
            return redirect()->back();
        } else {
            $cart->destroy();
            session()->setFlashdata('msg', 'Compra realizada con éxito!!');
            return redirect()->to('/');
        }
    }

    public function mostrarTablaFacturas() {
        $usuarios = new usuario_model();
        $data['usuarios'] = $usuarios->findAll();

        $facturas = new ventas_cabecera_model();
        if (session()->get('perfil_id')  == '1'){
            $data['facturas'] = $facturas->orderBy('id', 'DESC')->findAll();
        } else {
            $data['facturas'] = $facturas->where('usuario_id', session()->get('id_usuario'))->orderBy('id', 'DESC')->findAll();
        }
        
        $data['titulo']='Facturas';
        echo view('\header', $data);
        echo view('\tablaFacturas', $data);
        echo view('\footer');
    }

    public function verDetalleFactura($idFactura) {
        $usuarios = new usuario_model();
        $data['usuarios'] = $usuarios->findAll();
        $detalle = new ventas_detalle_model();
        $cabecera = new ventas_cabecera_model();
        $data['detalle'] = $detalle->where('venta_id', $idFactura)->findAll();
        $data['cabecera'] = $cabecera->where('id', $idFactura)->first();
        $productos = new productos_model();
        $data['productos'] = $productos->findAll();
        
        $data['titulo']='Detalle Factura';
        echo view('\header', $data);
        echo view('\detalleFactura', $data);
        echo view('\footer');
    }
}