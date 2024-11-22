<div class="my-3 pb-2 border-bottom">
    <div class="row">
        <div class="col-9 text-start">
            <h1 class="h2">Grupos</h1>
        </div>
        <div class="col-2 text-end">
            <form method="post" action="<?= base_url() ?>grupo/nuevo">
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
                <div class="col-1 align-self-center">
                    <p class="small"><strong>Activo</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($grupos as $grupos_item) { ?>
            <div class="col-12 alternate-color mx-2">
                <div class="row">
                    <div class="col-1 align-self-center">
                        <p><a href="<?=base_url()?>grupo/detalle/<?=$grupos_item['id_grupo']?>"><?= $grupos_item['id_grupo'] ?></a></p>
                    </div>
                    <div class="col-4 align-self-center">
                        <p><a href="<?=base_url()?>grupo/detalle/<?=$grupos_item['id_grupo']?>"><?= $grupos_item['nom_grupo'] ?></a></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <p><?= $grupos_item['activo'] ?></p>
                    </div>
                    <div class="col-1">
                        <?php
                            $item_eliminar = $grupos_item['id_grupo'] . " " . $grupos_item['nom_grupo'] ;
                            $url = base_url() . "grupo/eliminar/". $grupos_item['id_grupo'];
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
    <div class="col-10">
        <a href="<?=base_url()?>catalogos" class="btn btn-secondary">Volver</a>
    </div>
</div>
