<?php

class Systeme_Information extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Systeme_Information_model');
		$this->load->library('form_validation');

		if($this->session->userdata('logged_in') != TRUE)
		{
			redirect('Connexion');
		}
	}

	function getDatetimeNow()
	{
		$tz_object = new DateTimeZone('Africa/Djibouti');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		return $datetime->format('Y-m-d');
	}

	/** Liste des Systèmes d'information d'une institution */
	public function index(){
		/** Get institution*/
		$id_inst = $this->session->userdata('id_inst');
		/** Liste des Systèmes d'information d'une institution */
		$listeSI = $this->Systeme_Information_model->getListeSI($id_inst);
		$data['listeSI'] = $listeSI;

		/** Titre */
		$titreAffiche = 'Liste des systèmes d\'informations';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/listeSystemeInfo_view", $data);
		$this->load->view("users/templates/footer");
	}

	/** Ajouter un système d'information */
	public function ajoutSI(){
		$id_inst = $this->session->userdata('id_inst');
		$serv = $this->Systeme_Information_model->servSecu($id_inst);
		$data['serv'] = $serv;

		$titreAffiche = 'Ajouter un système d\'information';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/ajouterSystemeInfo_view", $data);
		$this->load->view("users/templates/footer");
	}

	public function verificationAjout()
	{
		$this->form_validation->set_rules('nom_si', "système d'information", 'trim|required|is_unique[systeme_info.nom_si]');

		if($this->form_validation->run()==true){
			//True
			$nom_si = $this->input->post('nom_si');
			$id_serv = $this->input->post('id_serv');
			$id_inst = $this->session->userdata('id_inst');
			$id_user = $this->session->userdata('id_user');
			$date_add = $this->getDatetimeNow();



			$data = array(
				'nom_si'          => $nom_si,
				'id_serv'         => $id_serv,
				'id_inst'         => $id_inst,
				'date_ajout '     => $date_add,
				'id_user_ajout'   => $id_user

			);

			$addSI = $this->Systeme_Information_model->addSI($data);

			if ($addSI = true)
			{
				$this->session->set_flashdata('sucess', 'Ajout système d\'information réussi');
				redirect('Systeme_Information/');
			}
			else{
				$this->session->set_flashdata('error', 'Veuillez réessayer.');
				redirect('Systeme_Information/ajoutSI');
			}

		}
		else{
			//False
			$this->ajoutSI();
		}

	}

	/**
	 * Supprimer d'un système d'information
	 */

	public function supprimerSystemeInfo($id){

		$id_user_delete = $this->session->userdata('id_user');
		$date_delete = $this->getDatetimeNow();

		$data = array(
			'date_delete' 		=> $date_delete,
			'id_user_delete' 	=> $id_user_delete
		);

		$supprimerSI = $this->Systeme_Information_model->supprimerSI($data, $id);

		if ($supprimerSI = true)
		{
			$this->session->set_flashdata('success', "Suppression d'un système d'information réussi");
			redirect('Systeme_Information');
		}
		else{
			$this->session->set_flashdata('error', 'Veuillez réessayer.');
			redirect('Systeme_Information');
		}
	}

	/** Modifier un système d'information */
	public function modifierSI($id){
		/** Liste des Systèmes d'information d'une institution */
		$detailSI = $this->Systeme_Information_model->getDetailSI($id);
		$data['detailSI'] = $detailSI;

		$titreAffiche = 'Modifier un système d\'information';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/modifierSystemeInfo_view", $data);
		$this->load->view("users/templates/footer");
	}

	public function verificationModification()
	{
		$this->form_validation->set_rules('nom_si', "système d'information", 'trim|required|is_unique[systeme_info.nom_si]&');

		$id_si = $this->input->post('id_si');

		if($this->form_validation->run()==true){
			//True


			$nom_si = $this->input->post('nom_si');

			$data = array(
				'nom_si'          => $nom_si

			);

			$updateSI = $this->Systeme_Information_model->updateSI($data, $id_si);

			if ($updateSI = true)
			{
				$this->session->set_flashdata('success', 'Modification système d\'information réussi');
				redirect('Systeme_Information');
			}
			else{
				$this->session->set_flashdata('error', 'Veuillez réessayer.');
				redirect('Systeme_Information');
			}

		}
		else{
			//False
			$this->modifierSI($id_si);
		}

	}

}
