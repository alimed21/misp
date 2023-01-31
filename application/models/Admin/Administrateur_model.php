<?php

class Administrateur_model extends CI_Model
{
	public function getListeAdmin(){
		$this->db->select('id_admin, login_admin, date_add');
		$this->db->from('admin as a');
		$this->db->where('a.id_admin_delete is null');
		$this->db->where('a.date_delete is null');

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
}