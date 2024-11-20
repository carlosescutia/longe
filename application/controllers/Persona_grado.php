<?php
class Persona_grado extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('funciones_sistema');
        $this->load->model('persona_grado_model');
    }

    public function guardar()
    {
        if ($this->session->userdata('logueado')) {

            $persona_grado = $this->input->post();
            if ($persona_grado and $persona_grado['id_grado'] and $persona_grado['fecha'])  {

                $grado_existente = $this->persona_grado_model->get_persona_grado($persona_grado['id_persona'], $persona_grado['id_grado']);

                if (! $grado_existente) {
                    $accion = 'agregó';
                    // guardado
                    $data = array(
                        'id_persona' => $persona_grado['id_persona'],
                        'id_grado' => $persona_grado['id_grado'],
                        'fecha' => $persona_grado['fecha'],
                        'nota' => $persona_grado['nota'],
                    );
                    $id_grado = $this->persona_grado_model->guardar($data);

                    // registro en bitacora
                    $entidad = 'grado';
                    $valor = $persona_grado['id_persona'] . " " . $persona_grado['id_grado'];
                    $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);
                }

            }
            redirect(base_url() . 'persona/detalle/' . $persona_grado['id_persona']);

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

    public function eliminar($id_persona, $id_grado)
    {
        if ($this->session->userdata('logueado')) {

            // registro en bitacora
            $accion = 'eliminó';
            $entidad = 'persona_grado';
            $valor = $id_persona . " " . $id_grado;
            $this->funciones_sistema->registro_bitacora($accion, $entidad, $valor);

            // eliminado
            $this->persona_grado_model->eliminar($id_persona, $id_grado);
            redirect(base_url() . 'persona/detalle/' . $id_persona);

        } else {
            redirect(base_url() . 'admin/login');
        }
    }

}
