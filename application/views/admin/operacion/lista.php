<div class="my-3 pb-2 border-bottom">
    <div class="row">
        <div class="col-9 text-start">
            <h1 class="h2">Operaciones</h1>
        </div>
        <div class="col-2 text-end">
            <?php
                $permisos_requeridos = array(
                'operacion.can_edit',
                );
            ?>
            <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
                <form method="post" action="<?= base_url() ?>operacion/nuevo">
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
                <div class="col-3 col-sm-2 align-self-center">
                    <p class="small"><strong>Nombre</strong></p>
                </div>
                <div class="col-3 col-sm-1 col-sm-1 align-self-center">
                    <p class="small"><strong>Fecha</strong></p>
                </div>
                <div class="col-3 col-sm-2 align-self-center">
                    <p class="small"><strong>Producto</strong></p>
                </div>
                <div class="col-1 align-self-center text-end d-none d-sm-block">
                    <p class="small"><strong>Precio</strong></p>
                </div>
                <div class="col-1 align-self-center text-end d-none d-sm-block">
                    <p class="small"><strong>Cantidad</strong></p>
                </div>
                <div class="col-1 align-self-center text-end">
                    <p class="small"><strong>Total</strong></p>
                </div>
                <div class="col-2 align-self-center d-none d-sm-block">
                    <p class="small"><strong>Nota</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($operaciones as $operaciones_item) { ?>
            <div class="col-12 alternate-color">
                <div class="row">
                    <div class="col-1 align-self-center">
                        <p><a href="<?=base_url()?>operacion/detalle/<?=$operaciones_item['id_operacion']?>"><?= $operaciones_item['id_operacion'] ?></a></p>
                    </div>
                    <div class="col-3 col-sm-2 align-self-center">
                        <p><a href="<?=base_url()?>operacion/detalle/<?=$operaciones_item['id_operacion']?>"><?= $operaciones_item['nom_persona'] ?></a></p>
                    </div>
                    <div class="col-3 col-sm-1 col-sm-1 align-self-center">
                    <p><?= date('d-m-y', strtotime($operaciones_item['fecha'])) ?></p>
                    </div>
                    <div class="col-3 col-sm-2 align-self-center">
                        <p><?= $operaciones_item['nom_producto'] ?></p>
                    </div>
                    <div class="col-1 align-self-center text-end d-none d-sm-block">
                        <p><?= $operaciones_item['precio'] ?></p>
                    </div>
                    <div class="col-1 align-self-center text-end d-none d-sm-block">
                        <p><?= $operaciones_item['cantidad'] ?></p>
                    </div>
                    <div class="col-1 align-self-center text-end">
                        <p><?= $operaciones_item['precio'] * $operaciones_item['cantidad'] ?></p>
                    </div>
                    <div class="col-2 align-self-center d-none d-sm-block">
                        <p><?= substr($operaciones_item['nota'], 0, 30) ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <?php
                            $permisos_requeridos = array(
                            'persona.can_edit',
                            );
                        ?>
                        <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
                            <?php
                                $item_eliminar = $operaciones_item['nom_persona'] . " " . $operaciones_item['nom_producto'] ;
                                $url = base_url() . "operacion/eliminar/". $operaciones_item['id_operacion'];
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
