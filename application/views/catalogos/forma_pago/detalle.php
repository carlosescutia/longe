<div class="col-sm-8 offset-sm-2">
    <div class="card mt-3 mb-3">
        <div class="card-header text-bg-primary">
            Editar forma de pago
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url() ?>forma_pago/guardar/<?= $forma_pago['id_forma_pago'] ?>" id="forma_pago">
                <div class="row mb-3">
                    <div class="col-sm-2 mb-3">
                        <label for="id_forma_pago" class="form-label">Clave</label>
                        <input type="text" class="form-control" name="id_forma_pago" id="id_forma_pago" value="<?=$forma_pago['id_forma_pago'] ?>" readonly>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label for="nom_forma_pago" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nom_forma_pago" id="nom_forma_pago" value="<?=$forma_pago['nom_forma_pago'] ?>">
                    </div>
                    <div class="col-sm-2 mb-3">
                        <label for="orden" class="form-label">Orden</label>
                        <input type="text" class="form-control" name="orden" id="orden" value="<?=$forma_pago['orden'] ?>">
                    </div>
                </div>
            </form>
        </div>
        <?php
            $permisos_requeridos = array(
            'forma_pago.can_edit',
            );
        ?>
        <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary btn-sm" form="forma_pago">Guardar</button>
            </div>
        <?php } ?>
    </div>
</div>

<hr />

<div class="form-group row">
    <div class="col-sm-10">
        <a href="<?=base_url()?>forma_pago" class="btn btn-secondary">Volver</a>
    </div>
</div>
