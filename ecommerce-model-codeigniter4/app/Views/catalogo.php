


<div class="container-fluid">
    <div class="row">
        <?php if($producto): ?>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 bg-dark bordeInferiorSolido d-none d-sm-block" >
                <a href="<?php echo base_url('catalogo_'.'TODOS');?>" class="btn btn-dark mb-1" style="width:100%"> Todos los productos</a>
                <?php foreach ($categorias as $categoria): ?>
                    <a href="<?php echo base_url('catalogo_'.$categoria['id']); ?>" class="btn btn-dark mb-1" style="width:100%"><?php echo $categoria['descripcion']; ?></a>
                <?php endforeach; ?>
            </div>   
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 d-block d-sm-none d-md-none d-lg-none d-xl-none mt-2" >
                <div class="accordion" data-bs-theme='dark' id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button text-center bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Filtros
                        </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <a href="<?php echo base_url('catalogo_'.'TODOS');?>" class="btn btn-dark mb-1" style="width:100%"> Todos los productos</a>
                            <?php foreach ($categorias as $categoria): ?>
                                <a href="<?php echo base_url('catalogo_'.$categoria['id']); ?>" class="btn btn-dark mb-1" style="width:100%"><?php echo $categoria['descripcion']; ?></a>
                            <?php endforeach; ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 mt-2">
            <div class="row">
                <?php foreach ($producto as $prod): ?>
                    <?php $eliminado = $prod['eliminado']; ?>
                        <?php if ($eliminado == 'NO'): ?>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-2">
                                        <div class="card" data-bs-theme="dark" style="height:100%;">
                                            <?php $imagen = $prod['imagen'];?>
                                            <img class="card-img-top" height="200px" width="200px" src="<?=base_url()?>/assets/img/<?=$imagen?>">
                                            <div class="card-body">
                                                <h5 class="card-title "><?php echo $prod['nombre_prod']; ?></h5>
                                                <p class="card-text">$<?php echo $prod['precio_vta']; ?></p>
                                               
                                                <?php
                                                    $session = session();
                                                    $perfil = $session->get('perfil_id');
                                                ?>
                                                <?php if ($perfil == '2'): ?>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agregarAlCarritoModal<?php echo $prod['id']; ?>"> Agregar al carrito </button>

                                                <div class="modal fade" id="agregarAlCarritoModal<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="agregarAlCarritoModalLabel<?php echo $prod['id']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="agregarAlCarritoModalLabel<?php echo $prod['id']; ?>"><?php echo $prod['nombre_prod']; ?>.</h1>
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
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#AvisoParaAdministradores<?php echo $prod['id']; ?>"> Agregar al carrito </button>
                                                    <div class="modal fade" id="AvisoParaAdministradores<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="AvisoParaAdministradoresLabel<?php echo $prod['id']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="AvisoParaAdministradoresLabel<?php echo $prod['id']; ?>">Aviso para administradores.</h1>
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
                        <?php endif; ?>
                <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="assets/js/subtotalAgregarCarrito.js"></script>