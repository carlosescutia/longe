<div class="my-3 pb-2 border-bottom">
    <div class="row">
        <div class="col-9 text-start">
            <h1 class="h2">Comunidades</h1>
        </div>
        <div class="col-2 text-end">
            <form method="post" action="<?= base_url() ?>comunidad/nuevo">
                <button type="submit" class="btn btn-primary">Nuevo</button>
            </form>
        </div>
    </div>
</div>

<div class="area-contenido">
    <div class="row">
        <div class="col-12 mx-2">
            <div class="row">
                <div class="col-1 align-self-center">
                    <p class="small"><strong>Clave</strong></p>
                </div>
                <div class="col-2 align-self-center">
                    <p class="small"><strong>Nombre</strong></p>
                </div>
                <div class="col-2 align-self-center">
                    <p class="small"><strong>Grupo</strong></p>
                </div>
                <div class="col-2 align-self-center">
                    <p class="small"><strong>Responsable</strong></p>
                </div>
                <div class="col-2 align-self-center">
                    <p class="small"><strong>Ciudad</strong></p>
                </div>
                <div class="col-1 align-self-center">
                    <p class="small"><strong>Activa</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($comunidades as $comunidades_item) { ?>
            <div class="col-12 alternate-color mx-2">
                <div class="row">
                    <div class="col-1 align-self-center">
                        <p><a href="<?=base_url()?>comunidad/detalle/<?=$comunidades_item['id_comunidad']?>"><?= $comunidades_item['id_comunidad'] ?></a></p>
                    </div>
                    <div class="col-2 align-self-center">
                        <p><a href="<?=base_url()?>comunidad/detalle/<?=$comunidades_item['id_comunidad']?>"><?= $comunidades_item['nom_comunidad'] ?></a></p>
                    </div>
                    <div class="col-2 align-self-center">
                        <p><?= $comunidades_item['nom_grupo'] ?></p>
                    </div>
                    <div class="col-2 align-self-center">
                        <p><?= $comunidades_item['nom_responsable'] ?></p>
                    </div>
                    <div class="col-2 align-self-center">
                        <p><?= $comunidades_item['ciudad'] ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <p><?= $comunidades_item['activo'] ?></p>
                    </div>
                    <div class="col-1 align-self-center">
                        <?php 
                            $item_eliminar = $comunidades_item['id_comunidad'] . " " . $comunidades_item['nom_comunidad'] ;
                            $url = base_url() . "comunidad/eliminar/". $comunidades_item['id_comunidad']; 
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
