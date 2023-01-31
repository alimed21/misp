<?php


class Enregistrement_model extends CI_Model
{
	public function enregistrement($data)
	{
		$this->db->insert('population', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

    public function listeEnregistrementsAccueil(){
        $this->db->select("cin, nom1, nom2, nom3, nom1_mere, nom2_mere, sexe, datenaissance, lieunaissance, etat_civil, adresse, telephone, pays, region, ville_village");
		$this->db->from("population as p");
		$this->db->where("date_delete is null");
		$this->db->limit(3);
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

	public function listeEnregistrements(){
        $this->db->select("cin, nom1, nom2, nom3, nom1_mere, nom2_mere, sexe, datenaissance, lieunaissance, etat_civil, adresse, telephone, pays, region, ville_village");
		$this->db->from("population as p");
		$this->db->where("date_delete is null");
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

	public function detailPerson($cin){
		$this->db->select("cin, nom1, nom2, nom3, nom1_mere, nom2_mere, sexe, datenaissance, lieunaissance, etat_civil, adresse, telephone, pays, region, ville_village");
		$this->db->from("population as p");
		$this->db->where("cin", $cin);
		$this->db->where("date_delete is null");
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
	public function modificationEnregistrement($data, $cin){
		$this->db->where('cin', $cin);
		$this->db->update('population', $data);
		return true;
	}
	public function supprimerPersonne($data, $cin)
	{
		$this->db->where('cin', $cin);
		$this->db->update('population', $data);
		return true;
	}
	/** Début analyse */
	public function countAllPersonnes(){
		$this->db->select('COUNT(cin) as person');
		$this->db->from('population');
		$this->db->where('date_delete is null');
		$query = $this->db->get();
		return $query->row();
	}
	/** Fin analyse */

}
