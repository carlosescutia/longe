<div class="my-3 pb-2 border-bottom">
    <div class="row">
        <div class="col-9 text-start">
            <h1 class="h2">Eventos</h1>
        </div>
        <div class="col-2 text-end">
            <?php
                $permisos_requeridos = array(
                'evento.can_edit',
                );
            ?>
            <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
                <form method="post" action="<?= base_url() ?>evento/nuevo">
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
                <div class="col-5 col-sm-3 align-self-center">
                    <p class="small"><strong>Nombre</strong></p>
                </div>
                <div class="col-2 align-self-center">
                    <p class="small"><strong>Inicio</strong></p>
                </div>
                <div class="col-2 d-none d-sm-block align-self-center">
                    <p class="small"><strong>Fin</strong></p>
                </div>
                <div class="col-2 d-none d-sm-block align-self-center">
                    <p class="small"><strong>Lugar</strong></p>
                </div>
                <div class="col-1 align-self-center">
                    <p class="small"><strong>Activo</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($eventos as $eventos_item) { ?>
            <div class="col-12 alternate-color mx-2">
                <div class="row">
                    <div class="col-1 align-self-center">
                        <p><a href="<?=base_url()?>evento/detalle/<?=$eventos_item['id_evento']?>"><?= $eventos_item['id_evento'] ?></a></p>
                    </div>
                    <div class="col-5 col-sm-3 align-self-center">
                        <p><a href="<?=base_url()?>evento/detalle/<?=$eventos_item['id_evento']?>"><?= $eventos_item['nom_evento'] ?></a></p>
                    </div>
                    <div class="col-2 align-self-center">
                        <p><?= date('d/m/y', strtotime($eventos_item['fecha_ini'])) ?></p>
                    </div>
                    <div class="col-2 d-none d-sm-block align-self-center">
                        <p><?= date('d/m/y', strtotime($eventos_item['fecha_fin'])) ?></p>
                    </div>
                    <div class="col-2 d-none d-sm-block align-self-center">
                        <p><?= $eventos_item['lugar'] ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <p><?= $eventos_item['activo'] ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <?php
                            $permisos_requeridos = array(
                            'evento.can_edit',
                            );
                        ?>
                        <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
                            <?php
                                $item_eliminar = $eventos_item['id_evento'] . " " . $eventos_item['nom_evento'] ;
                                $url = base_url() . "evento/eliminar/". $eventos_item['id_evento'];
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
