<div class="card mt-3 mb-3">
    <div class="card-header text-bg-primary">
        Evento
    </div>
    <div class="card-body">
        <form method="post" action="<?= base_url() ?>evento/guardar/<?= $evento['id_evento'] ?>" id="frm_evento">
            <div class="row mb-3">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-1 mb-3">
                            <label for="id_evento" class="form-label">Clave</label>
                            <input type="text" class="form-control" name="id_evento" id="id_evento" value="<?=$evento['id_evento'] ?>">
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="nom_evento" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nom_evento" id="nom_evento" value="<?=$evento['nom_evento'] ?>">
                        </div>
                        <div class="col-sm-2 mb-3">
                            <label for="fecha_ini" class="form-label">Fecha de inicio</label>
                            <input type="date" class="form-control" name="fecha_ini" id="fecha_ini" value="<?=$evento['fecha_ini'] ?>">
                        </div>
                        <div class="col-sm-2 mb-3">
                            <label for="fecha_fin" class="form-label">Fecha de fin</label>
                            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?=$evento['fecha_fin'] ?>">
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="lugar" class="form-label">Lugar</label>
                            <input type="text" class="form-control" name="lugar" id="lugar" value="<?=$evento['lugar'] ?>">
                        </div>
                        <div class="col-sm-1 mb-3">
                            <label for="activo" class="form-label">Activo</label>
                            <input type="text" class="form-control" name="activo" id="activo" value="<?=$evento['activo'] ?>">
                        </div>
                        <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?= $evento['id_comunidad'] ?>">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
        $permisos_requeridos = array(
        'evento.can_edit',
        );
    ?>
    <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary btn-sm" form="frm_evento">Guardar</button>
        </div>
    <?php } ?>
</div>
