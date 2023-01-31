<?php

class Institution_model extends CI_Model
{
	public function getListeInst(){
		$this->db->select('id_inst, nom_inst, nom_court_inst, date_ajout, login_admin');
		$this->db->from('institution as ins');
		$this->db->join('admin as a', 'a.id_admin = ins.id_admin_ajout');
		$this->db->where('ins.id_admin_delete is null');
		$this->db->where('ins.date_delete is null');

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result();
		}
        else
		{
			return false;
		}
	}

	public function addInst($data)
	{
		$this->db->insert('institution', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	
}