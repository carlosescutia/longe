<div class="my-3 pb-2 border-bottom">
    <h2>Catálogos</h2>
</div>

<div class="area-contenido">
    <div class="row">
        <div class="col-sm-9 p-3">
            <h3>Aplicación</h3>
            <div class="row mb-3 gy-3">
                <?php
                    $permisos_requeridos = array(
                    'grupo.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-md-4">
                            <?php include "grupo/boton.php" ?>
                        </div>
                    <?php }
                ?>
                <?php
                    $permisos_requeridos = array(
                    'comunidad.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-md-4">
                            <?php include "comunidad/boton.php" ?>
                        </div>
                    <?php }
                ?>
                <?php
                    $permisos_requeridos = array(
                    'grado.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-md-4">
                            <?php include "grado/boton.php" ?>
                        </div>
                    <?php }
                ?>
                <?php
                    $permisos_requeridos = array(
                    'producto.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-md-4">
                            <?php include "producto/boton.php" ?>
                        </div>
                    <?php }
                ?>
                <?php
                    $permisos_requeridos = array(
                    'forma_pago.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-md-4">
                            <?php include "forma_pago/boton.php" ?>
                        </div>
                    <?php }
                ?>
                <?php
                    $permisos_requeridos = array(
                    'talla_yazbek.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-md-4">
                            <?php include "talla_yazbek/boton.php" ?>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
        <div class="col-sm-3 p-3 border bg-light">
            <h3>Sistema</h3>
            <div class="row mb-3 gy-3">
                <?php
                    $permisos_requeridos = array(
                    'usuario.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-sm-12">
                            <?php include "usuario/boton.php" ?>
                        </div>
                    <?php }
                ?>
                <?php
                    $permisos_requeridos = array(
                    'rol.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-sm-12">
                            <?php include "rol/boton.php" ?>
                        </div>
                    <?php }
                ?>
                <?php
                    $permisos_requeridos = array(
                    'opcion_sistema.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-sm-12">
                            <?php include "opcion_sistema/boton.php" ?>
                        </div>
                    <?php }
                ?>
                <?php
                    $permisos_requeridos = array(
                    'acceso_sistema.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-sm-12">
                            <?php include "acceso_sistema/boton.php" ?>
                        </div>
                    <?php }
                ?>
                <?php
                    $permisos_requeridos = array(
                    'parametro_sistema.can_edit',
                    );
                    if (has_permission_or($permisos_requeridos, $permisos_usuario)) { ?>
                        <div class="col-sm-12">
                            <?php include "parametro_sistema/boton.php" ?>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
    </div>
</div>
