<?php
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->model('usuario_model');
        $this->load->model('persona_model');
        $this->load->model('operacion_model');
        $this->load->model('comunidad_model');
        $this->load->model('evento_model');
    }

    public function index()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $data['personas'] = $this->persona_model->get_personas_activas($data['id_comunidad'], $data['id_rol']);
            $data['operaciones'] = $this->operacion_model->get_operaciones($data['id_comunidad'], $data['id_rol']);
            $data['comunidad'] = $this->comunidad_model->get_comunidad($data['id_comunidad']);
            $data['eventos'] = $this->evento_model->get_eventos($data['id_comunidad'], $data['id_rol']);

            $this->load->view('templates/admheader', $data);
            $this->load->view('admin/inicio', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->login();
        }
    }

    public function login() {
        $data = array();
        $data['error'] = $this->session->flashdata('error');
        $data += $this->funciones_sistema->get_system_params();

        $this->load->view('admin/login', $data);
    }

    public function cerrar_sesion() {
        $usuario_data = array(
            'logueado' => FALSE
        );

        $accion = 'logout';
        $entidad = '';
        $valor = '';
        $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

        $this->session->set_userdata($usuario_data);
        redirect(base_url() . 'admin');
    }

    public function post_login() {
        if ($this->input->post()) {
            $usuario = $this->input->post('usuario');
            $password = $this->input->post('password');
            $usuario_db = $this->usuario_model->usuario_por_nombre($usuario, $password);
            if ($usuario_db) {
                $usuario_data = array(
                    'id_usuario' => $usuario_db['id_usuario'],
                    'id_comunidad' => $usuario_db['id_comunidad'],
                    'nom_comunidad' => $usuario_db['nom_comunidad'],
                    'id_rol' => $usuario_db['id_rol'],
                    'nom_usuario' => $usuario_db['nom_usuario'],
                    'usuario' => $usuario_db['usuario'],
                    'logueado' => TRUE
                );
                $this->session->set_userdata($usuario_data);

                $accion = 'login';
                $entidad = '';
                $valor = '';
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                redirect(base_url() . 'admin');
            } else {
                $this->session->set_flashdata('error', 'Usuario o contraseña incorrectos');
                redirect(base_url() . 'admin/login');
            }
        } else {
            $this->login();
        }
    }
}
