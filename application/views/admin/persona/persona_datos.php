<div class="card mt-3 mb-3">
    <div class="card-header text-bg-primary">
        Persona
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="<?= base_url() ?>archivos/foto_persona" id="frm_foto">
            <input type="hidden" name="id_persona" id="id_persona" value="<?= $persona['id_persona'] ?>" form="frm_foto">
        </form>

        <form method="post" action="<?= base_url() ?>persona/guardar/<?= $persona['id_persona'] ?>" id="frm_persona">
            <div class="row mb-3">
                <div class="col-6 offset-3 col-sm-2 offset-sm-0 mb-3">
                    <div class="card text-center">
                        <?php
                            $dir_docs = 'fotos/';
                            $nom_archivo = 'foto_' . $persona['id_persona'];
                            $tipo_archivo = 'jpg';
                            $nombre_archivo = $nom_archivo . '.' . $tipo_archivo ;
                            $nombre_archivo_fs = './' . $dir_docs . $nombre_archivo ;
                            $nombre_archivo_url = base_url() . $dir_docs . $nombre_archivo;
                            $url_actual = base_url() . 'persona/detalle/' . $persona['id_persona'];
                        ?>

                        <div class="card-body p-0">
                            <?php if ( file_exists($nombre_archivo_fs) ) { ?>
                                <img class="card-img-top border-bottom" src="<?=$nombre_archivo_url?>" >
                            <?php } else { ?>
                                <img class="card-img-top border-bottom p-2" src="<?= base_url() ?>img/person-circle.svg" >
                            <?php } ?>
                        </div>
                        <div class="card-footer">
                            <!-- Permiso de edicion -->
                            <label tabindex="0" name="btn_archivo_<?=$nom_archivo?>" id="btn_archivo_<?=$nom_archivo?>"><i class="bi bi-file-plus boton-archivo-sm"></i>
                            <input name="subir_archivo" id="subir_archivo" type="file" class="d-none" onchange="$('#btn_subir_<?=$nom_archivo?>').removeClass('d-none'); $('#btn_archivo_<?=$nom_archivo?>').addClass('d-none');" form="frm_foto">
                            </label>

                            <input type="hidden" name="dir_docs" value="<?=$dir_docs?>" form="frm_foto">
                            <input type="hidden" name="nombre_archivo" value="<?=$nombre_archivo?>" form="frm_foto">
                            <input type="hidden" name="url_actual" value="<?=$url_actual?>" form="frm_foto">
                            <button id="btn_subir_<?=$nom_archivo?>" type="submit" class="btn btn-sm d-none" style="background: none; color: #28A745" form="frm_foto">
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
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2 mb-3">
                            <label for="id_persona" class="form-label">Clave</label>
                            <input type="text" class="form-control" name="id_persona" id="id_persona" value="<?=$persona['id_persona'] ?>" form="frm_persona">
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label for="nom_persona" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nom_persona" id="nom_persona" value="<?=$persona['nom_persona'] ?>" form="frm_persona">
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="id_comunidad" class="form-label">Comunidad</label>
                            <select class="form-select" name="id_comunidad" id="id_comunidad" form="frm_persona">
                                <option value="" <?= ($persona['id_comunidad'] == '') ? 'selected' : '' ?> >Seleccione comunidad</option>
                                <?php foreach ($comunidades as $comunidades_item) { ?>
                                    <option value="<?= $comunidades_item['id_comunidad'] ?>" <?= ($persona['id_comunidad'] == $comunidades_item['id_comunidad']) ? 'selected' : '' ?> ><?= $comunidades_item['nom_comunidad'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
                            <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso" value="<?=$persona['fecha_ingreso'] ?>" form="frm_persona">
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label for="id_instructor_inicial" class="form-label">Instructor inicial</label>
                            <select class="form-select" name="id_instructor_inicial" id="id_instructor_inicial" form="frm_persona">
                                <option value="" <?= ($persona['id_instructor_inicial'] == '') ? 'selected' : '' ?> >Seleccione instructor</option>
                                <?php foreach ($instructores as $instructores_item) { ?>
                                    <option value="<?= $instructores_item['id_persona'] ?>" <?= ($persona['id_instructor_inicial'] == $instructores_item['id_persona']) ? 'selected' : '' ?> ><?= $instructores_item['nom_persona'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label for="id_instructor_actual" class="form-label">Instructor actual</label>
                            <select class="form-select" name="id_instructor_actual" id="id_instructor_actual" form="frm_persona">
                                <option value="" <?= ($persona['id_instructor_actual'] == '') ? 'selected' : '' ?> >Seleccione instructor</option>
                                <?php foreach ($instructores as $instructores_item) { ?>
                                    <option value="<?= $instructores_item['id_persona'] ?>" <?= ($persona['id_instructor_actual'] == $instructores_item['id_persona']) ? 'selected' : '' ?> ><?= $instructores_item['nom_persona'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-1 mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <input type="text" class="form-control" name="sexo" id="sexo" value="<?=$persona['sexo'] ?>" form="frm_persona">
                        </div>
                        <div class="col-sm-3 mb-3">
                            <label for="id_talla_yazbek" class="form-label">Talla yazbek</label>
                            <select class="form-select" name="id_talla_yazbek" id="id_talla_yazbek" form="frm_persona">
                                <option value="" <?= ($persona['id_talla_yazbek'] == '') ? 'selected' : '' ?> >Seleccione talla yazbek</option>
                                <?php foreach ($tallas_yazbek as $tallas_yazbek_item) { ?>
                                    <option value="<?= $tallas_yazbek_item['id_talla_yazbek'] ?>" <?= ($persona['id_talla_yazbek'] == $tallas_yazbek_item['id_talla_yazbek']) ? 'selected' : '' ?> ><?= $tallas_yazbek_item['nom_talla_yazbek'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-2 mb-3">
                            <label for="es_instructor" class="form-label">Es instructor?</label>
                            <input type="text" class="form-control" name="es_instructor" id="es_instructor" value="<?=$persona['es_instructor'] ?>" form="frm_persona">
                        </div>
                        <div class="col-sm-1 mb-3">
                            <label for="activo" class="form-label">Activo</label>
                            <input type="text" class="form-control" name="activo" id="activo" value="<?=$persona['activo'] ?>" form="frm_persona">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
        $permisos_requeridos = array(
        'persona.can_edit',
        );
    ?>
    <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary btn-sm" form="frm_persona">Guardar</button>
        </div>
    <?php } ?>
</div>
