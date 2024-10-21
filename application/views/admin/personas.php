<div class="card mt-0 mb-3">
    <div class="card-header text-bg-secondary">
        Personas
    </div>
    <div class="card-body">
        <a href="<?=base_url()?>persona" style="text-decoration: none">
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th class="text-center" scope="col">Activo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $num_registros = 0; ?>
                        <?php foreach ($personas as $personas_item) { ?>
                            <tr>
                                <td><?= $personas_item['nom_persona'] ?></td>
                                <td class="text-center"><?= $personas_item['activo'] ? 'Si' : 'No' ?></td>
                            </tr>
                            <?php
                                $num_registros += 1;
                                if ($num_registros == 3) break;
                            ?>
                        <?php } ?>
                        <tr>
                            <td>...</td>
                            <td class="text-center"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </a>
    </div>
</div>
