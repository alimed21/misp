<?php

class Parametres_model extends CI_Model
{
	public function getInstitutionName($idInst, $id_user){
		$this->db->select('nom_inst, logo, u.username');
		$this->db->from('institution as inst');
        $this->db->join('utilisateur as u', 'u.id_inst = inst.id_inst');
		$this->db->where('inst.id_inst', $idInst);
        $this->db->where('u.id_user', $id_user);
		$this->db->where('inst.date_delete is null');
		$this->db->where('inst.id_admin_delete is null');
        $this->db->where('u.date_delete is null');
		$this->db->where('u.id_admin_delete is null');
        $this->db->limit(1);

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
