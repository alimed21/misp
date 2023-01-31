<?php

class Utilisateur_model extends CI_Model
{
	public function getListeUsers(){
		$this->db->select('id_user, username, nom_inst, u.date_ajout, login_admin');
		$this->db->from('utilisateur as u');
		$this->db->join('admin as a', 'a.id_admin = u.id_admin_ajout');
		$this->db->join('institution as inst', 'inst.id_inst = u.id_inst');
		$this->db->where('u.id_admin_delete is null');
		$this->db->where('u.date_delete is null');
		$this->db->where('inst.id_admin_delete is null');
		$this->db->where('inst.date_delete is null');

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

	public function addUser($data)
	{
		$this->db->insert('utilisateur', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}
