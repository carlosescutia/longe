<?php
class Persona_grado_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_persona_grados($id_persona) {
        $sql = ""
            ."select "
            ."pg.*, p.nom_persona, g.nom_grado "
            ."from "
            ."persona_grado pg "
            ."left join persona p on p.id_persona = pg.id_persona "
            ."left join grado g on g.id_grado = pg.id_grado "
            ."where "
            ."pg.id_persona = ? "
            ."";
        $query = $this->db->query($sql, array($id_persona));
        return $query->result_array();
    }

    public function get_persona_grado($id_persona, $id_grado) {
        $sql = 'select * from persona_grado where id_persona = ? and id_grado = ?;';
        $query = $this->db->query($sql, array($id_persona, $id_grado));
        return $query->row_array();
    }

    public function guardar($data)
    {
        $this->db->insert('persona_grado', $data);
    }

    public function eliminar($id_persona, $id_grado)
    {
        $this->db->where('id_persona', $id_persona);
        $this->db->where('id_grado', $id_grado);
        $result = $this->db->delete('persona_grado');
        return $result;
    }

}
