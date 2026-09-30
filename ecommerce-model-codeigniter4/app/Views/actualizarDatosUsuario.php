

<div class="container principal d-flex justify-content-center">
    <div class="card" style="width: 70%;">
        <div class="card-header text-center">
        <h4>Actualizar Datos Cuenta</h4>
        </div>
            
        <?php $validation = \Config\Services::validation(); ?>

        <form method="post" class="needs-validation" novalidate action="<?php echo base_url('enviar-form-actualizarDatosUsuario') ?>"> 	
            <div class ="card-body justify-content-center" media="(max-width:768px)">
                <div class="form mb-3">
                    <label for="ID-Nombre-Registro" class="form-label">Nombre</label>
                    <input name="nombre" id="ID-Nombre-Registro" type="text"  class="form-control" placeholder="ingresa tu nombre" value="<?php echo session()->get('nombre');?>" maxlength="30" minlength="3" required>
                    <!-- Error Del Lado del Cliente -->
                    <div id="ID-Nombre-Registro" class="invalid-feedback">
                        Inserte un nombre válido. El nombre debe tener entre 3 y 30 caracteres.
                    </div>
                    <!-- Error Del Lado del Servidor -->
                    <?php if($validation->getError('nombre')) {?>
                        <div class='alert alert-danger alert-dismissible mt-2'>
                        <?= $error = $validation->getError('nombre'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php }?>
                </div>
                <div class="mb-3">
                    <label for="ID-Apellido-Registro" class="form-label">Apellido</label>
                    <input name="apellido" id="ID-Apellido-Registro" type="text" class="form-control" placeholder="apellido" value="<?php echo session()->get('apellido');?>" maxlength="30" minlength="3" required>
                    <!-- Error Del Lado del Cliente -->
                    <div id="ID-Apellido-Registro" class="invalid-feedback">
                        Inserte un apellido válido. El apellido debe tener entre 3 y 30 caracteres.
                    </div>
                    <!-- Error Del Lado del Servidor -->
                    <?php if($validation->getError('apellido')) {?>
                        <div class='alert alert-danger alert-dismissible mt-2'>
                        <?= $error = $validation->getError('apellido'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php }?>
                </div>
                <div class="mb-3">
                    <label for="ID-Mail-Registro" class="form-label">Correo</label>
                    <input name="email" id="ID-Mail-Registro" type="email" class="form-control"  placeholder="correo@algo.com" value="<?php echo session()->get('email');?>" maxlength="50" minlength="4" required>
                    <!-- Error Del Lado del Cliente -->
                    <div id="ID-Mail-Registro" class="invalid-feedback">
                        Inserte un correo válido. El correo debe tener entre 4 y 50 caracteres.
                    </div>
                    <!-- Error Del Lado del Servidor -->
                    <?php if($validation->getError('email')) {?>
                        <div class='alert alert-danger alert-dismissible mt-2'>
                        <?= $error = $validation->getError('email'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php }?>
                </div>
                <div class="mb-3">
                    <label for="ID-Usuario-Registro" class="form-label">Usuario</label>
                    <input name="usuario" id="ID-Usuario-Registro" type="text" class="form-control" placeholder="usuario" value="<?php echo session()->get('usuario');?>" maxlength="20" minlength="3" required>
                    <!-- Error Del Lado del Cliente -->
                    <div id="ID-Usuario-Registro" class="invalid-feedback">
                        Inserte un nombre de usuario válido. El nombre debe tener entre 3 y 20 caracteres.
                    </div>
                    <!-- Error Del Lado del Servidor -->
                    <?php if($validation->getError('usuario')) {?>
                        <div class='alert alert-danger alert-dismissible mt-2'>
                        <?= $error = $validation->getError('usuario'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php }?>
                </div>
              
                <input type="submit" value="Enviar" class="btn btn-dark">
                <a class="btn btn-dark inline-block" href="<?php echo base_url('miCuenta');?>">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script src="assets/js/controlDeFormularios.js"></script>