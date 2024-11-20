<div class="col-sm-8 offset-sm-2">
    <div class="card mt-3 mb-3">
        <div class="card-header text-bg-primary">
            Operación
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url() ?>operacion/guardar_producto/<?= $operacion['id_operacion'] ?>" id="frm_producto">
            </form>
            <form method="post" action="<?= base_url() ?>operacion/guardar_persona/<?= $operacion['id_operacion'] ?>" id="frm_persona">
            </form>
            <form method="post" action="<?= base_url() ?>operacion/guardar/<?= $operacion['id_operacion'] ?>" id="frm_operacion">
            </form>
            <div class="row mb-3">
                <div class="col-sm-2 offset-sm-2 mb-3">
                    <label for="id_operacion" class="form-label">Clave</label>
                    <input type="text" class="form-control" name="id_operacion" id="id_operacion" value="<?=$operacion['id_operacion'] ?>" form="frm_operacion">
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" id="fecha" value="<?=$operacion['fecha'] ?>" form="frm_operacion">
                </div>
                <div class="col-sm-3 mb-3">
                    <label for="id_persona" class="form-label">Persona</label>
                    <select class="form-select" name="id_persona" id="id_persona" onchange="this.form.submit()" form="frm_persona">
                        <option value="" <?= ($operacion['id_persona'] == '') ? 'selected' : '' ?> >Seleccione persona</option>
                        <?php foreach ($personas as $personas_item) { ?>
                        <option value="<?= $personas_item['id_persona'] ?>" <?= ($operacion['id_persona'] == $personas_item['id_persona']) ? 'selected' : '' ?> ><?= $personas_item['nom_persona'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 offset-sm-1 mb-3">
                    <label for="id_producto" class="form-label">Producto</label>
                    <select class="form-select" name="id_producto" id="id_producto" onchange="this.form.submit()" form="frm_producto">
                        <option value="" <?= ($operacion['id_producto'] == '') ? 'selected' : '' ?> >Seleccione producto</option>
                        <?php foreach ($productos as $productos_item) { ?>
                            <option value="<?= $productos_item['id_producto'] ?>" <?= ($operacion['id_producto'] == $productos_item['id_producto']) ? 'selected' : '' ?> ><?= $productos_item['nom_producto'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-2 mb-3">
                    <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control text-end" name="precio" id="precio" value="<?= $operacion['precio'] ?>" readonly>
                </div>
                <div class="col-sm-2 mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="text" class="form-control text-end" name="cantidad" id="cantidad" value="<?=$operacion['cantidad'] ?>" form="frm_operacion">
                </div>
                <div class="col-sm-2 mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="text" class="form-control text-end" name="total" id="total" value="<?=$operacion['precio'] * $operacion['cantidad'] ?>" form="frm_operacion">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 offset-sm-1 mb-3">
                    <label for="id_forma_pago" class="form-label">Forma de pago</label>
                    <select class="form-select" name="id_forma_pago" id="id_forma_pago" form="frm_operacion">
                        <option value="" <?= ($operacion['id_forma_pago'] == '') ? 'selected' : '' ?> >Seleccione forma de pago</option>
                        <?php foreach ($formas_pago as $formas_pago_item) { ?>
                        <option value="<?= $formas_pago_item['id_forma_pago'] ?>" <?= ($operacion['id_forma_pago'] == $formas_pago_item['id_forma_pago']) ? 'selected' : '' ?> ><?= $formas_pago_item['nom_forma_pago'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="nota" class="form-label">Notas</label>
                    <input type="text" class="form-control" name="nota" id="nota" value="<?=$operacion['nota'] ?>" form="frm_operacion">
                </div>
            </div>
        </div>
        <?php
            $permisos_requeridos = array(
            'operacion.can_edit',
            );
        ?>
        <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary btn-sm" form="frm_operacion">Guardar</button>
            </div>
        <?php } ?>
    </div>
</div>

<hr />

<div class="form-group row">
    <div class="col-sm-10">
        <a href="<?= $previous_url ?>" class="btn btn-secondary">Volver</a>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#cantidad').change(function() {
            $('#total').val( $('#precio').val() * $('#cantidad').val()  );
        });
    })
</script>
