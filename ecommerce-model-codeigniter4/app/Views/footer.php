<!DOCTYPE html>
    <footer class="bg-dark text-light" style="bottom:0; margin-top:auto">
        <div class = "container-fluid text-center">
            <div class = "row">
                <div class = "col-lg-4 col-md-4 col-sm-12">
                    <p> NAVEGACIÓN </p>
                    <a class="nav-link active hover-footer" aria-current="page" href="<?php echo base_url('/');?>"> Principal</a>
                    <a class="nav-link hover-footer" aria-current="page" href="<?php echo base_url('catalogo_'.'TODOS');?>"> Catalogo</a>
                    <?php if(!session()->get('logged_in')):?> 
                        <a class="nav-link hover-footer" aria-current="page" href="<?php  echo base_url('contacto');?>"> Contacto</a>
                    <?php else:?> 
                        <a class="nav-link hover-footer" aria-current="page" href="<?php  echo base_url('consultas');?>"> Consultas</a>
                    <?php endif;?>
                    <a class="nav-link hover-footer" aria-current="page" href="<?php echo base_url('quienesSomos');?>"> Quienes somos</a>
                    <a class="nav-link hover-footer" aria-current="page" href="<?php echo base_url('comercializacion');?>"> Comercialización</a>
                    <a class="nav-link hover-footer" aria-current="page" href="<?php echo base_url('terminosYusos');?>" style="margin-bottom:30px"> Terminos y condiciones</a>     
                </div>

                <div class = "col-lg-8 col-md-8 col-sm-12">
                    <div class="row">
                        <p> REDES </p>
                        <div class="d-sm-none">
                            <a href="https://www.facebook.com/" target="_blank"><img src="assets/img/logoFacebook.png" class= "d-inline-block iconoFooterXS"></a>
                            <a href="https://www.instagram.com/" target="_blank"><img src="assets/img/logoInstagram.png" class= "d-inline-block iconoFooterXS"  ></a>
                            <a href="https://twitter.com/"  target="_blank"><img src="assets/img/logoX.png" class= "d-inline-block iconoFooterXS" ></a>
                            <a href="https://www.tiktok.com/es/" target="_blank"><img src="assets/img/logoTikTok.png" class= "d-inline-block iconoFooterXS"></a>
                        </div>
                    </div>
                    <div class="container-fluid text-center d-none d-sm-block" style=" padding-left:50px">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <a href="https://www.facebook.com/" target="_blank"><img src="assets/img/logoFacebook.png" class= "img-fluid" style="margin-bottom:20px"></a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <a href="https://www.instagram.com/" target="_blank"><img src="assets/img/logoInstagram.png" class= "img-fluid" style="margin-bottom:20px"  ></a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <a href="https://twitter.com/"  target="_blank"><img src="assets/img/logoX.png" class= "img-fluid" style="margin-bottom:20px;" ></a>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <a href="https://www.tiktok.com/es/" target="_blank"><img src="assets/img/logoTikTok.png" class= "img-fluid" style="margin-bottom:20px" ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>