<?php if(!empty (session()->getFlashdata('success'))):?>
    <div class="alert alert-success alert-dismissible"><?=session()->getFlashdata('success');?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?>  
<?php if(!empty (session()->getFlashdata('fail'))):?>
    <div class="alert alert-success alert-dismissible"><?=session()->getFlashdata('success');?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?>  

<div class="container-fluid principal">
    <a href="<?php echo base_url('mostrarMensajes_'.'todosLosMensajes');?>" class="btn btn-dark mb-1" style="width:100%"> Todos los mensajes</a>
    <a href="<?php echo base_url('mostrarMensajes_'.'leidos');?>" class="btn btn-dark mb-1" style="width:100%"> Leidos</a>
    <a href="<?php echo base_url('mostrarMensajes_'.'noleidos');?>" class="btn btn-dark mb-1" style="width:100%"> No Leidos</a>
    <div class="table-responsive">
        <table class="table table-success table-striped" id="user-list">
            <thead>
                <tr>
                    <th>Fecha Envio</th>
                    <th>Fuente</th>
                    <th>Nombre emisor</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Mensaje</th>
                    <th>Estado</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if($mensajes): ?>
                <?php foreach ($mensajes as $mensaje): ?>
                        <tr>
                            <td><?php echo $mensaje['fecha_envio']; ?></td>
                            <td><b><?php echo $mensaje['fuente']; ?></b></td>
                            <td style="max-width: 120px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"><?php echo $mensaje['nombre_emisor']; ?></td>
                            <td style="max-width: 120px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"><?php echo $mensaje['nombre_usuario']; ?></td>
                            <?php $linkMail= "mailto:".$mensaje['email']; ?>
                            <td style="max-width: 170px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"><a class="linksFooter" href="<?php echo $linkMail ?>"><?php echo $mensaje['email']; ?></a></td>
                            <td><?php echo $mensaje['telefono']; ?></td>
                            <td style="max-width: 200px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;"><?php echo $mensaje['mensaje']; ?></td>
                            <?php if ($mensaje['estado']=='1'): ?>
                                <td><b><p>No Leido</p></b></td>
                                <td><a href="<?php echo base_url('marcarComoLeido'.$mensaje['id_mensaje']);?>" class="btn btn-dark btn-sm mt-1">Visto.</a></td>
                            <?php elseif ($mensaje['estado']=='2'): ?>
                                <td><b><p>Leido</p></b></td>
                                <td><a href="<?php echo base_url('marcarComoRespondido'.$mensaje['id_mensaje']);?>" class="btn btn-dark btn-sm mt-1">Respondido.</a></td>
                            <?php else: ?>
                                <td><b><p>Respondido</p></b></td>
                                <td></td>
                            <?php endif; ?>
                        </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/controlDeFormularios.js"></script>