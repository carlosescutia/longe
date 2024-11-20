<?php
class Producto_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_productos($id_comunidad, $id_rol) {
        if ($id_rol == 'adm') {
            $id_comunidad = '%';
        }
        $sql = 'select p.*, c.nom_comunidad from producto p left join comunidad c on c.id_comunidad = p.id_comunidad where p.id_comunidad::text LIKE ? ';
        if ($id_rol == 'adm') {
            $sql .= 'or p.id_comunidad is null ';
        }
        $query = $this->db->query($sql, $id_comunidad);
        return $query->result_array();
    }

    public function get_producto($id_producto) {
        $sql = 'select *, nom_producto from producto where id_producto = ?;';
        $query = $this->db->query($sql, array($id_producto));
        return $query->row_array();
    }

    public function get_instructores($id_comunidad, $id_rol) {
        if ($id_rol == 'adm') {
            $id_comunidad = '%';
        }
        $sql = 'select p.*, c.nom_comunidad from producto p left join comunidad c on c.id_comunidad = p.id_comunidad where p.activo = 1 and p.es_instructor = 1 and p.id_comunidad::text LIKE ? order by id_producto;';
        $query = $this->db->query($sql, array($id_comunidad));
        return $query->result_array();
    }

    public function guardar($data, $id_producto)
    {
        if ($id_producto) {
            $this->db->where('id_producto', $id_producto);
            $this->db->update('producto', $data);
            $id = $id_producto;
        } else {
            $this->db->insert('producto', $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    public function eliminar($id_producto)
    {
        $this->db->where('id_producto', $id_producto);
        $result = $this->db->delete('producto');
        return $result;
    }

}
