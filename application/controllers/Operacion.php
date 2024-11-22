<?php
class Operacion extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->helper('form');
        $this->load->model('operacion_model');
        $this->load->model('persona_model');
        $this->load->model('comunidad_model');
        $this->load->model('producto_model');
        $this->load->model('forma_pago_model');
    }

    public function index()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'operacion.can_view',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['operaciones'] = $this->operacion_model->get_operaciones($data['id_comunidad'], $data['id_rol']);
                $this->session->set_userdata('previous_url', current_url());

                $this->load->view('templates/admheader', $data);
                $this->load->view('templates/dlg_borrar');
                $this->load->view('admin/operacion/lista', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function detalle($id_operacion)
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'operacion.can_view',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['operacion'] = $this->operacion_model->get_operacion($id_operacion);
                $data['comunidades'] = $this->comunidad_model->get_comunidades_activas($data['id_comunidad'], $data['id_rol']);
                $data['personas'] = $this->persona_model->get_personas_activas($data['id_comunidad'], $data['id_rol']);
                $data['productos'] = $this->producto_model->get_productos_activos($data['id_comunidad'], $data['id_rol']);
                $data['formas_pago'] = $this->forma_pago_model->get_formas_pago_activas($data['id_comunidad'], $data['id_rol']);
                $data['previous_url'] = $this->session->userdata('previous_url');

                $this->load->view('templates/admheader', $data);
                $this->load->view('admin/operacion/detalle', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function nuevo()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();

            $permisos_requeridos = array(
                'operacion.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $operacion = $this->input->post();
                if (!empty($operacion['id_persona'])) {
                    $new_persona = $operacion['id_persona'] ;
                } else {
                    $new_persona = $this->persona_model->get_ultima_persona($data['id_comunidad'])['id_persona'];
                }
                // guardado
                $data = array(
                    'id_persona' => $new_persona,
                    'fecha' => date("Y-m-d"),
                    'cantidad' => '1',
                );
                $id_operacion = $this->operacion_model->guardar($data, null);

                // registro en bitacora
                $accion = 'agregó';
                $entidad = 'operacion';
                $valor = $id_operacion;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                $this->detalle($id_operacion);

            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar($id_operacion=null)
    {
        if ($this->session->userdata('logueado')) {

            $previous_url = $this->session->userdata('previous_url');

            $operacion = $this->input->post();
            if ($operacion) {

                if ($id_operacion) {
                    $accion = 'modificó';
                } else {
                    $accion = 'agregó';
                }
                // guardado
                $data = array(
                    'id_forma_pago' => empty($operacion['id_forma_pago']) ? null : $operacion['id_forma_pago'],
                    'fecha' => empty($operacion['fecha']) ? null : $operacion['fecha'],
                    'cantidad' => empty($operacion['cantidad']) ? null : $operacion['cantidad'],
                    'nota' => $operacion['nota'],
                );
                $id_operacion = $this->operacion_model->guardar($data, $id_operacion);

                // registro en bitacora
                $entidad = 'operacion';
                $valor = $id_operacion . " " . $operacion['nom_operacion'];
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect($previous_url);

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar_producto($id_operacion=null)
    {
        if ($this->session->userdata('logueado')) {

            $operacion = $this->input->post();
            if ($operacion) {

                if ($operacion['id_producto']) {
                    $producto = $this->producto_model->get_producto($operacion['id_producto']);

                    $accion = 'modificó';
                    // guardado
                    $data = array(
                        'id_producto' => empty($operacion['id_producto']) ? null : $operacion['id_producto'],
                        'precio' => $producto['precio'],
                    );
                    $id_operacion = $this->operacion_model->guardar($data, $id_operacion);

                    // registro en bitacora
                    $entidad = 'operacion';
                    $valor = $id_operacion . " " . $operacion['nom_operacion'];
                    $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);
                }

            }
            redirect(base_url() . 'operacion/detalle/' . $id_operacion);

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar_persona($id_operacion=null)
    {
        if ($this->session->userdata('logueado')) {

            $operacion = $this->input->post();
            if ($operacion) {

                if ($operacion['id_persona']) {
                    $persona = $this->persona_model->get_persona($operacion['id_persona']);

                    $accion = 'modificó';
                    // guardado
                    $data = array(
                        'id_persona' => empty($operacion['id_persona']) ? null : $operacion['id_persona'],
                    );
                    $id_operacion = $this->operacion_model->guardar($data, $id_operacion);

                    // registro en bitacora
                    $entidad = 'operacion';
                    $valor = $id_operacion . " " . $operacion['nom_operacion'];
                    $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);
                }

            }
            redirect(base_url() . 'operacion/detalle/' . $id_operacion);

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function eliminar($id_operacion)
    {
        if ($this->session->userdata('logueado')) {

            // registro en bitacora
            $operacion = $this->operacion_model->get_operacion($id_operacion);
            $accion = 'eliminó';
            $entidad = 'operacion';
            $valor = $id_operacion . " " . $operacion['nom_operacion'];
            $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->operacion_model->eliminar($id_operacion);
            redirect(base_url() . 'operacion');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

}
