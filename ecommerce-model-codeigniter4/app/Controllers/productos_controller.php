<?php
namespace App\Controllers;
Use App\Models\productos_model;
Use App\Models\categorias_model;
use CodeIgniter\Controller;

class productos_controller extends Controller {
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function mostrarTablaABMProductos($filtroEstado){
        $productoModel = new productos_model();
        if ($filtroEstado=='TODOS'){
            $data['producto'] = $productoModel->orderBy('nombre_prod', 'ASC')->findAll();
        } 
        else if ($filtroEstado=='ACTIVOS') {
            $data['producto'] = $productoModel->where('eliminado', 'NO')->orderBy('nombre_prod', 'ASC')->findAll();
        }
        else {
            $data['producto'] = $productoModel->where('eliminado', 'SI')->orderBy('nombre_prod', 'ASC')->findAll();
        }

        $model = new categorias_model();
        $data['categorias'] = $model->findAll();

        $data['titulo']='ABM Productos';
        echo view('\header', $data);
        echo view('\productosABM', $data);
        echo view('\footer');
    }

    public function formularioAltaProducto()
    {
        $model = new categorias_model();
        $data['categorias'] = $model->findAll();

        $data['titulo']='Nuevo Producto';
        echo view('\header', $data);
        echo view('\formularioAltaProducto');
        echo view('\footer');
    }

    public function validarAltaProducto() 
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules([
            'nombre_prod' => 'required|max_length[100]',
            'precio' => 'required',
            'precio_vta' => 'required',
            'stock' => 'required',
            'stock_min' => 'required',
        ],
        [ //Errors
            'nombre_prod'=> [
                'required'=>'Este campo es obligatorio.',
                'max_length'=>'El nombre debe tener máximo 100 caracteres.',
            ],
            'precio'=> [
                'required'=>'Este campo es obligatorio.',
            ],
            'precio_vta'=> [
                'required'=>'Este campo es obligatorio.',
            ],
            'stock'=> [
                'required'=>'Este campo es obligatorio.',
            ],
            'stock_min' => [
                'required'=>'Este campo es obligatorio.',
                
            ],
        ]
        );

        $formModel = new productos_model();
        if ($validation->withRequest($request)->run()) {
            $formModel->save([
                'nombre_prod' => $this->request->getVar('nombre_prod'),
                'imagen'=> $this->request->getVar('imagen'),
                'categoria_id'=> $this->request->getVar('categoria_id'),
                'precio'=> $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio_vta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock_min'),
            ]);
            session() ->setFlashdata('success', 'Producto registrado con exito!');
            return redirect()->route('formularioAltaProducto');
        } else {
           session() ->setFlashdata('fail', 'Ha ocurrido un problema. Intenta nuevamente.');
           $data['titulo']='Nuevo Producto';
           $data['validation'] = $validation->getErrors();
           return view('\header',$data).view('\formularioAltaProducto').view('\footer');
        }
    }

    function bajaProducto ($idProducto){
        $model = new productos_model();
        $baja = [
            'eliminado' => 'SI',
        ];
        $model->update($idProducto, $baja);
        session() ->setFlashdata('success', 'Producto dado de baja con exito!');
        return redirect()->back();
    }

    function altaProducto ($idProducto){
        $model = new productos_model();
        $alta = [
            'eliminado' => 'NO',
        ];
        $model->update($idProducto, $alta);
        session() ->setFlashdata('success', 'Producto dado de alta nuevamente!');
        return redirect()->back();
    }

    function modificarProducto ($idProducto){

        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules([
            'nombre_prod' => 'required|max_length[100]',
            'precio' => 'required',
            'precio_vta' => 'required',
            'stock' => 'required',
            'stock_min' => 'required',
        ],
        [ //Errors
            'nombre_prod'=> [
                'required'=>'Este campo es obligatorio.',
                'max_length'=>'El nombre debe tener máximo 100 caracteres.',
            ],
            'precio'=> [
                'required'=>'Este campo es obligatorio.',
            ],
            'precio_vta'=> [
                'required'=>'Este campo es obligatorio.',
            ],
            'stock'=> [
                'required'=>'Este campo es obligatorio.',
            ],
            'stock_min' => [
                'required'=>'Este campo es obligatorio.',
                
            ],
        ]
        );
      
        if ($validation->withRequest($request)->run()) {
            $model = new productos_model();
            $datosActualizados = [
                'nombre_prod' => $this->request->getVar('nombre_prod'),
                'precio'=> $this->request->getVar('precio'),
                'precio_vta' => $this->request->getVar('precio_vta'),
                'stock' => $this->request->getVar('stock'),
                'stock_min' => $this->request->getVar('stock_min'),
            ];
            if($this->request->getVar('imagen') != null){
                $datosActualizados['imagen'] = $this->request->getVar('imagen');
            }
            if($this->request->getVar('categoria_id') != ""){
                $datosActualizados['categoria_id'] = $this->request->getVar('categoria_id');
            }
            $model->update($idProducto, $datosActualizados);
            session() ->setFlashdata('success', 'Producto actualizado correctamente!');
            return redirect()->back();
        } else {
           session() ->setFlashdata('fail', 'Ha ocurrido un problema. Intenta nuevamente.');
           $data['validation'] = $validation->getErrors();
           return redirect()->back();
        }
    }

    

    public function catalogo($filtroCategoria) {
        $productoModel = new productos_model();
        if($filtroCategoria=='TODOS'){
            $data['producto'] = $productoModel->orderBy('nombre_prod', 'ASC')->findAll();
        } else {
            $data['producto'] = $productoModel->where('categoria_id', $filtroCategoria)->orderBy('nombre_prod', 'ASC')->findAll();
        }
       
        $model = new categorias_model();
        $data['categorias'] = $model->findAll();


        $data['titulo'] = 'Catalogo';
        echo view('\header', $data);
        echo view('\catalogo', $data);
        echo view('\footer');
    }
}