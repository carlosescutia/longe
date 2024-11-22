<form method="post" action="<?= base_url() ?>grupo/guardar/<?= $grupo['id_grupo'] ?>">
    <div class="my-3 pb-2 border-bottom">
        <div class="row">
            <div class="col-9">
                <h1 class="h2">Editar grupo</h1>
            </div>
            <div class="col-2 text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>

    <div class="area-contenido">
        <div class="form-group row">
            <label for="id_grupo" class="col-sm-2 col-form-label">Clave</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="id_grupo" id="id_grupo" value="<?=$grupo['id_grupo'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="nom_grupo" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nom_grupo" id="nom_grupo" value="<?=$grupo['nom_grupo'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="activo" class="col-sm-2 col-form-label">Activo</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="activo" id="activo" value="<?=$grupo['activo'] ?>">
            </div>
        </div>
    </div>
</form>

<hr />

<div class="form-group row">
    <div class="col-10">
        <a href="<?=base_url()?>grupo" class="btn btn-secondary">Volver</a>
    </div>
</div>
