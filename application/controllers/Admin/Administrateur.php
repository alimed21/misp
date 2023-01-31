<?php

class Administrateur extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Login_model');
		$this->load->model('Admin/Administrateur_model');

		if(!$this->session->userdata('id_admin')){
			redirect('Admin/Login');
		}

	}

    function getDatetimeNow()
	{
		$tz_object = new DateTimeZone('Africa/Djibouti');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		return $datetime->format('Y-m-d H:i:s');
	}

	/** Gestion Utilisateurs */
	public function index(){
		/** Liste des utilisateurs */
        $listeAdmin = $this->Administrateur_model->getListeAdmin();
		$data['listeAdmin'] = $listeAdmin;

		/** Titre */
        $titreAffiche = 'Accueil';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("admin/templates/header", $data);
		$this->load->view("admin/pages/listeAdministrateur_view", $data);
		$this->load->view("admin/templates/footer");
	}

    /** Alertes */
    public function listeAlertes(){
		/** Titre */
        $titreAffiche = 'Liste des alertes';
		$data['titreAffiche'] = $titreAffiche;
		/** Liste des alerts */
        $listeAlert = $this->Police_model->getListeAlert();
		$data['listeAlert'] = $listeAlert;
		/** Liste des utilisateurs */
         $listeUtilisateurs = $this->Administrateur_model->getListeUsers();
		$data['listeUtilisateurs'] = $listeUtilisateurs;


		$this->load->view("admin/templates/header", $data);
		$this->load->view("admin/pages/listeAlert", $data);
		$this->load->view("admin/templates/footer");
	}
}
