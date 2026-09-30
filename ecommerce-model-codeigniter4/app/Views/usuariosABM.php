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
    <a href="<?php echo base_url('usuariosABM_'.'ACTIVOS');?>" class="btn btn-dark mb-1" style="width:100%"> Usuarios Activos</a>
    <a href="<?php echo base_url('usuariosABM_'.'ELIMINADOS');?>" class="btn btn-dark mb-1" style="width:100%"> Usuarios Eliminados</a>
    <div class="table-responsive">
        <table class="table table-success table-striped" id="user-list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Perfil</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if($usuario): ?>
                <?php foreach ($usuario as $user): ?>
                    <?php $eliminado = $user['baja']; ?>
                    <?php if ($user['id_usuario']!=session()->get('id_usuario')): ?>
                        <tr>
                            <td><?php echo $user['id_usuario']; ?></td>
                            <td><?php echo $user['nombre']; ?></td>
                            <td><?php echo $user['apellido']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['usuario']; ?></td>
                            <td><?php echo $user['perfil_id']; ?></td>
                            <td>
                                <?php if ($eliminado == 'NO'): ?>
                                    <?php $validation = \Config\Services::validation(); ?>
                                    <button type="button" class="btn btn-primary btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#modalModificarUsuario<?php echo $user['id_usuario']; ?>"> Modificar Perfil </button>
                                    <div class="modal fade text-white"  id="modalModificarUsuario<?php echo $user['id_usuario']; ?>" data-bs-theme="dark" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalModificarUsuarioLabel<?php echo $user['id_usuario']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 text-center" id="modalModificarUsuario<?php echo $user['id_usuario']; ?>">Modificar Perfil. #<?php echo $user['id_usuario']?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form class="needs-validation" novalidate method="post" action="<?php echo base_url('modificarUsuario'.$user['id_usuario'])?>">
                                                    <div class="modal-body text-start ">
                                                        
                                                        <?php if (!empty($perfiles) && is_array($perfiles)): ?>
                                                            <?php $contador = 1;?>
                                                            <label for="ID-Perfil" class="form-label">Perfil</label>
                                                            <select name="perfil_id"  id="ID-Perfil" class="form-select" aria-label="perfil" required>
                                                                <option value="">Seleccionar Perfil </option>
                                                                <?php foreach ($perfiles as $perfil):?>
                                                                    <option value="<?php echo $perfil['perfil_id'];?>"> <?php echo $contador, " - " , $perfil['descripcion']; ?>
                                                                    </option>
                                                                    <?php $contador++;?>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <div id="ID-Perfil" class="invalid-feedback">
                                                                Inserte un perfil válido!
                                                            </div>
                                                        <?php endif ?>   

                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" value="Modificar Perfil" class="btn btn-primary mb-2">
                                                        <button type="button" class="btn btn-dark mb-2" data-bs-dismiss="modal">Cancelar</button>
                                                    </div>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?php echo base_url('bajaUsuario'.$user['id_usuario']);?>" class="btn btn-secondary btn-sm mt-1">Dar de baja</a>
                                <?php else: ?>
                                    <a href="<?php echo base_url('altaUsuario'.$user['id_usuario']);?>" class="btn btn-dark btn-sm mt-1">Dar de alta</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/controlDeFormularios.js"></script>