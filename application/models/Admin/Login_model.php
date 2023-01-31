<?php
/**
 *
 */
class Login_model extends CI_Model
{
	public function can_login($username, $password)
	{
		$this->db->select('id_admin, login_admin, pass_admin');
		$this->db->from('admin as ad');
		$this->db->where('login_admin', $username);
		$this->db->where('ad.id_admin_delete is null');
		$this->db->where('ad.date_delete is null');
		$this->db->limit(1);

		$query = $this->db->get();

		$row = $query->row();
		if($row != Null){
			if (password_verify($password,$row->pass_admin)) {
				return $query->result();
			} else {
				return false;
			}
		}
        else{
			return false;
		}
	}

    public function log_manager($data)
	{
		$this->db->insert('historique', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}


?>
