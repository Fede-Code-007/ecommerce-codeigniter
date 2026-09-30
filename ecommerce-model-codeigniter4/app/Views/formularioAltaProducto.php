<?php if(!empty (session()->getFlashdata('fail'))):?>
    <div class="alert alert-danger alert-dismissible"><?=session()->getFlashdata('fail');?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?>

<?php if(!empty (session()->getFlashdata('success'))):?>
    <div class="alert alert-success alert-dismissible"><?=session()->getFlashdata('success');?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif?>  

<div class="container principal d-flex justify-content-center">
    <div class="card" style="width: 70%;" data-bs-theme="dark">
        <div class="card-header text-center">
        <h2>Alta Producto</h2>
        </div>
            
        <?php $validation = \Config\Services::validation(); ?>

        <form method="post" class="needs-validation" novalidate action="<?php echo base_url('validarAltaProducto') ?>"> 	
            <div class ="card-body justify-content-center" media="(max-width:768px)">
                <div class="form mb-2">
                    <label for="ID-Nombre" class="form-label">Nombre</label>
                    <input name="nombre_prod" id="ID-Nombre" type="text"  class="form-control" placeholder="nombre" maxlength="100" required>
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
                </div>
                <div class="mb-2">
                    <label for="ID-Imagen" class="form-label">Imagen</label>
                    <input name="imagen" id="ID-Imagen" type="file" class="form-control" placeholder="url" maxlength="200" required>
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
                <div class="mb-2">
                        <?php if (!empty($categorias) && is_array($categorias)): ?>
                            <?php $contador = 1;?>
                            <label for="ID-Categoria" class="form-label">Categoria</label>
                            <select name="categoria_id"  id="ID-Categoria" class="form-select" aria-label="categoria" required>
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
                    <!-- Error Del Lado del Cliente -->
                    <div id="ID-Categoria" class="invalid-feedback">
                        Este campo es obligatorio.
                    </div>
                </div>
                <div class="mb-2">
                    <label for="ID-Precio" class="form-label">Costo</label>
                    <input name="precio" id="ID-Precio" class="form-control"  placeholder="costo" required pattern="^\d{1,10}(\.\d{1,2})?$">
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
                </div>
                <div class="mb-2">
                    <label for="ID-PrecioVta" class="form-label">Precio venta</label>
                    <input name="precio_vta" id="ID-PrecioVta" class="form-control"  placeholder="precio" required pattern="^\d{1,10}(\.\d{1,2})?$">
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
                </div>
                <div class="mb-2">
                    <label for="ID-Stock" class="form-label">Stock</label>
                    <input name="stock" id="ID-Stock" class="form-control" placeholder="stock" pattern="^\d{1,11}$" required>
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
                </div>
                <div class="mb-2">
                    <label for="ID-StockMin" class="form-label">Stock Min</label>
                    <input name="stock_min" id="ID-StockMin" class="form-control" placeholder="stock min" pattern="^\d{1,11}$" required>
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
                </div>
            
                <input type="submit" value="Enviar" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<script src="assets/js/controlDeFormularios.js"></script>