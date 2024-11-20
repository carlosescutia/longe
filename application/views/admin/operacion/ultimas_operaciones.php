<div class="card mt-0 mb-3">
    <div class="card-header text-bg-secondary">
        Operaciones
    </div>
    <div class="card-body">
        <a href="<?=base_url()?>operacion" style="text-decoration: none">
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Producto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $num_registros = 0; ?>
                        <?php foreach ($operaciones as $operaciones_item) { ?>
                            <tr>
                                <td><?= $operaciones_item['nom_persona'] ?></td>
                                <td><?= date('d-m-y', strtotime($operaciones_item['fecha'])) ?></td>
                                <td><?= $operaciones_item['nom_producto'] ?></td>
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
