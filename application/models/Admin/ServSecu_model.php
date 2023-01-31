<?php

class ServSecu_model extends CI_Model
{
	public function getListeServ(){
		$this->db->select('id_serv, lien_serv, nom_serv, class_serv, code_serv, s.date_ajout, nom_court_inst, login_admin');
		$this->db->from('serv_secu as s');
		$this->db->join('admin as a', 'a.id_admin = s.id_admin_ajout');
		$this->db->join('institution as inst', 'inst.id_inst = s.id_inst');
		$this->db->where('s.id_admin_delete is null');
		$this->db->where('s.date_delete is null');
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

	 public function addServ($data)
	 {
		 $this->db->insert('serv_secu', $data);
		 return ($this->db->affected_rows() != 1) ? false : true;
	 }
}
