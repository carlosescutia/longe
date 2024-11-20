<?php
class Grado extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->model('grado_model');
    }

    public function index()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'grado.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['grados'] = $this->grado_model->get_grados();

                $this->load->view('templates/admheader', $data);
                $this->load->view('templates/dlg_borrar');
                $this->load->view('catalogos/grado/lista', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function detalle($id_grado)
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'grado.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['grado'] = $this->grado_model->get_grado($id_grado);

                $this->load->view('templates/admheader', $data);
                $this->load->view('catalogos/grado/detalle', $data);
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
                'grado.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                // guardado
                $data = array(
                    'nom_grado' => null,
                );
                $id_grado = $this->grado_model->guardar($data, null);

                // registro en bitacora
                $accion = 'agregó';
                $entidad = 'grado';
                $valor = $id_grado;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                $this->detalle($id_grado);

            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar($id_grado=null)
    {
        if ($this->session->userdata('logueado')) {

            $grado = $this->input->post();
            if ($grado) {

                if ($id_grado) {
                    $accion = 'modificó';
                } else {
                    $accion = 'agregó';
                }
                // guardado
                $data = array(
                    'nom_grado' => $grado['nom_grado'],
                    'orden' => $grado['orden'],
                );
                $id_grado = $this->grado_model->guardar($data, $id_grado);

                // registro en bitacora
                $entidad = 'grado';
                $valor = $id_grado . " " . $grado['nom_grado'];
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect(base_url() . 'grado');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function eliminar($id_grado)
    {
        if ($this->session->userdata('logueado')) {

            // registro en bitacora
            $grado = $this->grado_model->get_grado($id_grado);
            $accion = 'eliminó';
            $entidad = 'grado';
            $valor = $id_grado . " " . $grado['nom_grado'];
            $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->grado_model->eliminar($id_grado);
            redirect(base_url() . 'grado');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

}
