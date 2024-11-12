<form method="post" action="<?= base_url() ?>comunidad/guardar/<?= $comunidad['id_comunidad'] ?>">
    <div class="my-3 pb-2 border-bottom">
        <div class="row">
            <div class="col-9">
                <h1 class="h2">Editar comunidad</h1>
            </div>
            <div class="col-2 text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>

    <div class="area-contenido">
        <div class="form-group row">
            <label for="id_comunidad" class="col-sm-2 col-form-label">Clave</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="id_comunidad" id="id_comunidad" value="<?=$comunidad['id_comunidad'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="nom_comunidad" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nom_comunidad" id="nom_comunidad" value="<?=$comunidad['nom_comunidad'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="id_grupo" class="col-sm-2 col-form-label">Grupo</label>
            <div class="col-sm-2">
                <select class="form-select" name="id_grupo" id="id_grupo">
                    <option value="" <?= ($comunidad['id_grupo'] == '') ? 'selected' : '' ?> >Seleccione grupo</option>
                    <?php foreach ($grupos as $grupos_item) { ?>
                        <option value="<?= $grupos_item['id_grupo'] ?>" <?= ($comunidad['id_grupo'] == $grupos_item['id_grupo']) ? 'selected' : '' ?> ><?= $grupos_item['nom_grupo'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="id_responsable" class="col-sm-2 col-form-label">Responsable de la comunidad</label>
            <div class="col-sm-2">
                <select class="form-select" name="id_responsable" id="id_responsable">
                    <option value="" <?= ($comunidad['id_responsable'] == '') ? 'selected' : '' ?> >Seleccione persona</option>
                    <?php foreach ($instructores as $instructores_item) { ?>
                        <option value="<?= $instructores_item['id_persona'] ?>" <?= ($comunidad['id_responsable'] == $instructores_item['id_persona']) ? 'selected' : '' ?> ><?= $instructores_item['nom_persona'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="direccion" id="direccion" value="<?=$comunidad['direccion'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="telefono" id="telefono" value="<?=$comunidad['telefono'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="ciudad" class="col-sm-2 col-form-label">Ciudad</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="ciudad" id="ciudad" value="<?=$comunidad['ciudad'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="activo" class="col-sm-2 col-form-label">Activo</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="activo" id="activo" value="<?=$comunidad['activo'] ?>">
            </div>
        </div>
    </div>
</form>

<hr />

<div class="form-group row">
    <div class="col-10">
        <a href="<?=base_url()?>comunidad" class="btn btn-secondary">Volver</a>
    </div>
</div>
