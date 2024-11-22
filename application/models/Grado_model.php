<?php
class Grado_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_grados() {
        $sql = 'select * from grado order by activo, orden ';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_grados_activos() {
        $sql = 'select * from grado where activo = 1 order by orden ';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_grados_persona($id_persona) {
        $sql = 'select g.* from persona_grado pg left join grado g on g.id_grado = pg.id_grado where id_persona = ?';
        $query = $this->db->query($sql, array($id_persona));
        return $query->result_array();
    }

    public function get_grado($id_grado) {
        $sql = 'select * from grado where id_grado = ?;';
        $query = $this->db->query($sql, array($id_grado));
        return $query->row_array();
    }

    public function guardar($data, $id_grado)
    {
        if ($id_grado) {
            $this->db->where('id_grado', $id_grado);
            $this->db->update('grado', $data);
            $id = $id_grado;
        } else {
            $this->db->insert('grado', $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    public function eliminar($id_grado)
    {
        $this->db->where('id_grado', $id_grado);
        $result = $this->db->delete('grado');
        return $result;
    }

}
