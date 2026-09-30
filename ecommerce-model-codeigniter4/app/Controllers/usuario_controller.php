<?php
namespace App\Controllers;
Use App\Models\usuario_model;
Use App\Models\perfiles_model;
use CodeIgniter\Controller;

class usuario_controller extends Controller {
    public function __construct()
    {
        helper(['form', 'url']);
    }
    public function registroUsuarios()
    {
        $data['titulo']='Registro';
        echo view('\header', $data);
        echo view('\registroUsuarios');
        echo view('\footer');
    }

    public function validarRegistroUsuario() 
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $validation->setRules([
            'nombre' => 'required|min_length[3]|max_length[30]',
            'apellido' => 'required|min_length[3]|max_length[30]',
            'usuario' => 'required|min_length[3]|max_length[20]|is_unique[usuarios.usuario]',
            'email' => 'required|min_length[4]|max_length[50]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[4]|max_length[50]',
        ],
        [ //Errors
            'nombre'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El nombre debe tener mínimo 3 letras.',
                'max_length'=>'El nombre debe tener máximo 30 letras.',
            ],
            'apellido'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El apellido debe tener mínimo 3 letras.',
                'max_length'=>'El apellido debe tener máximo 30 letras.',
            ],
            'usuario'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El nombre de usuario debe tener mínimo 3 caracteres.',
                'max_length'=>'El nombre de usuario debe tener máximo 20 caracteres.',
                'is_unique' => 'No se pudo completar la operación debido a que el usuario que coloco ya se encuentra registrado.',
            ],
            'email'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El mail debe tener mínimo 4 caracteres.',
                'max_length'=>'El mail debe tener máximo 50 caracteres.',
                'valid_email' => 'Inserte un mail válido.',
                'is_unique' => 'No se pudo completar la operación debido a que el mail que coloco ya se encuentra registrado.',
            ],
            'pass' => [
                'required'=> 'Este campo es obligatorio.',
                'min_length'=>'La contraseña debe tener mínimo 4 caracteres.',
                'max_length'=>'La contraseña debe tener máximo 50 caracteres.',
            ],

        ]
        );

        $formModel = new usuario_model();
        if ($this->request->getVar('pass') != $this->request->getVar('confirmPass')){
            session() ->setFlashdata('fail', 'Error. Las contraseñas ingresadas no coinciden. Intente nuevamente.');
            return redirect()->route('registroUsuarios');
        }
        else if ($validation->withRequest($request)->run()) {
            $formModel->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido'=> $this->request->getVar('apellido'),
                'usuario'=> $this->request->getVar('usuario'),
                'email'=> $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
                'perfil_id' => 2,
            ]);
            session() ->setFlashdata('success', 'Usuario registrado con exito');
            return redirect()->route('login');
        } else {
           $data['titulo']='Registro';
           $data['validation'] = $validation->getErrors();
           return view('\header',$data).view('\registroUsuarios').view('\footer');
        }
    }

    public function login ()
    {
        $dato['titulo']='Login'; 
        echo view('\header',$dato);
        echo view('\login');
        echo view('\footer');
    } 
  
    public function validarLogin()
    {
        $session = session(); //el objeto de sesión se asigna a la variable $session
        $model = new usuario_model(); //instanciamos el modelo

        //traemos los datos del formulario
        $usuario = $this->request->getVar('usuario');
        $password = $this->request->getVar('pass');
        
        $data = $model->where('usuario', $usuario)->first(); //consulta sql 
       
        if($data){
            $pass = $data['pass'];
            $ba= $data['baja'];
             if ($ba == 'SI'){
                $session->setFlashdata('msg', 'Lo sentimos, su cuenta ha sido dada de baja.');
                return redirect()->to('login');
            }
            //Se verifican los datos ingresados para iniciar, si cumple la verificaciòn inicia la sesion
            $verify_pass = password_verify($password, $pass);
            //password_verify determina los requisitos de configuracion de la contraseña
           
            if($verify_pass){
                $ses_data = [
                    'id_usuario' => $data['id_usuario'],
                    'nombre' => $data['nombre'],
                    'apellido'=> $data['apellido'],
                    'email' =>  $data['email'],
                    'usuario' => $data['usuario'],
                    'perfil_id'=> $data['perfil_id'],
                    'logged_in'  => TRUE
                ];
                //Si se cumple la verificacion inicia la sesiòn  
                $session->set($ses_data);

                session()->setFlashdata('msg', 'Bienvenido '.$data['usuario'].'!!');
                return redirect()->to('/');
                // return redirect()->to('/prueba');//pagina principal
            }else{  
                //no paso la validaciòn de la password
                $session->setFlashdata('msg', 'Contraseña Incorrecta');
                return redirect()->to('/login');
            }   
        }else{
            //no paso la validaciòn del usuario
            $session->setFlashdata('msg', 'No Existe el Usuario o es Incorrecto');
            return redirect()->to('/login');
        } 
    
  }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    public function miCuenta(){
        $data['titulo']='Mi cuenta';
        echo view('\header', $data);
        echo view('\miCuenta');
        echo view('\footer');
    }

    public function bajaCuenta(){
        $model = new usuario_model();
        $session = session(); //el objeto de sesión se asigna a la variable $session
        $usuarioID = $session->get('id_usuario');
        $data = $model->where('id_usuario', $usuarioID)->first();
        
        //Asignamos la contraseña de la sesion y la que nos envian
        $pass = $data['pass'];
        $password = $this->request->getVar('pass');

        //Las comparamos
       $verify_pass = password_verify($password, $pass);
        
        if($verify_pass){
            $datosActualizados = [
                'baja' => "SI",
            ];
            $model->update($usuarioID,$datosActualizados);
            $session = session();
            $session->destroy();
            $data['bajaPositiva']='Su sesión se ha dado de baja correctamente';
            echo view('\header', $data);
            echo view('\principal');
            echo view('\footer');
        }else{  
            //no paso la validación de la password
            $session->setFlashdata('msg', 'Contraseña Incorrecta');
            return redirect()->to('miCuenta');
        } 
    }

    public function modificarDatosMiCuenta(){

        $model = new usuario_model();
        $session = session(); //el objeto de sesión se asigna a la variable $session
        $usuarioID = $session->get('id_usuario');
        $data = $model->where('id_usuario', $usuarioID)->first();
        
        //Asignamos la contraseña de la sesion y la que nos envian
        $pass = $data['pass'];
        $password = $this->request->getVar('pass');

        //Las comparamos
       $verify_pass = password_verify($password, $pass);
        
        if($verify_pass){
                $data['titulo']='Actualizar Datos';
                echo view('\header', $data);
                echo view('\actualizarDatosUsuario');
                echo view('\footer');
        }else{  
                //no paso la validaciòn de la password
                $session->setFlashdata('msg', 'Contraseña Incorrecta');
                return redirect()->to('miCuenta');
        } 
    }

    public function modificarDatosCuenta()
    {
        $validation = \Config\Services::validation();
        $request = \Config\Services::request();

        $session = session();
        $usuarioID = $session->get('id_usuario');

        $validation->setRules([
            'nombre' => 'required|min_length[3]|max_length[30]',
            'apellido' => 'required|min_length[3]|max_length[30]',
            'usuario' => 'required|min_length[3]|max_length[20]',
            'email' => "required|min_length[4]|max_length[50]|valid_email|is_unique[usuarios.email,id_usuario,{$usuarioID}]",
        ],
        [ //Errors
            'nombre'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El nombre debe tener mínimo 3 letras.',
                'max_length'=>'El nombre debe tener máximo 30 letras.',
            ],
            'apellido'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El apellido debe tener mínimo 3 letras.',
                'max_length'=>'El apellido debe tener máximo 30 letras.',
            ],
            'usuario'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El nombre de usuario debe tener mínimo 3 caracteres.',
                'max_length'=>'El nombre de usuario debe tener máximo 20 caracteres.',
            ],
            'email'=> [
                'required'=>'Este campo es obligatorio.',
                'min_length'=>'El mail debe tener mínimo 4 caracteres.',
                'max_length'=>'El mail debe tener máximo 50 caracteres.',
                'valid_email' => 'Inserte un mail válido.',
                'is_unique' => 'No se pudo completar la operación debido a que el mail que coloco ya se encuentra registrado.',
            ],
        ]
        );

        $model = new usuario_model();
    
        if ($validation->withRequest($request)->run()) {
            $datosActualizados = [
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'email' => $this->request->getVar('email'),
            ];
            $model->update($usuarioID,$datosActualizados);
            $session->set($datosActualizados);
            $session->setFlashdata('msg', 'Datos modificados con Exito!');
            return redirect()->to('miCuenta');
        } else {
           $data['titulo']='Actualizar Datos';
           $data['validation'] = $validation->getErrors();
           return view('\header',$data).view('\actualizarDatosUsuario').view('\footer');
        }
    }

    public function cambiarContraseña(){
        $model = new usuario_model();
        $session = session(); //el objeto de sesión se asigna a la variable $session
        $usuarioID = $session->get('id_usuario');
        $data = $model->where('id_usuario', $usuarioID)->first();
        
        //Asignamos la contraseña de la sesion y la que nos envian
        $pass = $data['pass'];
        $password = $this->request->getVar('pass');

        $newPass1 = $this->request->getVar('newPass1');
        $newPass2 = $this->request->getVar('newPass2');

        //Las comparamos
       $verify_pass = password_verify($password, $pass);
        
        if($verify_pass){
            if($newPass1 == $newPass2){
                $contraseñaActualizada = [
                    'pass' => password_hash($newPass1, PASSWORD_DEFAULT),
                ];
                $model->update($usuarioID, $contraseñaActualizada);
                $session->setFlashdata('msg', 'Datos modificados con Exito!');
                return redirect()->to('miCuenta');
            } else {
                $session->setFlashdata('msg', 'Las contraseñas ingresadas no coinciden.');
                return redirect()->to('miCuenta');
            }
        }else{  
            //no paso la validaciòn de la password
            $session->setFlashdata('msg', 'Contraseña Incorrecta.');
            return redirect()->to('miCuenta');
        } 
    }

    public function mostrarTablaABMusuarios($filtroEliminado){
        $usuariosModel = new usuario_model();
        if ($filtroEliminado=='ACTIVOS'){   
            $data['usuario'] = $usuariosModel->where('baja', 'NO')->orderBy('id_usuario', 'DESC')->findAll();
        } else {
            $data['usuario'] = $usuariosModel->where('baja', 'SI')->orderBy('id_usuario', 'DESC')->findAll();
        }
        
        $perfilesModel = new perfiles_model();
        $data['perfiles'] = $perfilesModel->findAll();

        $data['titulo']='ABM Usuarios';
        echo view('\header', $data);
        echo view('\usuariosABM', $data);
        echo view('\footer');
    }

    function bajaUsuario ($idUsuario){
        $model = new usuario_model();
        $baja = [
            'baja' => 'SI',
        ];
        $model->update($idUsuario, $baja);
        session() ->setFlashdata('success', 'Usuario dado de baja con exito!');
        return redirect()->back();
    }

    function altaUsuario ($idUsuario){
        $model = new usuario_model();
        $alta = [
            'baja' => 'NO',
        ];
        $model->update($idUsuario, $alta);
        session() ->setFlashdata('success', 'Usuario dado de alta nuevamente!');
        return redirect()->back();
    }

    function modificarUsuario ($idUsuario){

        $model = new usuario_model();

        if($this->request->getVar('perfil_id') != ""){
            $datosActualizados = [
                'perfil_id'=> $this->request->getVar('perfil_id'),
            ];
            $model->update($idUsuario, $datosActualizados);
            session() ->setFlashdata('success', 'Perfil del usuario actualizado correctamente!');
            return redirect()->back();
        } else {
            session() ->setFlashdata('fail', 'No se produjeron cambios!');
            return redirect()->back();
        }
    }
}

