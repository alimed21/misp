<?php

class WebService_model extends CI_Model
{
	public function getListeWS($id_inst){
		$this->db->select('s.id_service, nom_service, s.date_ajout, username');
		$this->db->from('service as s');
		$this->db->join('utilisateur as u', 'u.id_user = s.id_user_ajout');
		$this->db->join('systeme_info as si', 'si.id_si = s.id_si');
		$this->db->join('institution as inst', 'inst.id_inst = si.id_inst');
		$this->db->where('si.id_inst', $id_inst);
		$this->db->where('s.id_user_delete is null');
		$this->db->where('s.date_delete is null');
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

	public function addWS($data)
	{
		$this->db->insert('service', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function supprimerWS($data, $id)
	{
		$this->db->where('id_service', $id );
		$this->db->update('service', $data);
		return true;
	}

	public function updateWS($data, $id){
		$this->db->where('id_service', $id );
		$this->db->update('service', $data);
		return true;
	}
	public function detailWS($id){
		$this->db->select('id_service, nom_service');
		$this->db->from('service as s');
		$this->db->where('s.id_service', $id);
		$this->db->where('s.id_user_delete is null');
		$this->db->where('s.date_delete is null');

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

	public function listeSI($id_inst){
		$this->db->select('id_service, nom_service');
		$this->db->from('service as s');
		$this->db->join('systeme_info as si', 'si.id_si = s.id_si');
		$this->db->join('institution as inst', 'inst.id_inst = si.id_inst');
		$this->db->where('inst.id_inst', $id_inst);
		$this->db->where('s.date_delete is null');
		$this->db->where('s.id_user_delete is null');
		$this->db->where('si.date_delete is null');
		$this->db->where('si.id_user_delete is null');
		$this->db->where('inst.date_delete is null');
		$this->db->where('inst.id_admin_delete is null');

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
	public function listeSystemInfo($id_inst){
		$this->db->select('si.id_si, si.nom_si, nom_court_inst');
		$this->db->from('systeme_info as si');
		$this->db->join('institution as inst', 'inst.id_inst = si.id_inst');
		$this->db->where('inst.id_inst !=', $id_inst);
		$this->db->where('inst.id_admin_delete is null');
		$this->db->where('inst.date_delete is null');
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

	public function ListeSIWeb($id_serv){
		$this->db->select('si.id_si, si.nom_si, as.id_service, as.id_auto, as.date_ajout, username');
		$this->db->from('auto_serv as as');
		$this->db->join('service as s', 's.id_service = as.id_service');
		$this->db->join('systeme_info as si', 'si.id_si = as.id_system');
		$this->db->join('utilisateur as u', 'u.id_user = as.id_user_add');
		$this->db->where('as.id_service', $id_serv);
		$this->db->where('as.date_delete is null');
		$this->db->where('as.id_user_delete is null');
		$this->db->where('s.date_delete is null');
		$this->db->where('s.id_user_delete is null');
		$this->db->where('si.date_delete is null');
		$this->db->where('si.id_user_delete is null');

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

	public function supprimerAutoWS($data, $id){
		$this->db->where('id_auto', $id );
		$this->db->update('auto_serv', $data);
		return true;
	}
}
