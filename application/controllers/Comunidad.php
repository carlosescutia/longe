<?php
class Comunidad extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->model('comunidad_model');
        $this->load->model('grupo_model');
        $this->load->model('persona_model');
    }

    public function index()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'comunidad.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['comunidades'] = $this->comunidad_model->get_comunidades($data['id_comunidad'], $data['id_rol']);

                $this->load->view('templates/admheader', $data);
                $this->load->view('templates/dlg_borrar');
                $this->load->view('catalogos/comunidad/lista', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function detalle($id_comunidad)
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'comunidad.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['comunidad'] = $this->comunidad_model->get_comunidad($id_comunidad);
                $data['grupos'] = $this->grupo_model->get_grupos_activos();
                $data['instructores'] = $this->persona_model->get_instructores($data['id_comunidad'], $data['id_rol']);

                $this->load->view('templates/admheader', $data);
                $this->load->view('catalogos/comunidad/detalle', $data);
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
                'comunidad.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                // guardado
                $data = array(
                    'id_grupo' => null,
                );
                $id_comunidad = $this->comunidad_model->guardar($data, null);

                // registro en bitacora
                $accion = 'agregó';
                $entidad = 'comunidad';
                $valor = $id_comunidad;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                $this->detalle($id_comunidad);

            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar($id_comunidad=null)
    {
        if ($this->session->userdata('logueado')) {

            $comunidad = $this->input->post();
            if ($comunidad) {

                if ($id_comunidad) {
                    $accion = 'modificó';
                } else {
                    $accion = 'agregó';
                }
                // guardado
                $data = array(
                    'id_grupo' => empty($comunidad['id_grupo']) ? null : $comunidad['id_grupo'],
                    'id_responsable' => empty($comunidad['id_responsable']) ? null : $comunidad['id_responsable'],
                    'nom_comunidad' => $comunidad['nom_comunidad'],
                    'direccion' => $comunidad['direccion'],
                    'telefono' => $comunidad['telefono'],
                    'ciudad' => $comunidad['ciudad'],
                    'activo' => empty($comunidad['activo']) ? null : $comunidad['activo'],
                    'mensaje' => $comunidad['mensaje'],
                );
                $id_comunidad = $this->comunidad_model->guardar($data, $id_comunidad);

                // registro en bitacora
                $entidad = 'comunidad';
                $valor = $id_comunidad . " " . $comunidad['nom_comunidad'];
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect(base_url() . 'comunidad');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function eliminar($id_comunidad)
    {
        if ($this->session->userdata('logueado')) {

            // registro en bitacora
            $comunidad = $this->comunidad_model->get_comunidad($id_comunidad);
            $accion = 'eliminó';
            $entidad = 'comunidad';
            $valor = $id_comunidad . " " . $comunidad['nom_comunidad'];
            $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->comunidad_model->eliminar($id_comunidad);
            redirect(base_url() . 'comunidad');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

}
