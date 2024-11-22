<?php
class Producto extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->model('producto_model');
        $this->load->model('evento_model');
    }

    public function index()
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'producto.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['productos'] = $this->producto_model->get_productos($data['id_comunidad'], $data['id_rol']);

                $this->load->view('templates/admheader', $data);
                $this->load->view('templates/dlg_borrar');
                $this->load->view('catalogos/producto/lista', $data);
                $this->load->view('templates/footer', $data);
            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function detalle($id_producto)
    {
        if ($this->session->userdata('logueado')) {
            $data = [];
            $data += $this->funciones_sistema->get_userdata();
            $data += $this->funciones_sistema->get_system_params();

            $permisos_requeridos = array(
                'producto.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                $data['producto'] = $this->producto_model->get_producto($id_producto);
                $data['eventos'] = $this->evento_model->get_eventos_activos($data['id_comunidad'], $data['id_rol']);

                $this->load->view('templates/admheader', $data);
                $this->load->view('catalogos/producto/detalle', $data);
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
                'producto.can_edit',
            );
            if (has_permission_or($permisos_requeridos, $data['permisos_usuario'])) {
                // guardado
                $data = array(
                    'id_comunidad' => null,
                );
                $id_producto = $this->producto_model->guardar($data, null);

                // registro en bitacora
                $accion = 'agregó';
                $entidad = 'producto';
                $valor = $id_producto;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                $this->detalle($id_producto);

            } else {
                redirect(base_url() . 'admin');
            }
        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function guardar($id_producto=null)
    {
        if ($this->session->userdata('logueado')) {

            $producto = $this->input->post();
            if ($producto) {

                if ($id_producto) {
                    $accion = 'modificó';
                } else {
                    $accion = 'agregó';
                }
                // guardado
                $data = array(
                    'id_comunidad' => empty($producto['id_comunidad']) ? null : $producto['id_comunidad'],
                    'cod_producto' => $producto['cod_producto'],
                    'nom_producto' => $producto['nom_producto'],
                    'precio' => empty($producto['precio']) ? null : $producto['precio'],
                    'activo' => empty($producto['activo']) ? null : $producto['activo'],
                    'id_evento' => empty($producto['id_evento']) ? null : $producto['id_evento'],
                );
                $id_producto = $this->producto_model->guardar($data, $id_producto);

                // registro en bitacora
                $entidad = 'producto';
                $valor = $id_producto . " " . $producto['nom_producto'];
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect(base_url() . 'producto');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function eliminar($id_producto)
    {
        if ($this->session->userdata('logueado')) {

            // registro en bitacora
            $producto = $this->producto_model->get_producto($id_producto);
            $accion = 'eliminó';
            $entidad = 'producto';
            $valor = $id_producto . " " . $producto['nom_producto'];
            $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->producto_model->eliminar($id_producto);
            redirect(base_url() . 'producto');

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

}
