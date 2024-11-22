<?php
class Forma_pago_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_formas_pago() {
        $sql = 'select fp.* from forma_pago fp order by activo, orden ';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_formas_pago_activas() {
        $sql = 'select fp.* from forma_pago fp where activo = 1 order by orden ';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_forma_pago($id_forma_pago) {
        $sql = 'select *, nom_forma_pago from forma_pago where id_forma_pago = ?;';
        $query = $this->db->query($sql, array($id_forma_pago));
        return $query->row_array();
    }

    public function guardar($data, $id_forma_pago)
    {
        if ($id_forma_pago) {
            $this->db->where('id_forma_pago', $id_forma_pago);
            $this->db->update('forma_pago', $data);
            $id = $id_forma_pago;
        } else {
            $this->db->insert('forma_pago', $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    public function eliminar($id_forma_pago)
    {
        $this->db->where('id_forma_pago', $id_forma_pago);
        $result = $this->db->delete('forma_pago');
        return $result;
    }

}
