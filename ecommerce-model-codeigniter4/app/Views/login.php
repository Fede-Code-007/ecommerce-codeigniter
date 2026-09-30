
<?php if(!empty (session()->getFlashdata('success'))):?>
    <div class="alert alert-success alert-dismissible"><?=session()->getFlashdata('success');?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?>  

<div class="container mt-5 mb-5 d-flex justify-content-center">

  <div class="card" style="width: 70%;">
    <div class="card-header text-center">
      <h2>Iniciar sesion</h2>
    </div>
     <!-- Mensaje de Error -->
      <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-warning alert-dismissible">
                          <?= session()->getFlashdata('msg')?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
      <?php endif;?>     
      <!-- Incio del formulario de login-->              
    <form method="post" action="<?php echo base_url('enviar-form-login') ?>">
      <div class="card-body" media="(max-width:768px)">
        
        <div class="col-12 mb-3">
            <label for="ID-Usuario-Login" class="form-label">Usuario</label>
            <input name="usuario" id="ID-Usuario-Login" type="text" class="form-control" placeholder="usuario" maxlength="20" minlength="3" required>
         </div>
        
        <div class="col-12 mb-3">
          <label for="ID-Pass-Imput" class="form-label">Contraseña</label>
          <input name="pass" id="ID-Pass-Imput" type="password"  class="form-control" placeholder="contraseña">
        </div>
        
        <input type="submit" value="Ingresar" class="btn btn-dark mb-3">
        
        <span>¿Aún no se registró? <a href="<?php echo base_url('/registroUsuarios'); ?>">Registrarse aquí</a></span>
      </div>
    </form>
  </div>
</div>
