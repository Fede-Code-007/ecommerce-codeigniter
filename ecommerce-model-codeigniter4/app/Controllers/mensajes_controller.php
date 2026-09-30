<?php
namespace App\Controllers;
Use App\Models\mensajes_model;
use CodeIgniter\Controller;

class mensajes_controller extends Controller {
    public function _construct()
    {
        helper(['form', 'url']);
    }
    
    public function validarMensajeConsultas() 
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules([
            'mensaje' => 'required|max_length[1000]',
        ],
        [ //Errors
            'mensaje' => [
                'required'=> 'Este campo es obligatorio.',
                'max_length'=>'El mensaje debe debe tener máximo 1000 caracteres.',
            ],
        ]
        );

        $formModel = new mensajes_model();
        $session = session();
        $usuario = $session->get('usuario');
        $nombre = $session->get('nombre');
        $apellido = $session->get('apellido');
        $email = $session->get('email');

        if ($validation->withRequest($request)->run()) {
            $formModel->save([
                'mensaje'=> $this->request->getVar('mensaje'),
                'nombre_usuario' => $usuario,
                'email' => $email,
                'fuente' => 'Consultas',
                'nombre_emisor' => $nombre." ".$apellido,
                'telefono' => 'No registrado',
            ]);

            session() ->setFlashdata('success', 'Mensaje enviado con exito');
            return redirect()->route('consultas');
        } else {
           $data['titulo']='Consultas';
           $data['validation'] = $validation->getErrors();
           return view('\header',$data).view('\consultas').view('\footer');
        }
    }

    public function validarMensajeContacto() 
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules([
            'nombre_emisor' => 'required|min_length[3]|max_length[50]',
            'telefono' => 'required|min_length[6]|max_length[20]',
            'email' => 'required|min_length[5]|max_length[50]|valid_email',
            'mensaje' => 'required|max_length[1000]',
        ],
        [ //Errors
            'nombre_emisor'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El nombre debe tener mínimo 3 caracteres.',
                'max_length'=>'El nombre debe tener máximo 50 caracteres.',
            ],
            'telefono'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El campo debe tener mínimo 6 caracteres.',
                'max_length'=>'El campo de usuario debe tener máximo 20 caracteres.',
            ],
            'email'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El mail debe tener mínimo 5 caracteres.',
                'max_length'=>'El mail debe tener máximo 50 caracteres.',
                'valid_email' => 'Inserte un mail válido.',
            ],
            'mensaje' => [
                'required'=> 'Este campo es obligatorio.',
                'max_length'=>'El mensaje debe debe tener máximo 1000 caracteres.',
            ],

        ]
        );

        $formModel = new mensajes_model();

        if ($validation->withRequest($request)->run()) {
            $formModel->save([
                'nombre_emisor' => $this->request->getVar('nombre_emisor'),
                'telefono'=> $this->request->getVar('telefono'),
                'email'=> $this->request->getVar('email'),
                'mensaje'=> $this->request->getVar('mensaje'),
                'fuente'=> 'Contacto',
                'nombre_usuario'=> 'No registrado',
            ]);
            session() ->setFlashdata('success', 'Mensaje enviado con exito');
            return redirect()->route('contacto')->with('mensaje','El mensaje ha sido enviado con exito!');
        } else {
           $data['titulo']='Contacto';
           $data['validation'] = $validation->getErrors();
           return view('\header',$data).view('\contacto').view('\footer');
        }
    }

    public function mostrarMensajes_($filtro) 
    {
        $model = new mensajes_model();

        // Obtener datos usando el modelo
        if($filtro=='todosLosMensajes'){
            $data['mensajes'] = $model->orderBy('id_mensaje', 'DESC')->findAll();
        } 
        else if ($filtro=='noleidos'){
            $data['mensajes'] = $model->where('estado', '1')->orderBy('id_mensaje', 'DESC')->findAll();
        } else {
            $data['mensajes'] = $model->groupStart()->where('estado', '2')->orWhere('estado', '3')->groupEnd()->orderBy('id_mensaje', 'DESC')->findAll();
        }
        
        // Pasar los datos a la vista
        $data['titulo']='Mensajes';
        return view('\header',$data).view('\mensajesAdmin',$data).view('\footer');
    }

    function marcarComoLeido ($idMensaje){
        $model = new mensajes_model();
        $estado = [
            'estado' => '2',
        ];
        $model->update($idMensaje, $estado);
        return redirect()->back();
    }

    function marcarComoRespondido ($idMensaje){
        $model = new mensajes_model();
        $estado = [
            'estado' => '3',
        ];
        $model->update($idMensaje, $estado);
        return redirect()->back();
    }


}