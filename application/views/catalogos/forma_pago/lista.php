<div class="my-3 pb-2 border-bottom">
    <div class="row">
        <div class="col-9 text-start">
            <h1 class="h2">Formas de pago</h1>
        </div>
        <div class="col-2 text-end">
            <form method="post" action="<?= base_url() ?>forma_pago/nuevo">
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
                <div class="col-2 align-self-center">
                    <p class="small"><strong>Nombre</strong></p>
                </div>
                <div class="col-1 align-self-center">
                    <p class="small"><strong>Orden</strong></p>
                </div>
                <div class="col-1 align-self-center">
                    <p class="small"><strong>Activo</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($formas_pago as $formas_pago_item) { ?>
            <div class="col-12 alternate-color mx-2">
                <div class="row">
                    <div class="col-1 align-self-center">
                        <p><a href="<?=base_url()?>forma_pago/detalle/<?=$formas_pago_item['id_forma_pago']?>"><?= $formas_pago_item['id_forma_pago'] ?></a></p>
                    </div>
                    <div class="col-2 align-self-center">
                        <p><a href="<?=base_url()?>forma_pago/detalle/<?=$formas_pago_item['id_forma_pago']?>"><?= $formas_pago_item['nom_forma_pago'] ?></a></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <p><?= $formas_pago_item['orden'] ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <p><?= $formas_pago_item['activo'] ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <?php
                            $item_eliminar = $formas_pago_item['id_forma_pago'] . " " . $formas_pago_item['nom_forma_pago'] ;
                            $url = base_url() . "forma_pago/eliminar/". $formas_pago_item['id_forma_pago'];
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
