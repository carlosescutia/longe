<form method="post" action="<?= base_url() ?>persona/guardar/<?= $persona['id_persona'] ?>">
    <div class="my-3 pb-2 border-bottom">
        <div class="row">
            <div class="col-9">
                <h1 class="h2">Editar persona</h1>
            </div>
            <div class="col-2 text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>

    <div class="area-contenido">
        <div class="form-group row">
            <label for="id_persona" class="col-sm-2 col-form-label">Clave</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="id_persona" id="id_persona" value="<?=$persona['id_persona'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="nom_persona" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nom_persona" id="nom_persona" value="<?=$persona['nom_persona'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="id_comunidad" class="col-sm-2 col-form-label">Comunidad</label>
            <div class="col-sm-2">
                <select class="form-select" name="id_comunidad" id="id_comunidad">
                    <option value="" <?= ($persona['id_comunidad'] == '') ? 'selected' : '' ?> >Seleccione comunidad</option>
                    <?php foreach ($comunidades as $comunidades_item) { ?>
                        <option value="<?= $comunidades_item['id_comunidad'] ?>" <?= ($persona['id_comunidad'] == $comunidades_item['id_comunidad']) ? 'selected' : '' ?> ><?= $comunidades_item['nom_comunidad'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="fecha_ingreso" class="col-sm-2 col-form-label">Fecha de ingreso</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso" value="<?=$persona['fecha_ingreso'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="id_instructor_inicial" class="col-sm-2 col-form-label">Instructor inicial</label>
            <div class="col-sm-2">
                <select class="form-select" name="id_instructor_inicial" id="id_instructor_inicial">
                    <option value="" <?= ($persona['id_instructor_inicial'] == '') ? 'selected' : '' ?> >Seleccione instructor</option>
                    <?php foreach ($instructores as $instructores_item) { ?>
                        <option value="<?= $instructores_item['id_persona'] ?>" <?= ($persona['id_instructor_inicial'] == $instructores_item['id_persona']) ? 'selected' : '' ?> ><?= $instructores_item['nom_persona'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="id_instructor_actual" class="col-sm-2 col-form-label">Instructor actual</label>
            <div class="col-sm-2">
                <select class="form-select" name="id_instructor_actual" id="id_instructor_actual">
                    <option value="" <?= ($persona['id_instructor_actual'] == '') ? 'selected' : '' ?> >Seleccione instructor</option>
                    <?php foreach ($instructores as $instructores_item) { ?>
                        <option value="<?= $instructores_item['id_persona'] ?>" <?= ($persona['id_instructor_actual'] == $instructores_item['id_persona']) ? 'selected' : '' ?> ><?= $instructores_item['nom_persona'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="sexo" id="sexo" value="<?=$persona['sexo'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="id_talla_yazbek" class="col-sm-2 col-form-label">Talla yazbek</label>
            <div class="col-sm-2">
                <select class="form-select" name="id_talla_yazbek" id="id_talla_yazbek">
                    <option value="" <?= ($persona['id_talla_yazbek'] == '') ? 'selected' : '' ?> >Seleccione talla yazbek</option>
                    <?php foreach ($tallas_yazbek as $tallas_yazbek_item) { ?>
                        <option value="<?= $tallas_yazbek_item['id_talla_yazbek'] ?>" <?= ($persona['id_talla_yazbek'] == $tallas_yazbek_item['id_talla_yazbek']) ? 'selected' : '' ?> ><?= $tallas_yazbek_item['nom_talla_yazbek'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="es_instructor" class="col-sm-2 col-form-label">Es instructor?</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="es_instructor" id="es_instructor" value="<?=$persona['es_instructor'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="activo" class="col-sm-2 col-form-label">Activo</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="activo" id="activo" value="<?=$persona['activo'] ?>">
            </div>
        </div>
    </div>
</form>

<hr />

<div class="form-group row">
    <div class="col-10">
        <a href="<?=base_url()?>persona" class="btn btn-secondary">Volver</a>
    </div>
</div>
