<div class="my-3 pb-2 border-bottom">
    <div class="row">
        <div class="col-9 text-start">
            <h1 class="h2">Productos</h1>
        </div>
        <div class="col-2 text-end">
            <form method="post" action="<?= base_url() ?>producto/nuevo">
                <button type="submit" class="btn btn-primary">Nuevo</button>
            </form>
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
        <?php foreach ($productos as $productos_item) { ?>
            <div class="col-12 alternate-color mx-2">
                <div class="row">
                    <div class="col-1 align-self-center">
                        <p><a href="<?=base_url()?>producto/detalle/<?=$productos_item['id_producto']?>"><?= $productos_item['id_producto'] ?></a></p>
                    </div>
                    <div class="col-4 align-self-center">
                        <p><a href="<?=base_url()?>producto/detalle/<?=$productos_item['id_producto']?>"><?= $productos_item['nom_producto'] ?></a></p>
                    </div>
                    <div class="col-3 align-self-center">
                        <p><?= $productos_item['nom_comunidad'] ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <p><?= $productos_item['activo'] ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <?php
                            $item_eliminar = $productos_item['id_producto'] . " " . $productos_item['nom_producto'] ;
                            $url = base_url() . "producto/eliminar/". $productos_item['id_producto'];
                        ?>
                        <p><a href="#dlg_borrar" data-bs-toggle="modal" onclick="pass_data('<?=$item_eliminar?>', '<?=$url?>')" ><i class="bi bi-x-circle boton-eliminar" ></i>
                        </a></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<hr />

<div class="form-group row">
    <div class="col-sm-10">
        <a href="<?=base_url()?>catalogos" class="btn btn-secondary">Volver</a>
    </div>
</div>
