

<?php if(!empty (session()->getFlashdata('fail'))):?>
    <div class="alert alert-danger alert-dismissible"><?=session()->getFlashdata('fail');?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?>

<?php if(!empty (session()->getFlashdata('success'))):?>
    <div class="alert alert-success alert-dismissible"><?=session()->getFlashdata('success');?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?> 

<div class="container principal">
    <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <div class="row">
                    <h2 class="text-center" style="margin-bottom:20px"> Contactanos </h2>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h5 class="text-center" style="margin-top:10px"> Información de contacto </h5>
                        <p class="text-center">¡Contactanos por cualquiera de estos medios!</p>
                        <p><img src="assets/img/logoWhatsApp.png" class="logoContacto">Telefono: <a href="tel:+5493795010005">54-379-5010005</a> </p>
                        <p><img src="assets/img/logoMail.png" class="logoContacto">Correo: <a href="mailto:nutrifood@gmail.com">nutrifood@gmail.com</a> </p>
                        <p><img src="assets/img/logoUbicacion.png" class="logoContacto"><a href="https://www.google.com/maps/place/Facultad+de+Ciencias+Exactas+y+Naturales+y+Agrimensura/@-27.4664978,-58.8319485,19z/data=!4m6!3m5!1s0x94456ca6d24ec0c9:0xb92ce3fedb0d7729!8m2!3d-27.4664554!4d-58.8322143!16s%2Fg%2F1tdzxtp4?entry=ttu">9 de julio 1449 - Corrientes Capital - Argentina</a></p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3583.331528086915!2d-58.831275601592175!3d-27.46724221616783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456ca6d24ec0c9%3A0xb92ce3fedb0d7729!2sFacultad%20de%20Ciencias%20Exactas%20y%20Naturales%20y%20Agrimensura!5e0!3m2!1ses-419!2sar!4v1713456578268!5m2!1ses-419!2sar" class="img-fluid text-center" style="margin-bottom:30px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h5 class="text-center" style="margin-top:10px"> Escribenos </h5>
                        <p class="text-center"> ¡Tambien puedes dejar tu mensaje por aquí!</p>
                        
                        <?php $validation = \Config\Services::validation(); ?>

                        <form  method="post" class="needs-validation" novalidate action="<?php echo base_url('enviar-form-contacto') ?>">
                            <div class="form-group espacioForm">
                                <input type="text" name="nombre_emisor" class="form-control" id="ID-NOMBRE" placeholder="Ingresa tu nombre aquí..." maxlength="50" minlength="3" required>
                                 <!-- Error Del Lado del Cliente -->
                                <div id="ID-NOMBRE" class="invalid-feedback">
                                    Este campo es obligatorio. Ingrese un nombre válido de 3 a 50 caracteres.
                                </div>
                                <!-- Error Del Lado del Servidor -->
                                <?php if($validation->getError('nombre_emisor')) {?>
                                    <div class='alert alert-danger alert-dismissible mt-2'>
                                        <?= $error = $validation->getError('nombre_emisor'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="form-group espacioForm">
                                <input type="tel" name="telefono" class="form-control" id="ID-TELEFONO" placeholder="Ingresa tu número telefonico aquí..." maxlength="20" minlength="6" required>
                                <div id="ID-TELEFONO" class="invalid-feedback">
                                    Este campo es obligatorio. Ingrese un telefóno valido.
                                </div>
                                <!-- Error Del Lado del Servidor -->
                                <?php if($validation->getError('telefono')) {?>
                                    <div class='alert alert-danger alert-dismissible mt-2'>
                                        <?= $error = $validation->getError('telefono'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="form-group espacioForm">
                                <input type="email" name="email" class="form-control" id="ID-MAIL" placeholder="Ingresa tu correo aquí..." maxlength="50" minlength="5" required>
                                <div id="ID-MAIL" class="invalid-feedback">
                                    Este campo es obligatorio. Ingresa un mail valido.
                                </div>
                                 <!-- Error Del Lado del Servidor -->
                                 <?php if($validation->getError('email')) {?>
                                    <div class='alert alert-danger alert-dismissible mt-2'>
                                        <?= $error = $validation->getError('email'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="form-group espacioForm">
                                <textarea class="form-control" name="mensaje" id="ID-MENSAJE" placeholder="Puedes ingresar tu mensaje aquí..." rows="3" maxlength="1000" required></textarea>
                                <div id="ID-MENSAJE" class="invalid-feedback">
                                    Este campo es obligatorio. Ingrese un mensaje de máximo mil caracteres.
                                </div>
                                <!-- Error Del Lado del Servidor -->
                                <?php if($validation->getError('mensaje')) {?>
                                    <div class='alert alert-danger alert-dismissible mt-2'>
                                        <?= $error = $validation->getError('mensaje'); ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="form-check espacioForm">
                                <input type="checkbox" class="form-check-input" id="confirmacionTerminosCondiciones" value="" required>
                                <label class="form-check-label" for="confirmacionTerminosCondiciones">Acepto los  <a href="<?php echo base_url('terminosYusos');?>" target="_blank"> Terminos y Condiciones</a> </label>
                                <div id="confirmacionTerminosCondiciones" class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary espacioForm">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            </div>
    </div>
</div>

<script src="assets/js/controlDeFormularios.js"></script>
