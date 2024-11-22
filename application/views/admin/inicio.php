<div class="col-12 px-5">
    <div class="row align-items-center g-5 py-3">
        <div class="col-sm-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?= $nom_comunidad ?></h1>
            <p class="lead d-none d-sm-block"><?= $comunidad['mensaje'] ?></p>
        </div>
        <div class="col-6 d-none d-sm-block">
            <?php
                $dir_docs = 'fotos/';
                $nom_archivo = 'foto_com_' . $id_comunidad;
                $tipo_archivo = 'jpg';
                $nombre_archivo = $nom_archivo . '.' . $tipo_archivo ;
                $nombre_archivo_fs = './' . $dir_docs . $nombre_archivo ;
                $nombre_archivo_url = base_url() . $dir_docs . $nombre_archivo;
                $url_actual = base_url() . 'comunidad/detalle/' . $id_comunidad;
            ?>
            <?php if ( file_exists($nombre_archivo_fs) ) { ?>
                <img class="rounded img-banner" src="<?=$nombre_archivo_url?>" >
            <?php } ?>
        </div>
    </div>
</div>

<div class="area-contenido mt-5">
    <div class="row">
        <div class="col-md-4">
            <?php include "persona/ultimas_personas.php"; ?>
        </div>
        <div class="col-md-4">
            <?php include "operacion/ultimas_operaciones.php"; ?>
        </div>
        <div class="col-md-4">
            <?php include "evento/ultimos_eventos.php"; ?>
        </div>
    </div>
</div>
