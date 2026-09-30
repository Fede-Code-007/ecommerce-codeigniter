
<div class="container-fluid principal">
    <h3 class="text-center mb-4"> Facturas </h3>
    <?php if($facturas): ?>
    <div class="table-responsive">
        <table class="table table-light table-striped" id="user-list">
            <thead>
                <tr>
                    <th>Codigo ID</th>
                    <th>Fecha</th>
                    <th>Nombre del comprador</th>
                    <th>Usuario</th>
                    <th>Total de la venta</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($facturas as $factura): ?>    
                        <?php foreach ($usuarios as $usuario): ?>
                            <?php if($factura['usuario_id'] == $usuario['id_usuario']): ?>
                                <?php
                                    $nombreComprador = $usuario['nombre']." ".$usuario['apellido'];
                                    $nombreUsuario = $usuario['usuario'];
                                    break;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td><?php echo $factura['id']; ?></td>
                            <td><?php echo $factura['fecha']; ?></td>
                            <td><?php echo $nombreComprador; ?></td>
                            <td><?php echo $nombreUsuario; ?></td>
                            <td>$<?php echo $factura['total_venta']; ?></td>
                            <td><a class="btn btn-dark btn-sm" href="<?php echo base_url('detalleFactura_'.$factura['id']); ?>"> Ver detalle</a></td>  
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <p class="text-center" style="font-size:18px; margin-bottom:162px">Aún no tienes fácturas...</p>
    <?php endif; ?>
</div>

