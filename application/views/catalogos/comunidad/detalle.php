<form method="post" enctype="multipart/form-data" action="<?= base_url() ?>archivos/foto_comunidad" id="frm_foto_com">
    <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?= $comunidad['id_comunidad'] ?>" form="frm_foto_com">
</form>

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
        <div class="col-sm-6 mb-3">
            <div class="card text-center">
                <?php
                    $dir_docs = 'fotos/';
                    $nom_archivo = 'foto_com_' . $comunidad['id_comunidad'];
                    $tipo_archivo = 'jpg';
                    $nombre_archivo = $nom_archivo . '.' . $tipo_archivo ;
                    $nombre_archivo_fs = './' . $dir_docs . $nombre_archivo ;
                    $nombre_archivo_url = base_url() . $dir_docs . $nombre_archivo;
                    $url_actual = base_url() . 'comunidad/detalle/' . $comunidad['id_comunidad'];
                ?>

                <div class="card-body p-0">
                    <?php if ( file_exists($nombre_archivo_fs) ) { ?>
                        <img class="card-img-top border-bottom" src="<?=$nombre_archivo_url?>" >
                    <?php } else { ?>
                        <img class="border-bottom p-2" src="<?= base_url() ?>img/person-circle.svg" >
                    <?php } ?>
                </div>
                <div class="card-footer">
                    <!-- Permiso de edicion -->
                    <label tabindex="0" name="btn_archivo_<?=$nom_archivo?>" id="btn_archivo_<?=$nom_archivo?>"><i class="bi bi-file-plus boton-archivo-sm"></i>
                    <input name="subir_archivo" id="subir_archivo" type="file" class="d-none" onchange="$('#btn_subir_<?=$nom_archivo?>').removeClass('d-none'); $('#btn_archivo_<?=$nom_archivo?>').addClass('d-none');" form="frm_foto_com">
                    </label>

                    <input type="hidden" name="dir_docs" value="<?=$dir_docs?>" form="frm_foto_com">
                    <input type="hidden" name="nombre_archivo" value="<?=$nombre_archivo?>" form="frm_foto_com">
                    <input type="hidden" name="url_actual" value="<?=$url_actual?>" form="frm_foto_com">
                    <button id="btn_subir_<?=$nom_archivo?>" type="submit" class="btn btn-sm d-none" style="background: none; color: #28A745" form="frm_foto_com">
                        <i class="bi bi-upload boton-subir-sm"></i>
                    </button>
                    <?php if ( file_exists($nombre_archivo_fs) ) {
                        $item_eliminar = $nombre_archivo; ?>
                        &nbsp;
                        <a href="#dlg_borrar_archivo" data-bs-toggle="modal" onclick="pass_data_archivo('<?=$item_eliminar?>', '<?=$url_actual?>', '<?=$dir_docs?>')" ><i class="bi bi-x-circle boton-eliminar" ></i></a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="id_comunidad" class="col-sm-2 col-form-label">Clave</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" name="id_comunidad" id="id_comunidad" value="<?=$comunidad['id_comunidad'] ?>" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="nom_comunidad" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="nom_comunidad" id="nom_comunidad" value="<?=$comunidad['nom_comunidad'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="mensaje" class="col-sm-2 col-form-label">Mensaje</label>
            <div class="col-sm-4">
                <textarea class="form-control" name="mensaje" id="mensaje" rows="3"><?=$comunidad['mensaje'] ?></textarea>
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
