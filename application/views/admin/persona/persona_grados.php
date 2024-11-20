<div class="card mt-3 mb-3">
    <div class="card-header text-bg-success">
        Grados
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Grado</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Notas</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($persona_grados as $persona_grados_item) { ?>
                    <tr>
                        <td><?= $persona_grados_item['nom_grado'] ?></td>
                        <td><?= date('d-m-y', strtotime($persona_grados_item['fecha'])) ?></td>
                        <td><?= $persona_grados_item['nota'] ?></td>
                        <td>
                            <?php
                                $permisos_requeridos = array(
                                'persona.can_edit',
                                );
                            ?>
                            <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
                                <?php
                                    $item_eliminar = "Grado " . $persona_grados_item['nom_grado'] ;
                                    $url = base_url() . "persona_grado/eliminar/". $persona_grados_item['id_persona'] ."/" . $persona_grados_item['id_grado'];
                                ?>
                                <p><a href="#dlg_borrar" data-bs-toggle="modal" onclick="pass_data('<?=$item_eliminar?>', '<?=$url?>')" ><i class="bi bi-x-circle boton-eliminar" ></i>
                                </a></p>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
        $permisos_requeridos = array(
        'persona.can_edit',
        );
    ?>
    <?php if (has_permission_and($permisos_requeridos, $permisos_usuario)) { ?>
        <div class="card-footer">
            <form method="post" action="<?= base_url() ?>persona_grado/guardar">
                <div class="row mt-2 mb-3">
                    <div class="col-sm-6 mb-3">
                        <select class="form-select" name="id_grado" id="id_grado">
                            <option value="">Seleccione grado</option>
                            <?php foreach ($grados as $grados_item) { ?>
                                <option value="<?= $grados_item['id_grado'] ?>"><?= $grados_item['nom_grado'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <input type="date" class="form-control" name="fecha" id="fecha">
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" name="nota" id="nota">
                    </div>
                    <input type="hidden" name="id_persona" id="id_persona" value="<?=$persona['id_persona'] ?>">
                    <div class="col-2 text-end">
                        <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>
</div>
