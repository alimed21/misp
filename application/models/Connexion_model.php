<?php
class Connexion_model extends CI_Model
{
	public function can_login($username, $password)
	{
		$this->db->select('id_user, username, password, id_inst');
		$this->db->from('utilisateur as u');
		$this->db->where('username', $username);
		$this->db->where('u.id_admin_delete is null');
		$this->db->where('u.date_delete is null');
		$this->db->limit(1);

		$query = $this->db->get();

		$row = $query->row();
		if($row != Null){
			if (password_verify($password,$row->password)) {
				return $query->result();
			} else {
				return false;
			}
		}
		else{
			return false;
		}
	}
}
