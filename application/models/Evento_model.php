<?php
class Evento_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_eventos($id_comunidad, $id_rol) {
        if ($id_rol == 'adm') {
            $id_comunidad = '%';
        }
        $sql = ""
            ."select "
            ."e.*, c.nom_comunidad "
            ."from "
            ."evento e "
            ."left join comunidad c on c.id_comunidad = e.id_comunidad "
            ."where "
            ."e.id_comunidad::text LIKE ? "
            ."";

        if ($id_rol == 'adm') {
            $sql .= 'or e.id_comunidad is null ';
        }
        $sql .= 'order by e.activo, e.fecha_ini desc ';
        $query = $this->db->query($sql, $id_comunidad);
        return $query->result_array();
    }

    public function get_eventos_activos($id_comunidad, $id_rol) {
        if ($id_rol == 'adm') {
            $id_comunidad = '%';
        }
        $sql = ""
            ."select "
            ."e.*, c.nom_comunidad "
            ."from "
            ."evento e "
            ."left join comunidad c on c.id_comunidad = e.id_comunidad "
            ."where "
            ."e.id_comunidad::text LIKE ? "
            ."and e.activo = 1 "
            ."order by "
            ."e.fecha_ini desc "
            ."";

        if ($id_rol == 'adm') {
            $sql .= 'or e.id_comunidad is null ';
        }
        $query = $this->db->query($sql, $id_comunidad);
        return $query->result_array();
    }

    public function get_evento($id_evento) {
        $sql = 'select * from evento where id_evento = ?;';
        $query = $this->db->query($sql, array($id_evento));
        return $query->row_array();
    }

    public function guardar($data, $id_evento)
    {
        if ($id_evento) {
            $this->db->where('id_evento', $id_evento);
            $this->db->update('evento', $data);
            $id = $id_evento;
        } else {
            $this->db->insert('evento', $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    public function eliminar($id_evento)
    {
        $this->db->where('id_evento', $id_evento);
        $result = $this->db->delete('evento');
        return $result;
    }

}
