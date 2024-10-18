<?php
class Persona extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->model('persona_model');
        $this->load->model('comunidad_model');
        $this->load->model('talla_yazbek_model');
    }

    public function index()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'persona.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['personas'] = $this->persona_model->get_personas($data['id_comunidad'], $data['id_rol']);

                $this->load->view('templates/admheader', $data);
                $this->load->view('templates/dlg_borrar');
                $this->load->view('catalogos/persona/lista', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function detalle($id_persona)
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'persona.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['persona'] = $this->persona_model->get_persona($id_persona);
                $data['comunidades'] = $this->comunidad_model->get_comunidades($data['id_comunidad'], $data['id_rol']);
                $data['instructores'] = $this->persona_model->get_instructores($data['id_comunidad'], $data['id_rol']);
                $data['tallas_yazbek'] = $this->talla_yazbek_model->get_tallas_yazbek();

                $this->load->view('templates/admheader', $data);
                $this->load->view('catalogos/persona/detalle', $data);
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
                'persona.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                // guardado
                $data = array(
                    'id_comunidad' => null,
                );
                $id_persona = $this->persona_model->guardar($data, null);

                // registro en bitacora
                $accion = 'agregó';
                $entidad = 'persona';
                $valor = $id_persona;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                $this->detalle($id_persona);

            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar($id_persona=null)
    {
        if ($this->session->userdata('logueado')) {

            $persona = $this->input->post();
            if ($persona) {

                if ($id_persona) {
                    $accion = 'modificó';
                } else {
                    $accion = 'agregó';
                }
                // guardado
                $data = array(
                    'id_comunidad' => empty($persona['id_comunidad']) ? null : $persona['id_comunidad'],
                    'id_instructor_inicial' => empty($persona['id_instructor_inicial']) ? null : $persona['id_instructor_inicial'],
                    'id_instructor_actual' => empty($persona['id_instructor_actual']) ? null : $persona['id_instructor_actual'],
                    'nom_persona' => $persona['nom_persona'],
                    'fecha_ingreso' => empty($persona['fecha_ingreso']) ? null : $persona['fecha_ingreso'],
                    'sexo' => $persona['sexo'],
                    'id_talla_yazbek' => empty($persona['id_talla_yazbek']) ? null : $persona['id_talla_yazbek'],
                    'es_instructor' => empty($persona['es_instructor']) ? null : $persona['es_instructor'],
                    'activo' => empty($persona['activo']) ? null : $persona['activo'],
                );
                $id_persona = $this->persona_model->guardar($data, $id_persona);

                // registro en bitacora
                $entidad = 'persona';
                $valor = $id_persona . " " . $persona['nom_persona'];
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect(base_url() . 'persona');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function eliminar($id_persona)
    {
        if ($this->session->userdata('logueado')) {

            // registro en bitacora
            $persona = $this->persona_model->get_persona($id_persona);
            $accion = 'eliminó';
            $entidad = 'persona';
            $valor = $id_persona . " " . $persona['nom_persona'];
            $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->persona_model->eliminar($id_persona);
            redirect(base_url() . 'persona');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

}
