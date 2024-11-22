<?php
class Evento extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->model('evento_model');
        $this->load->model('operacion_model');
    }

    public function index()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'evento.can_view',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['eventos'] = $this->evento_model->get_eventos($data['id_comunidad'], $data['id_rol']);

                $this->load->view('templates/admheader', $data);
                $this->load->view('templates/dlg_borrar');
                $this->load->view('admin/evento/lista', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function detalle($id_evento)
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'evento.can_view',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['evento'] = $this->evento_model->get_evento($id_evento);
                $data['operaciones'] = $this->operacion_model->get_operaciones_evento($id_evento);

                $this->session->set_userdata('previous_url', current_url());

                $this->load->view('templates/admheader', $data);
                $this->load->view('templates/dlg_borrar');
                $this->load->view('templates/dlg_borrar_archivo');
                $this->load->view('admin/evento/detalle', $data);
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
                'evento.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                // guardado
                $data = array(
                    'id_comunidad' => $data['id_comunidad'],
                );
                $id_evento = $this->evento_model->guardar($data, null);

                // registro en bitacora
                $accion = 'agregó';
                $entidad = 'evento';
                $valor = $id_evento;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                $this->detalle($id_evento);

            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar($id_evento=null)
    {
        if ($this->session->userdata('logueado')) {

            $evento = $this->input->post();
            if ($evento) {

                if ($id_evento) {
                    $accion = 'modificó';
                } else {
                    $accion = 'agregó';
                }
                // guardado
                $data = array(
                    'id_comunidad' => empty($evento['id_comunidad']) ? null : $evento['id_comunidad'],
                    'nom_evento' => $evento['nom_evento'],
                    'fecha_ini' => empty($evento['fecha_ini']) ? null : $evento['fecha_ini'],
                    'fecha_fin' => empty($evento['fecha_fin']) ? null : $evento['fecha_fin'],
                    'lugar' => $evento['lugar'],
                    'activo' => empty($evento['activo']) ? null : $evento['activo'],
                );
                $id_evento = $this->evento_model->guardar($data, $id_evento);

                // registro en bitacora
                $entidad = 'evento';
                $valor = $id_evento . " " . $evento['nom_evento'];
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect(base_url() . 'evento');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function eliminar($id_evento)
    {
        if ($this->session->userdata('logueado')) {

            // registro en bitacora
            $evento = $this->evento_model->get_evento($id_evento);
            $accion = 'eliminó';
            $entidad = 'evento';
            $valor = $id_evento . " " . $evento['nom_evento'];
            $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->evento_model->eliminar($id_evento);
            redirect(base_url() . 'evento');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

}
