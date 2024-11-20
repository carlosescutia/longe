<?php
class Operacion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_operaciones($id_comunidad, $id_rol) {
        if ($id_rol == 'adm') {
            $id_comunidad = '%';
        }
        //$sql = 'select o.*, c.nom_comunidad from operacion o left join comunidad c on c.id_comunidad = o.id_comunidad where o.id_comunidad::text LIKE ? ';
        $sql = ""
            ."select "
            ."o.*, pe.nom_persona, pr.nom_producto "
            ."from "
            ."operacion o "
            ."left join persona pe on pe.id_persona = o.id_persona "
            ."left join producto pr on pr.id_producto = o.id_producto "
            ."where "
            ."pe.id_comunidad::text ilike ? "
            ."";
        if ($id_rol == 'adm') {
            $sql .= 'or pe.id_comunidad is null ';
        }
        $sql .= 'order by o.id_operacion desc ';
        $query = $this->db->query($sql, $id_comunidad);
        return $query->result_array();
    }

    public function get_operaciones_persona($id_persona) {
        $sql = ""
            ."select "
            ."o.*, pe.nom_persona, pr.nom_producto "
            ."from "
            ."operacion o "
            ."left join persona pe on pe.id_persona = o.id_persona "
            ."left join producto pr on pr.id_producto = o.id_producto "
            ."where "
            ."o.id_persona = ? "
            ."";
        $sql .= 'order by o.id_operacion desc ';
        $query = $this->db->query($sql, array($id_persona));
        return $query->result_array();
    }

    public function get_operacion($id_operacion) {
        $sql = 'select * from operacion where id_operacion = ?;';
        $query = $this->db->query($sql, array($id_operacion));
        return $query->row_array();
    }

    public function get_instructores($id_comunidad, $id_rol) {
        if ($id_rol == 'adm') {
            $id_comunidad = '%';
        }
        $sql = 'select o.*, c.nom_comunidad from operacion o left join comunidad c on c.id_comunidad = o.id_comunidad where o.activo = 1 and o.es_instructor = 1 and o.id_comunidad::text LIKE ? order by id_operacion;';
        $query = $this->db->query($sql, array($id_comunidad));
        return $query->result_array();
    }

    public function guardar($data, $id_operacion)
    {
        if ($id_operacion) {
            $this->db->where('id_operacion', $id_operacion);
            $this->db->update('operacion', $data);
            $id = $id_operacion;
        } else {
            $this->db->insert('operacion', $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    public function eliminar($id_operacion)
    {
        $this->db->where('id_operacion', $id_operacion);
        $result = $this->db->delete('operacion');
        return $result;
    }

}
