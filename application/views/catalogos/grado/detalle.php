<form method="post" action="<?= base_url() ?>grado/guardar/<?= $grado['id_grado'] ?>">
    <div class="my-3 pb-2 border-bottom">
        <div class="row">
            <div class="col-9">
                <h1 class="h2">Editar grado</h1>
            </div>
            <div class="col-2 text-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>

    <div class="area-contenido">
        <div class="form-group row">
            <label for="id_grado" class="col-sm-2 col-form-label">Clave</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="id_grado" id="id_grado" value="<?=$grado['id_grado'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="nom_grado" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nom_grado" id="nom_grado" value="<?=$grado['nom_grado'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="orden" class="col-sm-2 col-form-label">Orden</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="orden" id="orden" value="<?=$grado['orden'] ?>">
            </div>
        </div>
    </div>
</form>

<hr />

<div class="form-group row">
    <div class="col-10">
        <a href="<?=base_url()?>grado" class="btn btn-secondary">Volver</a>
    </div>
</div>
