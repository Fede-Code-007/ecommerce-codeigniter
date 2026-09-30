<?php if(!empty (session()->getFlashdata('fail'))):?>
        <div class="alert alert-warning alert-dismissible"><?=session()->getFlashdata('fail');?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php endif?>
<div class="container-fluid principal" id="carrito">
    <div class="cart">
        <h2 class="text-center mb-3"> Mi Carrito</h2>
        <div class="text text-center">
            <?php
                $session = session();
                $cart = \Config\Services::cart();
                $cart = $cart->contents();
                if (empty($cart)){
                    echo '<p style="font-size:18px; font-style:italic; margin-bottom:142px">Aún no tienes productos agregados...</p>';
                } 
            ?>
        </div>
    </div>
    
    <?php if ($cart == TRUE):?>
            <div class="container">
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-hover table-dark table-striped ml-3">
                        <tr>
                           <td>ID</td> 
                           <td>Nombre del producto</td> 
                           <td>Precio</td> 
                           <td>Cantidad</td> 
                           <td>Total</td> 
                           <td>Opciones</td> 
                        </tr>
                        <?php
                            $gran_total=0;
                            $i=1;
                            foreach ($cart as $item):
                                echo form_hidden('cart['.$item['id'].'][id]', $item['id']);  
                                echo form_hidden('cart['.$item['id'].'][rowid]', $item['rowid']);
                                echo form_hidden('cart['.$item['id'].'][name]', $item['name']);
                                echo form_hidden('cart['.$item['id'].'][price]', $item['price']);
                                echo form_hidden('cart['.$item['id'].'][qty]', $item['qty']);    
                        ?>
                        <tr>
                            <td><?php echo $i++; ?> </td>
                            <td><?php echo $item['name']; ?> </td>
                            <td>$<?php echo number_format($item['price'], 2); ?> </td>
                            <td><?php echo $item['qty']; ?> </td>
                            <td>$<?php echo number_format($item['subtotal'], 2); ?> </td>
                            <td> 
                                <a href="<?php echo base_url('quitarDelCarrito'.$item['rowid'])?>" class="btn btn-danger btn-sm mb-2">Eliminar</a>
                                <?php  
                                    foreach($productos as $producto){
                                        if ($item['id'] == $producto['id']){
                                            $prod = $producto;
                                        }
                                    }
                                ?>
                                <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modificarCant<?php echo $prod['id']; ?>"> Modificar Cantidad </button>
                                <div class="modal fade text-white" data-bs-theme="dark" id="modificarCant<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="modificarCantLabel<?php echo $prod['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modificarCantLabel<?php echo $prod['id']; ?>"><?php echo $prod['nombre_prod']; ?>.</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Precio Unitario: $<?php echo $prod['precio_vta']; ?></p>
                                                <p>Stock Disponible: <?php echo $prod['stock']; ?></p>
                                                <hr>
                                                <form id="productForm<?php echo $prod['id']; ?>" action="<?= base_url('modificar_cant'.$item['rowid']);?>" method="post">
                                                    <label for="ID-Cantidad<?php echo $prod['id']; ?>" class="form-label">Seleccionar cantidad.</label>
                                                    <select name="qty" id="ID-Cantidad<?php echo $prod['id']; ?>" class="form-select" aria-label="cantidad" required>
                                                        <?php for ($i = 1; $i <= $prod['stock']; $i++) : ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                    <input type="hidden" id="productPrice<?php echo $prod['id']; ?>" value="<?php echo $prod['precio_vta']; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                                                    <input type="hidden" name="precio_vta" value="<?php echo $prod['precio_vta']; ?>">
                                                    <input type="hidden" name="nombre_prod" value="<?php echo $prod['nombre_prod']; ?>">
                                                    <p class="mt-2">Subtotal: $<span id="subtotal<?php echo $prod['id']; ?>"></span></p>  
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" value="Actualizar" class="btn btn-primary btn-sm">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td> 
                        </tr>
                        <?php $gran_total += $item['price'] * $item['qty']; ?>
                        <?php endforeach;?>
                        <tr class="table-secondary">
                            <td colspan="2">
                                <b>Total: $
                                    <?php echo number_format($gran_total, 2); ?>
                                </b>
                            </td>
                            <td colspan="4" class="text-end">
                                <a href="<?php echo base_url('borrarCarrito')?>" class="btn btn-dark btn-sm mb-1">Borrar carrito</a>
                                <a href="<?php echo base_url('comprarCarrito')?>" class="btn btn-dark btn-sm mb-1">Comprar</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
    <?php endif; ?>
</div>
<script src="assets/js/subtotalAgregarCarrito.js"></script>