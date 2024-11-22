<div class="card mt-0 mb-3">
    <div class="card-header text-bg-secondary">
        Eventos
    </div>
    <div class="card-body">
        <a href="<?=base_url()?>evento" style="text-decoration: none">
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th class="text-center" scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $num_registros = 0; ?>
                        <?php foreach ($eventos as $eventos_item) { ?>
                            <tr>
                                <td><?= $eventos_item['nom_evento'] ?></td>
                                <td class="text-center"><?= date('d/m/y', strtotime($eventos_item['fecha_ini'])) ?></td>
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
