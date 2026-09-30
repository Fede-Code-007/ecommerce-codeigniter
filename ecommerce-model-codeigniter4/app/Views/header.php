<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$titulo?> </title>
    <link rel="shortcut icon" href="assets/img/logoEmpresaBlanco.png">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/estilos.css" rel="stylesheet">
</head>
<body style="display:flex; flex-direction:column; min-height:100vh;">
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url('/');?>"><img src="assets/img/logoEmpresa.png" width="30px" height="30px"/>NutriFood</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
                $session = session();
                $perfil = $session->get('perfil_id');
            ?>
            <?php if ($perfil == '1'): ?>
                    <div class="collapse navbar-collapse" id="navbarHeader">
                        <span class="navbar-text d-none d-lg-inline-block" style="padding-left:20px">
                            VISTA ADMINISTRADOR
                        </span>
                    </div>
            <?php endif;?>
            <?php $currentPath = $_SERVER['REQUEST_URI']; ?>
            <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav ms-auto"> <!-- ms auto justifica el texto a la derecha-->
                        <?php if ($perfil == '1'): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= (strpos($currentPath, '/ecommerce-model-codeigniter4/mostrarMensajes_') === 0 ? 'active' : '') ?>" href="<?php echo base_url('mostrarMensajes_'.'todosLosMensajes');?>"><img src="assets/img/logoMail.png" class="iconoNavBar20x20 d-none d-lg-inline-block"/>Mensajes Recibidos</a>
                            </li>
                        <?php endif;?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/miCuenta' ? 'active' : '') ?>" href="<?php echo base_url('miCuenta');?>"><img src="assets/img/logoUsuario.png" class="iconoNavBar20x20 d-none d-lg-inline-block"/>Mi Cuenta</a>
                        </li>
                        <?php if ($perfil != '1'):?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/confirmarCompra' ? 'active' : '') ?>" href="<?php echo base_url('confirmarCompra');?>"><img src="assets/img/logoCarrito.png" class="iconoNavBar20x20 d-none d-lg-inline-block"/>Carrito</a>
                            </li>
                        <?php endif;?>
                    </ul>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarHeader">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link text-white <?= ($currentPath == '/ecommerce-model-codeigniter4/' ? 'active' : '') ?>" aria-current="page" href="<?php echo base_url('/');?>">Inicio</a>
                                </li>
                                <?php if(!session()->get('logged_in')):?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/login' ? 'active' : '') ?>" aria-current="page" href="<?php echo base_url('login');?>">Login</a>
                                    </li>
                                <?php else:?>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="<?php echo base_url('logout'); ?>">Cerrar Sesion</a>
                                    </li>
                                <?php endif; ?>
                                <?php if($perfil != '1'):?>
                                    <li class="nav-item ">
                                        <a class="nav-link <?= (strpos($currentPath, '/ecommerce-model-codeigniter4/catalogo_') === 0 ? 'active' : '') ?>" href="<?php echo base_url('catalogo_'.'TODOS');?>"> Catalogo </a>
                                    </li>
                                <?php else: ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Vista de las páginas </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/quienesSomos' ? 'active' : '') ?> " href="<?php echo base_url('quienesSomos');?>">Quienes Somos</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li> <a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/comercializacion' ? 'active' : '') ?>" href="<?php echo base_url('comercializacion');?>">Comercialización</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/contacto' ? 'active' : '') ?>" href="<?php echo base_url('contacto');?>">Contacto</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/consultas' ? 'active' : '') ?>" href="<?php echo base_url('consultas');?>">Consultas</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/terminosYusos' ? 'active' : '') ?>" href="<?php echo base_url('terminosYusos');?>">Terminos y Usos</a>
                                            <li><hr class="dropdown-divider"></li>
                                            <a class="nav-link <?= (strpos($currentPath, '/ecommerce-model-codeigniter4/catalogo_') === 0 ? 'active' : '')?>" href="<?php echo base_url('catalogo_'.'TODOS');?>">Catalogo</a>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            
                            <ul class="navbar-nav ms-auto"> <!-- ms auto justifica el texto a la derecha-->
                                <?php if ($perfil != '1'):?> <!-- PARA LOS USUARIOS O VISITANTES-->
                                            <li class="nav-item">
                                                <a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/quienesSomos' ? 'active' : '') ?>" href="<?php echo base_url('quienesSomos');?>">Quienes Somos<img src="assets/img/logoNosotrosClaro.png" class= "iconoNavBar20x20 d-none d-lg-inline-block"></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/comercializacion' ? 'active' : '') ?>" href="<?php echo base_url('comercializacion');?>">Comercialización<img src="assets/img/logoBolsaClaro.png" class= "iconoNavBar20x20 d-none d-lg-inline-block"></a>
                                            </li>
                                            <li class="nav-item">
                                                <?php if(!session()->get('logged_in')):?> <!-- SOLO PARA LOS VISITANTES-->
                                                    <a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/contacto' ? 'active' : '') ?>" href="<?php echo base_url('contacto');?>">Contacto<img src="assets/img/logoWhatsAppClaro.png" class= "iconoNavBar20x20 d-none d-lg-inline-block"></a>
                                                <?php else:?> <!-- SOLO PARA LOS USUARIOS-->
                                                    <a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/consultas' ? 'active' : '') ?>" href="<?php echo base_url('consultas');?>">Consultas<img src="assets/img/logoWhatsAppClaro.png" class= "iconoNavBar20x20 d-none d-lg-inline-block"></a>
                                                <?php endif;?>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?= ($currentPath == '/ecommerce-model-codeigniter4/terminosYusos' ? 'active' : '') ?>" href="<?php echo base_url('terminosYusos');?>">Terminos y Usos<img src="assets/img/logoContratoClaro.png" class= "iconoNavBar20x20 d-none d-lg-inline-block"></a>
                                            </li>
                                <?php else:?> <!-- PARA LOS ADMINISTRADORES-->
                                            <li class="nav-item">
                                                <a class="nav-link <?= (strpos($currentPath, '/ecommerce-model-codeigniter4/usuariosABM_') === 0 ? 'active' : '') ?>" href="<?php echo base_url('usuariosABM_'.'ACTIVOS');?>">Usuarios ABM </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?= (strpos($currentPath, '/ecommerce-model-codeigniter4/productosABM_') === 0 ? 'active' : '') ?>" href="<?php echo base_url('productosABM_'.'TODOS');?>">Productos ABM </a>
                                            </li>
                                <?php endif;?>
                                <?php if (session()->get('logged_in')): ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= (strpos($currentPath, '/ecommerce-model-codeigniter4/tablaFacturas') === 0 ? 'active' : '') ?>" href="<?php echo base_url('tablaFacturas');?>">Facturas </a>
                                    </li>
                                <?php endif;?>
                            </ul>
                    </div>
        </div>
    </nav>
    </header>
</html>