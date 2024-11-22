<?php
class Archivos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('funciones_sistema');

        $this->load->model('bitacora_model');

    }

    public function foto_persona()
    {
        if ($this->session->userdata('logueado')) {

            $datos = $this->input->post();
            $dir_docs = $datos['dir_docs'];
            $nombre_archivo = $datos['nombre_archivo'];
            $url_actual = $datos['url_actual'];

            //crear directorio destino si no existe
            if ( !is_dir($dir_docs) ) {
                mkdir($dir_docs);
            }

            $config = array();
            $config['upload_path'] = 'fotos';
            $config['allowed_types'] = 'jpg';
            $config['max_size'] = '10240';
            $config['overwrite'] = TRUE;
            $config['file_name'] = $nombre_archivo;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('subir_archivo') ) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
            } else {
                // registro en bitacora
                $accion = 'subió';
                $entidad = 'archivos';
                $valor = $nombre_archivo;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect($url_actual);
        } else {
            redirect('inicio/login');
        }
    }

    public function foto_comunidad()
    {
        if ($this->session->userdata('logueado')) {

            $datos = $this->input->post();
            $dir_docs = $datos['dir_docs'];
            $nombre_archivo = $datos['nombre_archivo'];
            $url_actual = $datos['url_actual'];

            //crear directorio destino si no existe
            if ( !is_dir($dir_docs) ) {
                mkdir($dir_docs);
            }

            $config = array();
            $config['upload_path'] = 'fotos';
            $config['allowed_types'] = 'jpg';
            $config['max_size'] = '10240';
            $config['overwrite'] = TRUE;
            $config['file_name'] = $nombre_archivo;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('subir_archivo') ) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
            } else {
                // registro en bitacora
                $accion = 'subió';
                $entidad = 'archivos';
                $valor = $nombre_archivo;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            }
            redirect($url_actual);
        } else {
            redirect('inicio/login');
        }
    }

    public function eliminar()
    {
        if ($this->session->userdata('logueado')) {

            $datos = $this->input->post();
            if ($datos) {
                $dir_docs = $datos['dir_docs'];
                $nombre_archivo = $datos['nombre_archivo'];
                $nombre_archivo_fs = './' . $dir_docs . $nombre_archivo ;
                $url_actual = $datos['url_actual'];

                // registro en bitacora
                $accion = 'eliminó';
                $entidad = 'archivos';
                $valor = $nombre_archivo;
                $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

                // Eliminar archivo
                $status = unlink($nombre_archivo_fs) ? 'Se eliminó el archivo '.$nombre_archivo_fs : 'Error al eliminar el archivo '.$nombre_archivo_fs;
                echo $status;
            }

            redirect($url_actual);
        } else {
            redirect('inicio/login');
        }
    }

}
