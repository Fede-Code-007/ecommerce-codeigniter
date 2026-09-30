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
    <a href="<?php echo base_url('productosABM_'.'TODOS');?>" class="btn btn-dark mb-1" style="width:100%"> Todos los productos</a>
    <a href="<?php echo base_url('productosABM_'.'ACTIVOS');?>" class="btn btn-dark mb-1" style="width:100%"> Productos Activos</a>
    <a href="<?php echo base_url('productosABM_'.'ELIMINADOS');?>" class="btn btn-dark mb-1" style="width:100%"> Productos Eliminados</a>
    <a href="<?php echo base_url('formularioAltaProducto');?>" class="btn btn-dark mb-1" style="width:100%"> + Nuevo Producto</a>
    <div class="table-responsive">
        <table class="table table-success table-striped" id="user-list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Costo</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Stock Min</th>
                    <th>Imagen</th>
                    <th>Eliminado</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if($producto): ?>
                <?php foreach ($producto as $prod): ?>
                    <?php $eliminado = $prod['eliminado']; ?>
                        <tr>
                            <td><?php echo $prod['id']; ?></td>
                            <td><?php echo $prod['nombre_prod']; ?></td>
                            <td><?php echo $prod['precio']; ?></td>
                            <td><?php echo $prod['precio_vta']; ?></td>
                            <td><?php echo $prod['stock']; ?></td>
                            <td><?php echo $prod['stock_min']; ?></td>
                            <?php $imagen = $prod['imagen'];?>
                            <?php $id = $prod['id'];?>
                            <td> <img height="70px" width="85px" src="<?=base_url()?>/assets/img/<?=$imagen?>"></td>
                            <td><b><?php echo $eliminado; ?></b></td>
                            <td>
                                <?php $validation = \Config\Services::validation(); ?>
                                <button type="button" class="btn btn-primary btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#modalModificarProducto<?php echo $prod['id']; ?>"> Modificar </button>
                                <div class="modal fade text-white"  id="modalModificarProducto<?php echo $prod['id']; ?>" data-bs-theme="dark" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalModificarProductoLabel<?php echo $prod['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 text-center" id="modalModificarProducto<?php echo $prod['id']; ?>">Modificar Producto. #<?php echo $prod['id']?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form class="needs-validation" novalidate method="post" action="<?php echo base_url('modificarProducto'.$prod['id'])?>">
                                                <div class="modal-body text-start ">
                                                    <label for="ID-Nombre" class="form-label ">Nombre</label>
                                                    <input name="nombre_prod" id="ID-Nombre" type="text"  class="form-control" placeholder="nombre" maxlength="100" required value="<?php echo $prod['nombre_prod'];?>">
                                                    <!-- Error Del Lado del Cliente -->
                                                    <div id="ID-Nombre" class="invalid-feedback">
                                                        Inserte un nombre válido. El nombre no debe tener más de 100 caracteres.
                                                    </div>
                                                    <!-- Error Del Lado del Servidor -->
                                                    <?php if($validation->getError('nombre_prod')) {?>
                                                        <div class='alert alert-danger alert-dismissible mt-2'>
                                                        <?= $error = $validation->getError('nombre_prod'); ?>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php }?>

                                                    <label for="ID-Precio" class="form-label mt-2">Costo</label>
                                                    <input name="precio" id="ID-Precio" class="form-control"  placeholder="costo" required pattern="^\d{1,10}(\.\d{1,2})?$" value="<?php echo $prod['precio'];?>">
                                                    <!-- Error Del Lado del Cliente -->
                                                    <div id="ID-Precio" class="invalid-feedback">
                                                        Inserte un precio valido no superior a $9999999999,99.
                                                    </div>
                                                    <!-- Error Del Lado del Servidor -->
                                                    <?php if($validation->getError('precio')) {?>
                                                        <div class='alert alert-danger alert-dismissible mt-2'>
                                                        <?= $error = $validation->getError('precio'); ?>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php }?>
                                                   
                                                    <?php if (!empty($categorias) && is_array($categorias)): ?>
                                                        <?php $contador = 1;?>
                                                        <label for="ID-Categoria" class="form-label">Categoria</label>
                                                        <select name="categoria_id"  id="ID-Categoria" class="form-select" aria-label="categoria">
                                                            <option value="">Seleccionar Categoria </option>
                                                            <?php foreach ($categorias as $categoria):?>
                                                                <option value="<?php echo $categoria['id'];?>"> <?php echo $contador, " - " , $categoria['descripcion']; ?>
                                                                </option>
                                                                <?php $contador++;?>
                                                                <div id="ID-categoria" class="invalid-feedback">
                                                                    Inserte una categoria válida.
                                                                </div>
                                                            <?php endforeach ?>
                                                        </select>
                                                    <?php endif ?>   

                                                    <label for="ID-PrecioVta" class="form-label mt-2">Precio venta</label>
                                                    <input name="precio_vta" id="ID-PrecioVta" class="form-control"  placeholder="precio" required pattern="^\d{1,10}(\.\d{1,2})?$" value="<?php echo $prod['precio_vta'];?>">
                                                    <!-- Error Del Lado del Cliente -->
                                                    <div id="ID-PrecioVta" class="invalid-feedback">
                                                    Inserte un precio valido no superior a $9999999999,99.
                                                    </div>
                                                    <!-- Error Del Lado del Servidor -->
                                                    <?php if($validation->getError('precio_vta')) {?>
                                                        <div class='alert alert-danger alert-dismissible mt-2'>
                                                        <?= $error = $validation->getError('precio_vta'); ?>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php }?>  

                                                    <label for="ID-Stock" class="form-label mt-2">Stock</label>
                                                    <input name="stock" id="ID-Stock" class="form-control" placeholder="stock" pattern="^\d{1,11}$" required value="<?php echo $prod['stock'];?>">
                                                    <!-- Error Del Lado del Cliente -->
                                                    <div id="ID-Stock" class="invalid-feedback">
                                                        Inserte un valor válido. El stock no debe superar las 99999999999 unidades.
                                                    </div>
                                                    <!-- Error Del Lado del Servidor -->
                                                    <?php if($validation->getError('stock')) {?>
                                                        <div class='alert alert-danger alert-dismissible mt-2'>
                                                        <?= $error = $validation->getError('stock'); ?>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php }?>

                                                    <label for="ID-StockMin" class="form-label mt-2">Stock Min</label>
                                                    <input name="stock_min" id="ID-StockMin" class="form-control" placeholder="stock min" pattern="^\d{1,11}$" required value="<?php echo $prod['stock_min'];?>">
                                                    <!-- Error Del Lado del Cliente -->
                                                    <div id="ID-StockMin" class="invalid-feedback">
                                                        Inserte un valor válido. El stock no debe superar las 99999999999 unidades.
                                                    </div>
                                                    <!-- Error Del Lado del Servidor -->
                                                    <?php if($validation->getError('stock_min')) {?>
                                                        <div class='alert alert-danger alert-dismissible mt-2'>
                                                        <?= $error = $validation->getError('stock_min'); ?>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php }?>

                                                    <label for="ID-Imagen" class="form-label mt-2">Imagen</label>
                                                    <input name="imagen" id="ID-Imagen" type="file" class="form-control" placeholder="url" maxlength="200">
                                                    <!-- Error Del Lado del Cliente -->
                                                    <div id="ID-Imagen" class="invalid-feedback">
                                                        Inserte una url válida. La url no debe superar los 200 caracteres.
                                                    </div>
                                                    <!-- Error Del Lado del Servidor -->
                                                    <?php if($validation->getError('imagen')) {?>
                                                        <div class='alert alert-danger alert-dismissible mt-2'>
                                                        <?= $error = $validation->getError('imagen'); ?>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php }?>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Modificar" class="btn btn-primary mb-2">
                                                    <button type="button" class="btn btn-dark mb-2" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                                <?php if ($eliminado == 'NO'): ?>
                                    <a href="<?php echo base_url('bajaProducto'.$id);?>" class="btn btn-secondary btn-sm mt-1">Dar de baja</a> 
                                <?php else: ?>
                                    <a href="<?php echo base_url('altaProducto'.$id);?>" class="btn btn-secondary btn-sm mt-1">Dar de alta</a> 
                                <?php endif; ?>
                            </td>
                        </tr>
                    
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/controlDeFormularios.js"></script>