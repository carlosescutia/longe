<div class="my-3 pb-2 border-bottom">
    <div class="row">
        <div class="col-9 text-start">
            <h1 class="h2">Personas</h1>
        </div>
        <div class="col-2 text-end">
            <?php
                $permisos_requeridos = array(
                'persona.can_edit',
                );
            ?>
            <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
                <form method="post" action="<?= base_url() ?>persona/nuevo">
                    <button type="submit" class="btn btn-primary">Nuevo</button>
                </form>
            <?php } ?>
        </div>
    </div>
</div>

<div class="area-contenido">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-1 align-self-center">
                    <p class="small"><strong>Clave</strong></p>
                </div>
                <div class="col-4 align-self-center">
                    <p class="small"><strong>Nombre</strong></p>
                </div>
                <div class="col-3 align-self-center">
                    <p class="small"><strong>Comunidad</strong></p>
                </div>
                <div class="col-1 align-self-center">
                    <p class="small"><strong>Activo</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($personas as $personas_item) { ?>
            <div class="col-12 alternate-color mx-2">
                <div class="row">
                    <div class="col-1 align-self-center">
                        <p><a href="<?=base_url()?>persona/detalle/<?=$personas_item['id_persona']?>"><?= $personas_item['id_persona'] ?></a></p>
                    </div>
                    <div class="col-4 align-self-center">
                        <p><a href="<?=base_url()?>persona/detalle/<?=$personas_item['id_persona']?>"><?= $personas_item['nom_persona'] ?></a></p>
                    </div>
                    <div class="col-3 align-self-center">
                        <p><?= $personas_item['nom_comunidad'] ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <p><?= $personas_item['activo'] ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <?php
                            $permisos_requeridos = array(
                            'persona.can_edit',
                            );
                        ?>
                        <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
                            <?php
                                $item_eliminar = $personas_item['id_persona'] . " " . $personas_item['nom_persona'] ;
                                $url = base_url() . "persona/eliminar/". $personas_item['id_persona'];
                            ?>
                            <p><a href="#dlg_borrar" data-bs-toggle="modal" onclick="pass_data('<?=$item_eliminar?>', '<?=$url?>')" ><i class="bi bi-x-circle boton-eliminar" ></i>
                            </a></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<hr />

<div class="form-group row">
    <div class="col-sm-10">
        <a href="<?=base_url()?>admin" class="btn btn-secondary">Volver</a>
    </div>
</div>
