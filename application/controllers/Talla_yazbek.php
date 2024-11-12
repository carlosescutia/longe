<?php
class Talla_yazbek extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->model('talla_yazbek_model');
    }

    public function index()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'talla_yazbek.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['tallas_yazbek'] = $this->talla_yazbek_model->get_tallas_yazbek();

                $this->load->view('templates/admheader', $data);
                $this->load->view('templates/dlg_borrar');
                $this->load->view('catalogos/talla_yazbek/lista', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function detalle($id_talla_yazbek)
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'talla_yazbek.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['talla_yazbek'] = $this->talla_yazbek_model->get_talla_yazbek($id_talla_yazbek);

                $this->load->view('templates/admheader', $data);
                $this->load->view('catalogos/talla_yazbek/detalle', $data);
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
                'talla_yazbek.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                // guardado
                $data = array(
                    'nom_talla_yazbek' => null,
                );
                $id_talla_yazbek = $this->talla_yazbek_model->guardar($data, null);

                // registro en bitacora
                $accion = 'agregó';
                $entidad = 'talla_yazbek';
                $valor = $id_talla_yazbek;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                $this->detalle($id_talla_yazbek);

            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar($id_talla_yazbek=null)
    {
        if ($this->session->userdata('logueado')) {

            $talla_yazbek = $this->input->post();
            if ($talla_yazbek) {

                if ($id_talla_yazbek) {
                    $accion = 'modificó';
                } else {
                    $accion = 'agregó';
                }
                // guardado
                $data = array(
                    'nom_talla_yazbek' => $talla_yazbek['nom_talla_yazbek'],
                    'orden' => $talla_yazbek['orden'],
                );
                $id_talla_yazbek = $this->talla_yazbek_model->guardar($data, $id_talla_yazbek);

                // registro en bitacora
                $entidad = 'talla_yazbek';
                $valor = $id_talla_yazbek . " " . $talla_yazbek['nom_talla_yazbek'];
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect(base_url() . 'talla_yazbek');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function eliminar($id_talla_yazbek)
    {
        if ($this->session->userdata('logueado')) {

            // registro en bitacora
            $talla_yazbek = $this->talla_yazbek_model->get_talla_yazbek($id_talla_yazbek);
            $accion = 'eliminó';
            $entidad = 'talla_yazbek';
            $valor = $id_talla_yazbek . " " . $talla_yazbek['nom_talla_yazbek'];
            $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->talla_yazbek_model->eliminar($id_talla_yazbek);
            redirect(base_url() . 'talla_yazbek');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

}
