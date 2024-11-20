<div class="my-3 pb-2 border-bottom">
    <h2><?= $nom_comunidad ?></h2>
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
