<?php
class Persona_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_personas($id_comunidad, $id_rol) {
        if ($id_rol == 'adm') {
            $id_comunidad = '%';
        }
        $sql = 'select p.*, c.nom_comunidad from persona p left join comunidad c on c.id_comunidad = p.id_comunidad where p.id_comunidad::text LIKE ? ';
        if ($id_rol == 'adm') {
            $sql .= 'or p.id_comunidad is null ';
        }
        $sql .= 'order by p.fecha_ingreso desc ';
        $query = $this->db->query($sql, $id_comunidad);
        return $query->result_array();
    }

    public function get_persona($id_persona) {
        $sql = 'select *, nom_persona from persona where id_persona = ?;';
        $query = $this->db->query($sql, array($id_persona));
        return $query->row_array();
    }

    public function get_instructores($id_comunidad, $id_rol) {
        if ($id_rol == 'adm') {
            $id_comunidad = '%';
        }
        $sql = 'select p.*, c.nom_comunidad from persona p left join comunidad c on c.id_comunidad = p.id_comunidad where p.activo = 1 and p.es_instructor = 1 and p.id_comunidad::text LIKE ? order by id_persona;';
        $query = $this->db->query($sql, array($id_comunidad));
        return $query->result_array();
    }

    public function guardar($data, $id_persona)
    {
        if ($id_persona) {
            $this->db->where('id_persona', $id_persona);
            $this->db->update('persona', $data);
            $id = $id_persona;
        } else {
            $this->db->insert('persona', $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    public function eliminar($id_persona)
    {
        $this->db->where('id_persona', $id_persona);
        $result = $this->db->delete('persona');
        return $result;
    }

}
