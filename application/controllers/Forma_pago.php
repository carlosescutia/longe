<?php
class Forma_pago extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->model('forma_pago_model');
    }

    public function index()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'forma_pago.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['formas_pago'] = $this->forma_pago_model->get_formas_pago();

                $this->load->view('templates/admheader', $data);
                $this->load->view('templates/dlg_borrar');
                $this->load->view('catalogos/forma_pago/lista', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function detalle($id_forma_pago)
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'forma_pago.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['forma_pago'] = $this->forma_pago_model->get_forma_pago($id_forma_pago);

                $this->load->view('templates/admheader', $data);
                $this->load->view('catalogos/forma_pago/detalle', $data);
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
                'forma_pago.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                // guardado
                $data = array(
                    'nom_forma_pago' => '',
                );
                $id_forma_pago = $this->forma_pago_model->guardar($data, null);

                // registro en bitacora
                $accion = 'agregó';
                $entidad = 'forma_pago';
                $valor = $id_forma_pago;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                $this->detalle($id_forma_pago);

            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar($id_forma_pago=null)
    {
        if ($this->session->userdata('logueado')) {

            $forma_pago = $this->input->post();
            if ($forma_pago) {

                if ($id_forma_pago) {
                    $accion = 'modificó';
                } else {
                    $accion = 'agregó';
                }
                // guardado
                $data = array(
                    'nom_forma_pago' => $forma_pago['nom_forma_pago'],
                    'orden' => $forma_pago['orden'],
                    'activo' => empty($forma_pago['activo']) ? null : $forma_pago['activo'],
                );
                $id_forma_pago = $this->forma_pago_model->guardar($data, $id_forma_pago);

                // registro en bitacora
                $entidad = 'forma_pago';
                $valor = $id_forma_pago . " " . $forma_pago['nom_forma_pago'];
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect(base_url() . 'forma_pago');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function eliminar($id_forma_pago)
    {
        if ($this->session->userdata('logueado')) {

            // registro en bitacora
            $forma_pago = $this->forma_pago_model->get_forma_pago($id_forma_pago);
            $accion = 'eliminó';
            $entidad = 'forma_pago';
            $valor = $id_forma_pago . " " . $forma_pago['nom_forma_pago'];
            $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->forma_pago_model->eliminar($id_forma_pago);
            redirect(base_url() . 'forma_pago');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

}
