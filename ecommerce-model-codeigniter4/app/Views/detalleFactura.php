
<div class="container principal">
    <h3 class="mb-4"> Factura #nro<?php echo $cabecera['id']?></h3>
    <?php foreach ($usuarios as $usuario): ?>
        <?php if($cabecera['usuario_id'] == $usuario['id_usuario']): ?>
            <?php
                $nombreComprador = $usuario['nombre']." ".$usuario['apellido'];
                $emailComprador = $usuario['email'];
                break;
            ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <p> Cliente: <?php echo $nombreComprador?></p>
    <p> Email: <?php echo $emailComprador?></p>
    <p> Fecha de la compra: <?php echo $cabecera['fecha']?></p>
    <p> Monto total: $<?php echo $cabecera['total_venta']?></p>
    <h4 class="mt-2 mb-4"> Detalle</h4>
    <div class="table-responsive">
        <table class="table table-light table-striped" id="user-list">
            <thead>
                <tr>
                    <th>Indice</th>
                    <th>Nombre Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $indice = 1?>
                <?php foreach ($detalle as $prod): ?>    
                        <?php foreach ($productos as $producto): ?>
                            <?php if($producto['id'] == $prod['producto_id']): ?>
                                <?php
                                    $nombreProducto = $producto['nombre_prod'];
                                    break;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td><?php echo $indice; ?></td>
                            <td><?php echo $nombreProducto; ?></td>
                            <td>$<?php echo $prod['precio']; ?></td>
                            <td><?php echo $prod['cantidad']; ?></td>
                            <td>$<?php echo ($prod['precio'] * $prod['cantidad']); ?></td>
                        </tr>
                        <?php $indice++?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><b>Total: $<?php echo $cabecera['total_venta']?></b></p>
    </div>
</div>