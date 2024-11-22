<?php
class Grupo extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->model('grupo_model');
    }

    public function index()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'grupo.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['grupos'] = $this->grupo_model->get_grupos();

                $this->load->view('templates/admheader', $data);
                $this->load->view('templates/dlg_borrar');
                $this->load->view('catalogos/grupo/lista', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function detalle($id_grupo)
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'grupo.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['grupo'] = $this->grupo_model->get_grupo($id_grupo);

                $this->load->view('templates/admheader', $data);
                $this->load->view('catalogos/grupo/detalle', $data);
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
                'grupo.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                // guardado
                $data = array(
                    'nom_grupo' => null,
                );
                $id_grupo = $this->grupo_model->guardar($data, null);

                // registro en bitacora
                $accion = 'agregó';
                $entidad = 'grupo';
                $valor = $id_grupo;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                $this->detalle($id_grupo);

            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar($id_grupo=null)
    {
        if ($this->session->userdata('logueado')) {

            $grupo = $this->input->post();
            if ($grupo) {

                if ($id_grupo) {
                    $accion = 'modificó';
                } else {
                    $accion = 'agregó';
                }
                // guardado
                $data = array(
                    'nom_grupo' => $grupo['nom_grupo'],
                    'activo' => empty($grupo['activo']) ? null : $grupo['activo'],
                );
                $id_grupo = $this->grupo_model->guardar($data, $id_grupo);

                // registro en bitacora
                $entidad = 'grupo';
                $valor = $id_grupo . " " . $grupo['nom_grupo'];
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect(base_url() . 'grupo');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function eliminar($id_grupo)
    {
        if ($this->session->userdata('logueado')) {

            // registro en bitacora
            $grupo = $this->grupo_model->get_grupo($id_grupo);
            $accion = 'eliminó';
            $entidad = 'grupo';
            $valor = $id_grupo . " " . $grupo['nom_grupo'];
            $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->grupo_model->eliminar($id_grupo);
            redirect(base_url() . 'grupo');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

}
