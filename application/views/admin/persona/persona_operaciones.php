<div class="card mt-3 mb-3">
    <div class="card-header text-bg-primary">
        Operaciones
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-2 col-sm-1 align-self-center">
                        <p class="small"><strong>Clave</strong></p>
                    </div>
                    <div class="col-3 col-sm-2 align-self-center">
                        <p class="small"><strong>Producto</strong></p>
                    </div>
                    <div class="col-3 col-sm-1 col-sm-1 align-self-center">
                        <p class="small"><strong>Fecha</strong></p>
                    </div>
                    <div class="col-1 align-self-center text-end d-none d-sm-block">
                        <p class="small"><strong>Precio</strong></p>
                    </div>
                    <div class="col-1 align-self-center text-end d-none d-sm-block">
                        <p class="small"><strong>Cantidad</strong></p>
                    </div>
                    <div class="col-2 col-sm-1 align-self-center text-end">
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
                        <div class="col-2 col-sm-1 align-self-center">
                            <p><a href="<?=base_url()?>operacion/detalle/<?=$operaciones_item['id_operacion']?>"><?= $operaciones_item['id_operacion'] ?></a></p>
                        </div>
                        <div class="col-3 col-sm-2 align-self-center">
                            <p><a href="<?=base_url()?>operacion/detalle/<?=$operaciones_item['id_operacion']?>"><?= $operaciones_item['nom_producto'] ?></a></p>
                        </div>
                        <div class="col-3 col-sm-1 col-sm-1 align-self-center">
                        <p><?= date('d-m-y', strtotime($operaciones_item['fecha'])) ?></p>
                        </div>
                        <div class="col-1 align-self-center text-end d-none d-sm-block">
                            <p><?= $operaciones_item['precio'] ?></p>
                        </div>
                        <div class="col-1 align-self-center text-end d-none d-sm-block">
                            <p><?= $operaciones_item['cantidad'] ?></p>
                        </div>
                        <div class="col-2 col-sm-1 align-self-center text-end">
                            <p><?= $operaciones_item['precio'] * $operaciones_item['cantidad'] ?></p>
                        </div>
                        <div class="col-2 align-self-center d-none d-sm-block">
                            <p><?= substr($operaciones_item['nota'], 0, 30) ?></p>
                        </div>
                        <div class="col-1 align-self-center">
                            <?php
                                $permisos_requeridos = array(
                                'operacion.can_edit',
                                );
                            ?>
                            <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
                                <?php
                                    $item_eliminar = $operaciones_item['nom_producto'] . " " . date('d-m-y', strtotime($operaciones_item['fecha'])) ;
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
    <?php
        $permisos_requeridos = array(
        'operacion.can_edit',
        );
    ?>
    <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
        <div class="card-footer">
            <div class="col-12 text-end">
                <form method="post" action="<?= base_url() ?>operacion/nuevo">
                    <input type="hidden" name="id_persona" id="id_persona" value="<?= $persona['id_persona'] ?>">
                    <button type="submit" class="btn btn-primary">Nueva</button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>

