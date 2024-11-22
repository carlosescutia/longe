<?php
class Grupo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_grupos() {
        $sql = 'select *, nom_grupo from grupo order by activo, nom_grupo;';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_grupos_activos() {
        $sql = 'select *, nom_grupo from grupo where activo = 1 order by nom_grupo;';
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_grupo($id_grupo) {
        $sql = 'select *, nom_grupo from grupo where id_grupo = ?;';
        $query = $this->db->query($sql, array($id_grupo));
        return $query->row_array();
    }

    public function guardar($data, $id_grupo)
    {
        if ($id_grupo) {
            $this->db->where('id_grupo', $id_grupo);
            $this->db->update('grupo', $data);
            $id = $id_grupo;
        } else {
            $this->db->insert('grupo', $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    public function eliminar($id_grupo)
    {
        $this->db->where('id_grupo', $id_grupo);
        $result = $this->db->delete('grupo');
        return $result;
    }

}
