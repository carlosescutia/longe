<div class="col-sm-8 offset-sm-2">
    <div class="card mt-3 mb-3">
        <div class="card-header text-bg-primary">
            Editar producto
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url() ?>producto/guardar/<?= $producto['id_producto'] ?>" id="producto">
                <div class="row mb-3">
                    <div class="col-sm-2 mb-3">
                        <label for="id_producto" class="form-label">Clave</label>
                        <input type="text" class="form-control" name="id_producto" id="id_producto" value="<?=$producto['id_producto'] ?>" readonly>
                    </div>
                    <div class="col-sm-2 mb-3">
                        <label for="cod_producto" class="form-label">Código</label>
                        <input type="text" class="form-control" name="cod_producto" id="cod_producto" value="<?=$producto['cod_producto'] ?>">
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label for="nom_producto" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nom_producto" id="nom_producto" value="<?=$producto['nom_producto'] ?>">
                    </div>
                    <div class="col-sm-2 mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" name="precio" id="precio" value="<?=$producto['precio'] ?>">
                    </div>
                    <div class="col-sm-2 mb-3">
                        <label for="activo" class="form-label">Activo</label>
                        <input type="text" class="form-control" name="activo" id="activo" value="<?=$producto['activo'] ?>">
                    </div>
                    <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?=$id_comunidad ?>">
                </div>
            </form>
        </div>
        <?php
            $permisos_requeridos = array(
            'producto.can_edit',
            );
        ?>
        <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary btn-sm" form="producto">Guardar</button>
            </div>
        <?php } ?>
    </div>
</div>

<hr />

<div class="form-group row">
    <div class="col-sm-10">
        <a href="<?=base_url()?>producto" class="btn btn-secondary">Volver</a>
    </div>
</div>
