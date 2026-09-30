
<?php if(!empty (session()->getFlashdata('msg'))):?>
    <div class="alert alert-success alert-dismissible"><?=session()->getFlashdata('msg');?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?>
<?php if(!empty (session()->getFlashdata('fail'))):?>
    <div class="alert alert-warning alert-dismissible"><?=session()->getFlashdata('fail');?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?>
<?php if(!empty ($bajaPositiva)):?>
    <div class="alert alert-success alert-dismissible"><?= $bajaPositiva;?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?> 
<div class="container principal">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container secundario">
                    <h2> Principal </h2>
                    <p class="parrafoJustificado"> En NutriFood, nos dedicamos a ofrecerte una amplia selección de alimentos saludables y nutritivos 
                    que te ayudarán a llevar un estilo de vida más equilibrado y energético.</p>
                    <p class="parrafoJustificado">Nos esforzamos por promover hábitos alimenticios saludables y sostenibles, 
                    proporcionando productos de alta calidad que cuidan tu salud y el medio ambiente. Desde superalimentos orgánicos 
                    hasta snacks saludables y suplementos deportivos, en nuestro sitio web encontraras una amplia gama de opciones para 
                    satisfacer todas tus necesidades dietéticas y gustos personales.</p>
                    <p class="parrafoJustificado">Sin nada más que agregar los invitamos a dar un recorrido por nuestro sitio. </p>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:20px">
            <div class="col">
                <h2> Promociones </h2>
                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src= "assets\img\ejemploPromo1.jpg" class="d-block w-100 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="assets\img\promo1.jpg" class="d-block w-100 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="assets\img\promo2.jpg" class="d-block w-100 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="assets\img\promo3.jpg" class="d-block w-100 rounded" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="assets\img\ejemploPromo2.jpg" class="d-block w-100 rounded" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon flechaPromo" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon flechaPromo" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <?php if ($mas_vendidos!=null):?>
            <div class="row">
                <div class= "col-9">
                        <div class="container secundario">
                            <h3> Más Vendidos.</h3>
                        </div>
                </div>
                <div class= "col-3">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="masVendidos" class="carousel slide" data-bs-theme="dark">
                        <div class="carousel-inner">
                            <?php 
                                $isActive = true; 
                                $primeros20;
                                $contador=0;
                                foreach ($mas_vendidos as $prod){
                                    if ($contador<20){
                                        $primeros20[] = $prod;
                                        $contador++;
                                    } else {
                                        break;
                                    }
                                }
                            ?> 
                            <?php foreach (array_chunk($primeros20, 4) as $chunk): ?>
                                <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
                                    <div class="row">
                                        <?php foreach ($chunk as $prod): ?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-6 mb-2">
                                                    <div class="card" style="height:100%;">
                                                        <img src="<?=base_url()?>/assets/img/<?=$prod['imagen']?>" class="card-img-top" alt="<?=$prod['nombre_prod']?>">
                                                        <div class="card-body ">
                                                            <h5 class="card-title"><?= $prod['nombre_prod'] ?></h5>
                                                            <p class="card-text">$<?= $prod['precio_vta'] ?></p>
                                                        </div>
                                                        <div class="card-footer">
                                                            <?php
                                                                $session = session();
                                                                $perfil = $session->get('perfil_id');
                                                            ?>
                                                            <?php if ($perfil == '2'): ?>
                                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarAlCarritoModal1<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                            <div class="modal fade" id="agregarAlCarritoModal1<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="agregarAlCarritoModalLabel1<?php echo $prod['id']; ?>" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="agregarAlCarritoModalLabel1<?php echo $prod['id']; ?>"><?php echo $prod['nombre_prod']; ?>.</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php
                                                                                $cart = \Config\Services::cart();
                                                                                $cartContenido = $cart->contents();
                                                                                $qty_in_cart = 0;
                                                                                foreach ($cartContenido as $item) {
                                                                                    if ($item['id'] == $prod['id']) {
                                                                                        $qty_in_cart = $item['qty'];
                                                                                        break;
                                                                                    }
                                                                                }
                                                                                $available_stock = $prod['stock'] - $qty_in_cart;
                                                                            ?>
                                                                            <?php if ($available_stock != 0): ?>
                                                                            <p>Precio Unitario: $<?php echo $prod['precio_vta']; ?></p>
                                                                            <p>Stock Disponible: <?php echo $available_stock ?></p>
                                                                            <hr>
                                                                            <form id="productForm<?php echo $prod['id']; ?>" action="agregarAlCarrito" method="post">
                                                                                <label for="ID-Cantidad<?php echo $prod['id']; ?>" class="form-label">Seleccionar cantidad.</label>
                                                                                <select name="qty" id="ID-Cantidad<?php echo $prod['id']; ?>" class="form-select" aria-label="cantidad" required>
                                                                                    <?php for ($i = 1; $i <= $available_stock; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                                <input type="hidden" id="productPrice<?php echo $prod['id']; ?>" value="<?php echo $prod['precio_vta']; ?>">
                                                                                <p class="mt-2">Subtotal: $<span id="subtotal<?php echo $prod['id']; ?>"></span></p>
                                                                                <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                                                                                <input type="hidden" name="precio_vta" value="<?php echo $prod['precio_vta']; ?>">
                                                                                <input type="hidden" name="nombre_prod" value="<?php echo $prod['nombre_prod']; ?>">
                                                                                <?php else:?>
                                                                                    <p>Lo sentimos, por el momento no tenemos más stock de este producto...</p>
                                                                                <?php endif;?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <?php if ($available_stock != 0): ?>
                                                                            <input type="submit" value="Agregar al carrito" class="btn btn-primary btn-sm">
                                                                            <?php endif;?>
                                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php elseif ($perfil == '1'): ?>
                                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AvisoParaAdministradores1<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                                <div class="modal fade" id="AvisoParaAdministradores1<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="AvisoParaAdministradoresLabel1<?php echo $prod['id']; ?>" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5" id="AvisoParaAdministradoresLabel1<?php echo $prod['id']; ?>">Aviso para administradores.</h1>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Esta función solo esta activada para usuarios clientes.<p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php else:?>
                                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('login');?>"> Agregar al carrito </a>  
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php $isActive = false; ?>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev controlIzq" type="button" data-bs-target="#masVendidos" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon flechaAnteriorProducto" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next controlDer" type="button" data-bs-target="#masVendidos" data-bs-slide="next">
                            <span class="carousel-control-next-icon flechaSiguienteProducto" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif;?>

        <?php if ($frutosSecos!=null):?>
            <div class="row">
            <div class= "col-9">
                    <div class="container secundario">
                        <h3> Frutos Secos.</h3>
                    </div>
            </div>
            <div class= "col-3">
            </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="frutosSecos" class="carousel slide" data-bs-theme="dark">
                        <div class="carousel-inner">
                            <?php $isActive = true; ?>
                            <?php foreach (array_chunk($frutosSecos, 4) as $chunk): ?>
                                <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
                                    <div class="row">
                                        <?php foreach ($chunk as $prod): ?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-6 mb-2">
                                                    <div class="card" style="height:100%;">
                                                        <img src="<?=base_url()?>/assets/img/<?=$prod['imagen']?>" class="card-img-top" alt="<?=$prod['nombre_prod']?>">
                                                        <div class="card-body ">
                                                            <h5 class="card-title"><?= $prod['nombre_prod'] ?></h5>
                                                            <p class="card-text">$<?= $prod['precio_vta'] ?></p>
                                                        </div>
                                                        <div class="card-footer">
                                                            <?php if ($perfil == '2'): ?>
                                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarAlCarritoModal2<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                            <div class="modal fade" id="agregarAlCarritoModal2<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="agregarAlCarritoModalLabel2<?php echo $prod['id']; ?>" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="agregarAlCarritoModalLabel2<?php echo $prod['id']; ?>"><?php echo $prod['nombre_prod']; ?>.</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php
                                                                                
                                                                                $cart = \Config\Services::cart();
                                                                                $cartContenido = $cart->contents();
                                                                                $qty_in_cart = 0;
                                                                                foreach ($cartContenido as $item) {
                                                                                    if ($item['id'] == $prod['id']) {
                                                                                        $qty_in_cart = $item['qty'];
                                                                                        break;
                                                                                    }
                                                                                }
                                                                                $available_stock = $prod['stock'] - $qty_in_cart;
                                                                            ?>
                                                                            <?php if ($available_stock != 0): ?>
                                                                            <p>Precio Unitario: $<?php echo $prod['precio_vta']; ?></p>
                                                                            <p>Stock Disponible: <?php echo $available_stock ?></p>
                                                                            <hr>
                                                                            <form id="productForm<?php echo $prod['id']; ?>" action="agregarAlCarrito" method="post">
                                                                                <label for="ID-Cantidad<?php echo $prod['id']; ?>" class="form-label">Seleccionar cantidad.</label>
                                                                                <select name="qty" id="ID-Cantidad<?php echo $prod['id']; ?>" class="form-select" aria-label="cantidad" required>
                                                                                    <?php for ($i = 1; $i <= $available_stock; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                                <input type="hidden" id="productPrice<?php echo $prod['id']; ?>" value="<?php echo $prod['precio_vta']; ?>">
                                                                                <p class="mt-2">Subtotal: $<span id="subtotal<?php echo $prod['id']; ?>"></span></p>
                                                                                <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                                                                                <input type="hidden" name="precio_vta" value="<?php echo $prod['precio_vta']; ?>">
                                                                                <input type="hidden" name="nombre_prod" value="<?php echo $prod['nombre_prod']; ?>">
                                                                                <?php else:?>
                                                                                    <p>Lo sentimos, por el momento no tenemos más stock de este producto...</p>
                                                                                <?php endif;?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <?php if ($available_stock != 0): ?>
                                                                            <input type="submit" value="Agregar al carrito" class="btn btn-primary btn-sm">
                                                                            <?php endif;?>
                                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php elseif ($perfil == '1'): ?>
                                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AvisoParaAdministradores2<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                                <div class="modal fade" id="AvisoParaAdministradores2<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="AvisoParaAdministradoresLabel2<?php echo $prod['id']; ?>" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5" id="AvisoParaAdministradoresLabel2<?php echo $prod['id']; ?>">Aviso para administradores.</h1>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Esta función solo esta activada para usuarios clientes.<p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php else:?>
                                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('login');?>"> Agregar al carrito </a>  
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php $isActive = false; ?>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev controlIzq" type="button" data-bs-target="#frutosSecos" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon flechaAnteriorProducto" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next controlDer" type="button" data-bs-target="#frutosSecos" data-bs-slide="next">
                            <span class="carousel-control-next-icon flechaSiguienteProducto" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif;?>

        <?php if ($harinasYFeculas!=null):?>
            <div class="row">
            <div class= "col-9">
                    <div class="container secundario">
                        <h3> Harinas y Féculas.</h3>
                    </div>
            </div>
            <div class= "col-3">
            </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="harinasYfeculas" class="carousel slide" data-bs-theme="dark">
                        <div class="carousel-inner">
                            <?php $isActive = true; ?>
                            <?php foreach (array_chunk($harinasYFeculas, 4) as $chunk): ?>
                                <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
                                    <div class="row">
                                        <?php foreach ($chunk as $prod): ?>
                                            
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-6 mb-2">
                                                    <div class="card" style="height:100%;">
                                                        <img src="<?=base_url()?>/assets/img/<?=$prod['imagen']?>" class="card-img-top" alt="<?=$prod['nombre_prod']?>">
                                                        <div class="card-body ">
                                                            <h5 class="card-title"><?= $prod['nombre_prod'] ?></h5>
                                                            <p class="card-text">$<?= $prod['precio_vta'] ?></p>
                                                        </div>
                                                        <div class="card-footer">
                                                            <?php if ($perfil == '2'): ?>
                                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarAlCarritoModal3<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                            <div class="modal fade" id="agregarAlCarritoModal3<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="agregarAlCarritoModalLabel3<?php echo $prod['id']; ?>" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="agregarAlCarritoModalLabel3<?php echo $prod['id']; ?>"><?php echo $prod['nombre_prod']; ?>.</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php
                                                                                $cart = \Config\Services::cart();
                                                                                $cartContenido = $cart->contents();
                                                                                $qty_in_cart = 0;
                                                                                foreach ($cartContenido as $item) {
                                                                                    if ($item['id'] == $prod['id']) {
                                                                                        $qty_in_cart = $item['qty'];
                                                                                        break;
                                                                                    }
                                                                                }
                                                                                $available_stock = $prod['stock'] - $qty_in_cart;
                                                                            ?>
                                                                            <?php if ($available_stock != 0): ?>
                                                                            <p>Precio Unitario: $<?php echo $prod['precio_vta']; ?></p>
                                                                            <p>Stock Disponible: <?php echo $available_stock ?></p>
                                                                            <hr>
                                                                            <form id="productForm<?php echo $prod['id']; ?>" action="agregarAlCarrito" method="post">
                                                                                <label for="ID-Cantidad<?php echo $prod['id']; ?>" class="form-label">Seleccionar cantidad.</label>
                                                                                <select name="qty" id="ID-Cantidad<?php echo $prod['id']; ?>" class="form-select" aria-label="cantidad" required>
                                                                                    <?php for ($i = 1; $i <= $available_stock; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                                <input type="hidden" id="productPrice<?php echo $prod['id']; ?>" value="<?php echo $prod['precio_vta']; ?>">
                                                                                <p class="mt-2">Subtotal: $<span id="subtotal<?php echo $prod['id']; ?>"></span></p>
                                                                                <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                                                                                <input type="hidden" name="precio_vta" value="<?php echo $prod['precio_vta']; ?>">
                                                                                <input type="hidden" name="nombre_prod" value="<?php echo $prod['nombre_prod']; ?>">
                                                                                <?php else:?>
                                                                                    <p>Lo sentimos, por el momento no tenemos más stock de este producto...</p>
                                                                                <?php endif;?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <?php if ($available_stock != 0): ?>
                                                                            <input type="submit" value="Agregar al carrito" class="btn btn-primary btn-sm">
                                                                            <?php endif;?>
                                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php elseif ($perfil == '1'): ?>
                                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AvisoParaAdministradores3<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                                <div class="modal fade" id="AvisoParaAdministradores3<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="AvisoParaAdministradoresLabel3<?php echo $prod['id']; ?>" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5" id="AvisoParaAdministradoresLabel3<?php echo $prod['id']; ?>">Aviso para administradores.</h1>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Esta función solo esta activada para usuarios clientes.<p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php else:?>
                                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('login');?>"> Agregar al carrito </a>  
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php $isActive = false; ?>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev controlIzq" type="button" data-bs-target="#harinasYfeculas" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon flechaAnteriorProducto" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next controlDer" type="button" data-bs-target="#harinasYfeculas" data-bs-slide="next">
                            <span class="carousel-control-next-icon flechaSiguienteProducto" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif;?>

        <?php if ($semillasYLegumbres!=null):?>
            <div class="row">
            <div class= "col-9">
                    <div class="container secundario">
                        <h3> Semillas y Legumbres.</h3>
                    </div>
            </div>
            <div class= "col-3">
            </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="semillasYlegumbres" class="carousel slide" data-bs-theme="dark">
                        <div class="carousel-inner">
                            <?php $isActive = true; ?>
                            <?php foreach (array_chunk($semillasYLegumbres, 4) as $chunk): ?>
                                <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
                                    <div class="row">
                                        <?php foreach ($chunk as $prod): ?>
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-6 mb-2">
                                                    <div class="card" style="height:100%;">
                                                        <img src="<?=base_url()?>/assets/img/<?=$prod['imagen']?>" class="card-img-top" alt="<?=$prod['nombre_prod']?>">
                                                        <div class="card-body ">
                                                            <h5 class="card-title"><?= $prod['nombre_prod'] ?></h5>
                                                            <p class="card-text">$<?= $prod['precio_vta'] ?></p>
                                                        </div>
                                                        <div class="card-footer">
                                                            <?php if ($perfil == '2'): ?>
                                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarAlCarritoModal4<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                            <div class="modal fade" id="agregarAlCarritoModal4<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="agregarAlCarritoModalLabel4<?php echo $prod['id']; ?>" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="agregarAlCarritoModalLabel4<?php echo $prod['id']; ?>"><?php echo $prod['nombre_prod']; ?>.</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php
                                                                                $cart = \Config\Services::cart();
                                                                                $cartContenido = $cart->contents();
                                                                                $qty_in_cart = 0;
                                                                                foreach ($cartContenido as $item) {
                                                                                    if ($item['id'] == $prod['id']) {
                                                                                        $qty_in_cart = $item['qty'];
                                                                                        break;
                                                                                    }
                                                                                }
                                                                                $available_stock = $prod['stock'] - $qty_in_cart;
                                                                            ?>
                                                                            <?php if ($available_stock != 0): ?>
                                                                            <p>Precio Unitario: $<?php echo $prod['precio_vta']; ?></p>
                                                                            <p>Stock Disponible: <?php echo $available_stock ?></p>
                                                                            <hr>
                                                                            <form id="productForm<?php echo $prod['id']; ?>" action="agregarAlCarrito" method="post">
                                                                                <label for="ID-Cantidad<?php echo $prod['id']; ?>" class="form-label">Seleccionar cantidad.</label>
                                                                                <select name="qty" id="ID-Cantidad<?php echo $prod['id']; ?>" class="form-select" aria-label="cantidad" required>
                                                                                    <?php for ($i = 1; $i <= $available_stock; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                                <input type="hidden" id="productPrice<?php echo $prod['id']; ?>" value="<?php echo $prod['precio_vta']; ?>">
                                                                                <p class="mt-2">Subtotal: $<span id="subtotal<?php echo $prod['id']; ?>"></span></p>
                                                                                <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                                                                                <input type="hidden" name="precio_vta" value="<?php echo $prod['precio_vta']; ?>">
                                                                                <input type="hidden" name="nombre_prod" value="<?php echo $prod['nombre_prod']; ?>">
                                                                                <?php else:?>
                                                                                    <p>Lo sentimos, por el momento no tenemos más stock de este producto...</p>
                                                                                <?php endif;?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <?php if ($available_stock != 0): ?>
                                                                            <input type="submit" value="Agregar al carrito" class="btn btn-primary btn-sm">
                                                                            <?php endif;?>
                                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php elseif ($perfil == '1'): ?>
                                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AvisoParaAdministradores4<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                                <div class="modal fade" id="AvisoParaAdministradores4<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="AvisoParaAdministradoresLabel4<?php echo $prod['id']; ?>" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5" id="AvisoParaAdministradoresLabel4<?php echo $prod['id']; ?>">Aviso para administradores.</h1>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Esta función solo esta activada para usuarios clientes.<p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php else:?>
                                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('login');?>"> Agregar al carrito </a>  
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>       
                                        <?php endforeach; ?>             
                                    </div>
                                </div>
                                <?php $isActive = false; ?>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev controlIzq" type="button" data-bs-target="#semillasYlegumbres" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon flechaAnteriorProducto" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next controlDer" type="button" data-bs-target="#semillasYlegumbres" data-bs-slide="next">
                            <span class="carousel-control-next-icon flechaSiguienteProducto" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif;?>

        <?php if ($suplementos!=null):?>
            <div class="row">
            <div class= "col-9">
                    <div class="container secundario">
                        <h3> Suplementos.</h3>
                    </div>
            </div>
            <div class= "col-3">
            </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="suplementos" class="carousel slide" data-bs-theme="dark">
                        <div class="carousel-inner">
                            <?php $isActive = true; ?>
                            <?php foreach (array_chunk($suplementos, 4) as $chunk): ?>
                                <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
                                    <div class="row">
                                        <?php foreach ($chunk as $prod): ?>
                                            
                                                <div class="col-lg-3 col-md-3 col-sm-6 col-6 mb-2">
                                                    <div class="card" style="height:100%;">
                                                        <img src="<?=base_url()?>/assets/img/<?=$prod['imagen']?>" class="card-img-top" alt="<?=$prod['nombre_prod']?>">
                                                        <div class="card-body ">
                                                            <h5 class="card-title"><?= $prod['nombre_prod'] ?></h5>
                                                            <p class="card-text">$<?= $prod['precio_vta'] ?></p>
                                                        </div>
                                                        <div class="card-footer">
                                                            <?php if ($perfil == '2'): ?>
                                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarAlCarritoModal5<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                            <div class="modal fade" id="agregarAlCarritoModal5<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="agregarAlCarritoModalLabel5<?php echo $prod['id']; ?>" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="agregarAlCarritoModalLabel5<?php echo $prod['id']; ?>"><?php echo $prod['nombre_prod']; ?>.</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php
                                                                                $cart = \Config\Services::cart();
                                                                                $cartContenido = $cart->contents();
                                                                                $qty_in_cart = 0;
                                                                                foreach ($cartContenido as $item) {
                                                                                    if ($item['id'] == $prod['id']) {
                                                                                        $qty_in_cart = $item['qty'];
                                                                                        break;
                                                                                    }
                                                                                }
                                                                                $available_stock = $prod['stock'] - $qty_in_cart;
                                                                            ?>
                                                                            <?php if ($available_stock != 0): ?>
                                                                            <p>Precio Unitario: $<?php echo $prod['precio_vta']; ?></p>
                                                                            <p>Stock Disponible: <?php echo $available_stock ?></p>
                                                                            <hr>
                                                                            <form id="productForm<?php echo $prod['id']; ?>" action="agregarAlCarrito" method="post">
                                                                                <label for="ID-Cantidad<?php echo $prod['id']; ?>" class="form-label">Seleccionar cantidad.</label>
                                                                                <select name="qty" id="ID-Cantidad<?php echo $prod['id']; ?>" class="form-select" aria-label="cantidad" required>
                                                                                    <?php for ($i = 1; $i <= $available_stock; $i++) : ?>
                                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php endfor; ?>
                                                                                </select>
                                                                                <input type="hidden" id="productPrice<?php echo $prod['id']; ?>" value="<?php echo $prod['precio_vta']; ?>">
                                                                                <p class="mt-2">Subtotal: $<span id="subtotal<?php echo $prod['id']; ?>"></span></p>
                                                                                <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                                                                                <input type="hidden" name="precio_vta" value="<?php echo $prod['precio_vta']; ?>">
                                                                                <input type="hidden" name="nombre_prod" value="<?php echo $prod['nombre_prod']; ?>">
                                                                                <?php else:?>
                                                                                    <p>Lo sentimos, por el momento no tenemos más stock de este producto...</p>
                                                                                <?php endif;?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <?php if ($available_stock != 0): ?>
                                                                            <input type="submit" value="Agregar al carrito" class="btn btn-primary btn-sm">
                                                                            <?php endif;?>
                                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php elseif ($perfil == '1'): ?>
                                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AvisoParaAdministradores5<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                                <div class="modal fade" id="AvisoParaAdministradores5<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="AvisoParaAdministradoresLabel5<?php echo $prod['id']; ?>" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5" id="AvisoParaAdministradoresLabel5<?php echo $prod['id']; ?>">Aviso para administradores.</h1>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>Esta función solo esta activada para usuarios clientes.<p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php else:?>
                                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url('login');?>"> Agregar al carrito </a>  
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php $isActive = false; ?>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev controlIzq" type="button" data-bs-target="#suplementos" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next controlDer" type="button" data-bs-target="#suplementos" data-bs-slide="next">
                            <span class="carousel-control-next-icon " aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif;?>

        <div class="row">
           <div class= "col-9">
                <div class="container secundario">
                    <h3> Todas las categorías.</h3>
                </div>
           </div>
           <div class= "col-3">
           </div>
        </div>
        <div class="rowFilaUnica">
            <a href="<?php echo base_url('catalogo_'.'TODOS');?>" class="card-container-FilaUnica textoSinSubrayado">
                <div class="card" data-bs-theme="dark" style="height:100%;">
                    <img src="assets/img/categoria_todos.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Todos los productos...</h5>        
                    </div>
                </div>
            </a>
            <?php foreach ($categorias as $categoria): ?>
                <?php $eliminado = $categoria['activo']; ?>
                <?php if ($eliminado == '1'): ?>
                    <a href="<?php echo base_url('catalogo_'.$categoria['id']); ?>" class="card-container-FilaUnica textoSinSubrayado">
                        <div class="card" data-bs-theme="dark" style="height:100%;">
                            <img src="<?=base_url()?>/assets/img/<?=$categoria['img']?>" class="card-img-top" alt="<?=$categoria['descripcion']?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $categoria['descripcion']; ?></h5>   
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        </div>   
    </div>

    <script src="assets/js/subtotalAgregarCarrito.js"></script>
  

