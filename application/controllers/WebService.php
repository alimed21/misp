<?php

class WebService extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('WebService_model');
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

	public function index(){
		/** Get institution*/
		$id_inst = $this->session->userdata('id_inst');
		/** Liste des services web */
		$listeWebService= $this->WebService_model->getListeWS($id_inst);
		$data['listeWebService'] = $listeWebService;

		/** Titre */
		$titreAffiche = 'Liste des web services';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/listeSWebService_view", $data);
		$this->load->view("users/templates/footer");
	}

	/** Ajouter un service web */

	public function ajoutWebService($id){
		/** Get institution*/
		$id_inst = $this->session->userdata('id_inst');
		/** Liste des Systèmes d'information d'une institution */
		$listeSI = $this->Systeme_Information_model->getListeSI($id);
		$data['listeSI'] = $listeSI;
		/** Id système d'information */
		$id_sys = $id;
		$data['id_sys'] = $id_sys;
		$titreAffiche = 'Ajouter un service web';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/ajouterWebService_view", $data);
		$this->load->view("users/templates/footer");
	}
	public function verificationAjout()
	{
		$this->form_validation->set_rules('web_service', "web service", 'trim|required|is_unique[service.nom_service]');
		$id_sys = $this->input->post('id_sys');

		if($this->form_validation->run()==true){
			//True
			$web_service = $this->input->post('web_service');
			$id_user = $this->session->userdata('id_user');
			$date_add = $this->getDatetimeNow();

			$data = array(
				'nom_service'        => $web_service,
				'id_si'             => $id_sys,
				'date_ajout '        => $date_add,
				'id_user_ajout'      => $id_user

			);

			$addWS = $this->WebService_model->addWS($data);

			if ($addWS = true)
			{
				$this->session->set_flashdata('sucess', 'Ajout service web réussi');
				redirect('WebService');
			}
			else{
				$this->session->set_flashdata('error', 'Veuillez réessayer.');
				redirect('WebService/ajoutWebService/'.$id_sys);
			}

		}
		else{
			//False
			$this->ajoutWebService($id_sys);
		}
	}

	/**
	 * Supprimer d'un web service
	 */

	public function supprimerWebService($id){

		$id_user_delete = $this->session->userdata('id_user');
		$date_delete = $this->getDatetimeNow();

		$data = array(
			'date_delete' 		=> $date_delete,
			'id_user_delete' 	=> $id_user_delete
		);

		$supprimerWS = $this->WebService_model->supprimerWS($data, $id);

		if ($supprimerWS = true)
		{
			$this->session->set_flashdata('success', "Suppression d'un web service réussi");
			redirect('WebService');
		}
		else{
			$this->session->set_flashdata('error', 'Veuillez réessayer.');
			redirect('WebService');
		}
	}


	/** Modifier un web service */
	public function modifierWebService($id){
		/** Liste des Systèmes d'information d'une institution
		$id_inst = $this->session->userdata('id_inst');
		$listeSI = $this->Systeme_Information_model->getListSI($id_inst);
		$data['$listeSI'] = $listeSI; **/

		/** Détail du service web */
		$detailWS = $this->WebService_model->detailWS($id);
		$data['detailWS'] = $detailWS;

		$titreAffiche = 'Modifier un web service';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/modifierWebService_view", $data);
		$this->load->view("users/templates/footer");
	}

	public function verificationmodification(){
		$this->form_validation->set_rules('web_service', "web service", 'trim|required|is_unique[service.nom_service]');
		$id_service = $this->input->post('id_service');

		if($this->form_validation->run()==true){
			//True
			$web_service = $this->input->post('web_service');

			$data = array(
				'nom_service'        => $web_service

			);

			$updateWS = $this->WebService_model->updateWS($data, $id_service);

			if ($updateWS = true)
			{
				$this->session->set_flashdata('sucess', 'Modification service web réussi');
				redirect('WebService');
			}
			else{
				$this->session->set_flashdata('error', 'Veuillez réessayer.');
				redirect('WebService/modifierWebService/'.$id_service);
			}
		}
		else{
			//False
			$this->modifierWebService($id_service);
		}
	}

	/** Autorisation d'un service */
	public function autorisationWebService($id){
		/** Institution */
		$id_inst = $this->session->userdata('id_inst');
		/** Liste des SI */
			$listeSI = $this->WebService_model->listeSystemInfo($id_inst);
		$data['listeSI'] = $listeSI;

		/** Id du service */
		$id_service = $id;
		$data['id_service'] = $id_service;

		$titreAffiche = 'Autorisation d\'un web service';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/autorisationWebService_view", $data);
		$this->load->view("users/templates/footer");
	}

	public function verificationAutorisation(){
		$si = $this->input->post('si');
		$id_serv = $this->input->post('id_service');
		$id_user = $this->session->userdata('id_user');
		$date_add = $this->getDatetimeNow();

		for ($i=0; $i < sizeof($si); $i++)
		{
			$data = array(
				'id_service' => $id_serv,
				'id_system ' => $si[$i],
				'id_user_add'=> $id_user,
				'date_ajout' => $date_add
			);
			$this->db->insert('auto_serv',$data);
		}

		$this->session->set_flashdata('success', "Vous venez d'accord à une ou plusieurs institution(s) l'utilisation de ton service");
		redirect('WebService');
	}

	/**Liste des systèmes d'information qui utilisent ce service */
	public function listeSI($id_serv){
		/** Liste des SI */
		$listeSIWeb = $this->WebService_model->ListeSIWeb($id_serv);
		$data['listeSIWeb'] = $listeSIWeb;

		/** Id du service */
		$data['idserv'] = $id_serv;

		$titreAffiche = 'Liste des systèmes d\'information qui utilisent un web service';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/listeSysInfoAutoriser_view", $data);
		$this->load->view("users/templates/footer");
	}

	/** Supprimer une autorisation de service */
	public function supprimerSystemeInfoWeb($id, $idserv){
		$id_user_delete = $this->session->userdata('id_user');
		$date_delete = $this->getDatetimeNow();

		$data = array(
			'id_user_delete' 	=> $id_user_delete,
			'date_delete' 		=> $date_delete
		);

		$supprimerAutoWS = $this->WebService_model->supprimerAutoWS($data, $id);

		if ($supprimerAutoWS = true)
		{
			$this->session->set_flashdata('success', "Suppression d'un web service réussi");
			redirect('WebService/listeSI/'.$idserv);
		}
		else{
			$this->session->set_flashdata('error', 'Veuillez réessayer.');
			redirect('WebService/listeSI/'.$idserv);
		}
	}

}
