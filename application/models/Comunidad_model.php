<?php
class Comunidad_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_comunidades($id_comunidad, $id_rol) {
        if ($id_rol == 'adm') {
            $id_comunidad = '%';
        }
        $sql = ""
            ."select "
            ."c.*, g.nom_grupo, p.nom_persona as nom_responsable "
            ."from comunidad c "
            ."left join grupo g on g.id_grupo = c.id_grupo "
            ."left join persona p on p.id_persona = c.id_responsable "
            ."where "
            ."c.id_comunidad::text LIKE ? "
            ."order by "
            ."c.activo, c.nom_comunidad"
            ."";
        $query = $this->db->query($sql, $id_comunidad);
        return $query->result_array();
    }

    public function get_comunidades_activas($id_comunidad, $id_rol) {
        if ($id_rol == 'adm') {
            $id_comunidad = '%';
        }
        $sql = ""
            ."select "
            ."c.*, g.nom_grupo, p.nom_persona as nom_responsable "
            ."from comunidad c "
            ."left join grupo g on g.id_grupo = c.id_grupo "
            ."left join persona p on p.id_persona = c.id_responsable "
            ."where "
            ."c.id_comunidad::text LIKE ? "
            ."and c.activo = 1 "
            ."order by "
            ."c.nom_comunidad"
            ."";
        $query = $this->db->query($sql, $id_comunidad);
        return $query->result_array();
    }

    public function get_comunidad($id_comunidad) {
        $sql = 'select * from comunidad where id_comunidad = ?;';
        $query = $this->db->query($sql, array($id_comunidad));
        return $query->row_array();
    }

    public function guardar($data, $id_comunidad)
    {
        if ($id_comunidad) {
            $this->db->where('id_comunidad', $id_comunidad);
            $this->db->update('comunidad', $data);
            $id = $id_comunidad;
        } else {
            $this->db->insert('comunidad', $data);
            $id = $this->db->insert_id();
        }
        return $id;
    }

    public function eliminar($id_comunidad)
    {
        $this->db->where('id_comunidad', $id_comunidad);
        $result = $this->db->delete('comunidad');
        return $result;
    }

}
