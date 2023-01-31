<?php

class Systeme_Information_model extends CI_Model
{
	public function getListeSI($id_inst){
		$this->db->select('id_si, nom_si, si.date_ajout, username');
		$this->db->from('systeme_info as si');
		$this->db->join('utilisateur as u', 'u.id_user = si.id_user_ajout');
		$this->db->where('si.id_inst', $id_inst);
		$this->db->where('si.id_user_delete is null');
		$this->db->where('si.date_delete is null');

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

	public function addSI($data)
	{
		$this->db->insert('systeme_info', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function getDetailSI($id){
		$this->db->select('id_si, nom_si');
		$this->db->from('systeme_info');
		$this->db->where('id_si', $id);
		$this->db->where('id_user_delete is null');
		$this->db->where('date_delete is null');

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

	public function updateSI($data, $id)
	{
		$this->db->where('id_si', $id );
		$this->db->update('systeme_info', $data);
		return true;
	}

	public function supprimerSI($data, $id)
	{
		$this->db->where('id_si', $id );
		$this->db->update('systeme_info', $data);
		return true;
	}

	public function servSecu($id){
		$this->db->select('id_serv as id');
		$this->db->from('serv_secu');
		$this->db->where('id_inst', $id);
		$this->db->where('id_admin_delete is null');
		$this->db->where('date_delete is null');

		$query = $this->db->get();
		return $query->row();
	}

	public function getListSI($id_inst){
		$this->db->select('si.id_si, nom_si, logo, as.id_service, s.nom_service');
		$this->db->from('auto_serv as as');
		$this->db->join('service as s', 's.id_service = as.id_service');
		$this->db->join('systeme_info as si', 'si.id_si = as.id_system');
		$this->db->join('institution as inst', 'inst.id_inst = si.id_inst');
		$this->db->where('si.id_inst', $id_inst);
		$this->db->where('as.id_user_delete is null');
		$this->db->where('as.date_delete is null');
		$this->db->where('s.id_user_delete is null');
		$this->db->where('s.date_delete is null');
		$this->db->where('si.id_user_delete is null');
		$this->db->where('si.date_delete is null');
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
}
