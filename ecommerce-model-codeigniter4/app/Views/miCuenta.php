
<?php 
    $session = session();
    $perfil = $session->get('perfil_id');
    $usuario = $session->get('usuario');
    $correo = $session->get('email');
    $nombre = $session->get('nombre');
    $apellido = $session->get('apellido');
?>
<!-- Mensaje de Error de Contraseñas o de Modificación de datos exitosa-->
<?php if(session()->getFlashdata('msg')):?>
    <div class="alert alert-warning alert-dismissible">
        <?= session()->getFlashdata('msg')?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif;?>


<div class="container principal">
        <div class="row">
            <div class= "col-lg-2 col-md-2 col-sm-1 col-xs-1">
            </div>
            <div class= "col-lg-8 col-md-8 col-sm-10 col-xs-10">
                <ol class="list-group">
                    <li class="list-group-item">
                        <h5 class="mb-5">Detalles de usuario</h5>
                        <p class="mb-0 mt-1"><b>Nombre de usuario</b></p>
                        <?php echo $usuario ?>
                        <p class="mb-0 mt-1"><b>Nombre Completo</b></p>
                        <?php echo $nombre." ".$apellido ?>
                        <p class="mb-0 mt-1"><b>Correo Electronico</b></p>
                        <?php echo $correo ?>
                        <p class="mb-0 mt-1"><b>Tipo de Usuario </b></p>
                        <?php 
                            if ($perfil=='1'){
                               echo "Administrador";
                            } else {
                               echo "Cliente";
                            }
                        ?>
                        <div class="row mt-4">
                            <div class="col-3">
                                <a href="<?php echo base_url('logout');?>" class="btn btn-dark"> Cerrar Sesion </a>
                            </div>
                            <div class="col-9 text-end">
                                <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#modalEditarDatos"> Editar Datos </button>
                                <div class="modal fade"  id="modalEditarDatos" tabindex="-1" aria-labelledby="modalEditarDatos" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalEditarDatos">Ingrese su contraseña para continuar.</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="<?php echo base_url('actualizarDatosUsuario') ?>">
                                                <div class="modal-body">
                                                    <input name="pass" id="ID-Pass-Imput" type="password"  class="form-control" placeholder="contraseña" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Este campo es obligatorio')">
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Editar Datos" class="btn btn-dark mb-2">
                                                    <button type="button" class="btn btn-dark mb-2" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#modalCambiarContraseña"> Modificar Contraseña </button>
                                <div class="modal fade"  id="modalCambiarContraseña" tabindex="-1" aria-labelledby="modalCambiarContraseña" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalCambiarContraseña">Formulario de cambio de clave.</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="<?php echo base_url('cambiarContraseña') ?>">
                                                <div class="modal-body text-start ">
                                                    <label for="ID-Pass-Imput" class="form-label "><b>Contraseña Actual</b></label>
                                                    <input name="pass" id="ID-Pass-Imput" type="password"  class="form-control" placeholder="contraseña" minlength="4" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Inserte una contraseña válida.')">
                                                    <!-- Error Del Lado del Cliente -->
                                                    <div id="ID-Pass-Imput" class="invalid-feedback">
                                                        Inserte una contraseña válida.
                                                    </div>
                                                    <label for="ID-NewPass1-Imput" class="form-label mt-2 "><b>Contraseña Nueva</b></label>
                                                    <input name="newPass1" id="ID-NewPass1-Imput" type="password"  class="form-control" placeholder="contraseña" maxlength="50" minlength="4" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Inserte una contraseña válida. La contraseña debe tener entre 4 y 50 caracteres.')">
                                                    <!-- Error Del Lado del Cliente -->
                                                    <div id="ID-NewPass1-Imput" class="invalid-feedback">
                                                        Inserte una contraseña válida. La contraseña debe tener entre 4 y 50 caracteres.
                                                    </div>
                                                    <label for="ID-NewPass2-Imput" class="form-label mt-2"><b>Vuelva a ingresar la contraseña nueva.</b></label>
                                                    <input name="newPass2" id="ID-NewPass2-Imput" type="password"  class="form-control" placeholder="contraseña" maxlength="50" minlength="4" required oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Inserte una contraseña válida. La contraseña debe tener entre 4 y 50 caracteres.')">
                                                    <!-- Error Del Lado del Cliente -->
                                                    <div id="ID-NewPass2-Imput" class="invalid-feedback">
                                                        Inserte una contraseña válida. La contraseña debe tener entre 4 y 50 caracteres.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Cambiar Contraseña" class="btn btn-dark mb-2">
                                                    <button type="button" class="btn btn-dark mb-2" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </li>
                </ol>
            </div>
            <div class= "col-lg-2 col-md-2 col-sm-1 col-xs-1">
            </div>
    </div>
</div>

<script src="assets/js/controlDeFormularios.js"></script>
