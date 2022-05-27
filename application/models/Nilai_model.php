<?php

class Nilai_model extends CI_Model
{
    public function getNilai($id = null)
    {
        if( $id === null ) {
            return $this->db->get('nilai')->result_array();
        }else {
            return $this->db->get_where('nilai', ['id_nilai' => $id])->result_array();
        }
        
    }

    public function deleteNilai($id)
    {
        $this->db->delete('nilai', ['id_nilai' => $id]);
        return $this->db->affected_rows();
    }

    public function createNilai($data) 
    {
        $this->db->insert('nilai', $data);
        return $this->db->affected_rows();
    }

    public function updateNilai($data, $id) 
    {
        $this->db->update('nilai', $data, ['id_nilai' => $id]);
        return $this->db->affected_rows();
    }
}