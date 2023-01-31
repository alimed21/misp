<?php

class Consommation_model extends CI_Model
{
	public function listeService($id_service, $id_si){
		$this->db->select('s.id_service, as.id_system, nom_service, inst.logo');
		$this->db->from('auto_serv as as');
		$this->db->join('service as s', 's.id_service = as.id_service');
		$this->db->join('systeme_info as si', 'si.id_si = s.id_si');
		$this->db->join('institution as inst', 'inst.id_inst = si.id_inst');
		$this->db->where('as.id_service', $id_service);
		$this->db->where('as.id_system', $id_si);
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

	public function getPermission($idserv, $id_system, $id_inst){
		$this->db->select('as.id_service, as.id_system, s.nom_service');
		$this->db->from('auto_serv as as');
		$this->db->join('service as s', 's.id_service = as.id_service');
		$this->db->join('systeme_info as si', 'si.id_si = as.id_system');
		$this->db->join('institution as inst', 'inst.id_inst = si.id_inst');
		$this->db->where('as.id_service', $idserv);
		$this->db->where('as.id_system', $id_system);
		$this->db->where('inst.id_inst', $id_inst);
		$this->db->where('as.date_delete is null');
		$this->db->where('as.id_user_delete is null');
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

	public function getInfoServ($id_sys, $id_inst){
		$this->db->select('secu.lien_serv, secu.nom_serv, secu.class_serv, secu.code_serv');
		$this->db->from('systeme_info as si');
		$this->db->join('serv_secu as secu', 'secu.id_serv = si.id_serv');
		$this->db->join('institution as inst', 'inst.id_inst = si.id_inst');
		$this->db->where('si.id_si', $id_sys);
		$this->db->where('si.id_inst', $id_inst);
		$this->db->where('si.date_delete is null');
		$this->db->where('si.id_user_delete is null');
		$this->db->where('secu.date_delete is null');
		$this->db->where('secu.id_admin_delete is null');
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

	public function getSysInfo($id_sys){
		$this->db->select('si.nom_si');
		$this->db->from('systeme_info as si');
		$this->db->where('si.id_si', $id_sys);
		$this->db->where('si.date_delete is null');
		$this->db->where('si.id_user_delete is null');

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function getInfoServFour($id_serv){
		$this->db->select('secu.lien_serv, secu.nom_serv, secu.class_serv, secu.code_serv, si.nom_si');
		$this->db->from('service as s');
		$this->db->join('systeme_info as si', 'si.id_si = s.id_si');
		$this->db->join('serv_secu as secu', 'secu.id_serv = si.id_serv');
		$this->db->where('s.id_service', $id_serv);
		$this->db->where('s.date_delete is null');
		$this->db->where('s.id_user_delete is null');
		$this->db->where('si.date_delete is null');
		$this->db->where('si.id_user_delete is null');
		$this->db->where('secu.date_delete is null');
		$this->db->where('secu.id_admin_delete is null');

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

	public function getInfoServiceFour($idserv){
		$this->db->select('nom_service');
		$this->db->from('service');
		$this->db->where('id_service', $idserv);
		$this->db->where('date_delete is null');
		$this->db->where('id_user_delete is null');

		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}
}
