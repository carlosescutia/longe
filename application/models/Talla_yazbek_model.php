<?php
class Talla_yazbek_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_tallas_yazbek() {
        $sql = 'select * from talla_yazbek order by orden ';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_talla_yazbek($id_talla_yazbek) {
        $sql = 'select * from talla_yazbek where id_talla_yazbek = ?;';
        $query = $this->db->query($sql, array($id_talla_yazbek));
        return $query->row_array();
    }

    public function guardar($data, $id_talla_yazbek)
    {
        if ($id_talla_yazbek) {
            $this->db->where('id_talla_yazbek', $id_talla_yazbek);
            $this->db->update('talla_yazbek', $data);
            $id = $id_talla_yazbek;
        } else {
            $this->db->insert('talla_yazbek', $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    public function eliminar($id_talla_yazbek)
    {
        $this->db->where('id_talla_yazbek', $id_talla_yazbek);
        $result = $this->db->delete('talla_yazbek');
        return $result;
    }

}
