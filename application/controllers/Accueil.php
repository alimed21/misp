<?php

class Accueil extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Accueil_model');
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
		/** Titre */
		$titreAffiche = 'Accueil';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/accueil_view", $data);
		$this->load->view("users/templates/footer");
	}
}
