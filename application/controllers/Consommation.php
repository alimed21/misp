<?php

class Consommation extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('Consommation_model');
		$this->load->model('Parametres_model');
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
		/** Institution */
		$id_inst = $this->session->userdata('id_inst');
		/** Utilisateur */
		$id_user = $this->session->userdata('id_user');
		/** Get institution */
		$nomInst = $this->Parametres_model->getInstitutionName($id_inst, $id_user);
		$data['nomInst'] = $nomInst;
		/** Liste des SI */
		$listeSI = $this->Systeme_Information_model->getListSI($id_inst);
		$data['listeSI'] = $listeSI;

		$titreAffiche = 'Liste de vos systèmes d\'information';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/consommationWebService_view", $data);
		$this->load->view("users/templates/footer");
	}

	public function services($id_si, $id_service){
		/** Institution */
		$id_inst = $this->session->userdata('id_inst');
		/** Liste des SI */
		$listeService = $this->Consommation_model->listeService($id_service, $id_si);
		$data['listeService'] = $listeService;

		$titreAffiche = 'Liste de vos systèmes d\'information';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/consommationService_view", $data);
		$this->load->view("users/templates/footer");
	}

	public function personCni($idserv, $id_system){
		/** Institution */
		$id_inst = $this->session->userdata('id_inst');

		$permissionServ = $this->Consommation_model->getPermission($idserv, $id_system, $id_inst);

		$result=null;


		if($permissionServ != false){

			foreach ($permissionServ as $per) {
				$idser = $per->id_service;
				$idsys = $per->id_system;
				$nomSer = $per->nom_service;
			}


			if($idser == $idserv && $idsys == $id_system){
				$result = true;
			}
			else{
				$result = false;
			}
		}
		else{
			$result = false;
		}

		$data['result'] = $result;
		$data['nomSer'] = $nomSer;

		$data['idserv'] = $idserv;
		$data['id_system'] = $id_system;

		$titreAffiche = 'Consommation du service '.$nomSer;
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("users/templates/header", $data);
		$this->load->view("users/pages/serviceCNI_view", $data);
		$this->load->view("users/templates/footer");
	}

	public function servCons(){
		$this->form_validation->set_rules('cni', 'cni', 'trim|required');

		$id_sys = $this->input->post('id_sys');
		$id_ser = $this->input->post('id_ser');

		if ($this->form_validation->run() == true) {

			//var_dump('oui');die();
			$cin = $this->input->post('cni');

			/** Institution */
			$id_inst = $this->session->userdata('id_inst');

			/** Serveur de sécurité client */
			$servInfo = $this->Consommation_model->getInfoServ($id_sys, $id_inst);

			/** Système d'information client */
			$sysInfo = $this->Consommation_model->getSysInfo($id_sys);

			$sysClient = $sysInfo->nom_si;

			/** Serveur de sécurité fournisseur */
			$servInfoFour = $this->Consommation_model->getInfoServFour($id_ser);

			/** Service du fournisseur */
			$serviceFour = $this->Consommation_model->getInfoServiceFour($id_ser);

			$serviceFournisseur = $serviceFour->nom_service;

			/** détails du serveur de sécurité du client */
			foreach($servInfo as $serv){
				$lien_client = $serv->lien_serv;
				$env_client = $serv->nom_serv;
				$clas_client = $serv->class_serv;
				$code_client = $serv->code_serv;
			}

			/** détails du serveur de sécurité du fournisseur */
			foreach($servInfoFour as $serv){
				$lien_four = $serv->lien_serv;
				$env_four = $serv->nom_serv;
				$clas_four = $serv->class_serv;
				$code_four = $serv->code_serv;
				$sys_four = $serv->nom_si;
			}


			/* Endpoint **/
			$url = ''.$lien_client.'/r1/'.$env_four.'/'.$clas_four.'/'.$code_four.'/'.$sys_four.'/'.$serviceFournisseur.'/'.$cin;

			/* eCurl **/
			$curl = curl_init($url);

			/* Return json **/
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			/* Define content type **/
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/json',
				'X-Road-Client:'.$env_client.'/'.$clas_client.'/'.$code_client.'/'.$sysClient.''
			));


			/* make request */
			$result = curl_exec($curl);

			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			/* close curl*/
			curl_close($curl);

			var_dump($result);die;

			if($httpcode == '404'){
				/** Message d'erreur */
				$data['message_erreur'] = "La personne que vous cherchez n'existe pas.";

				/** Titre */
				$titreAffiche = 'Recherche d\'une personne -Registre National';
				$data['titreAffiche'] = $titreAffiche;

				$this->load->view('registreRecehrche_view', $data);
			}
			elseif($httpcode == '400'){
				/** Message d'erreur */
				$data['message_erreur'] = "Les champs CIN est obligatoire veuillez le saisir.";

				/** Titre */
				$titreAffiche = 'Recherche d\'une personne -Registre National';
				$data['titreAffiche'] = $titreAffiche;

				$this->load->view('registreRecehrche_view', $data);
			}
			else{
				/** Resultat */
				$person = json_decode($result);
				$data['person'] = $person;

				/** Titre */
				$titreAffiche = 'Recherche d\'une personne -Registre National';
				$data['titreAffiche'] = $titreAffiche;


				$this->load->view("users/templates/header", $data);
				$this->load->view('users/pages/infoResultat_view', $data);
				$this->load->view("users/templates/footer");
			}
		}
		else{
			$this->personCni($id_ser, $id_sys);
		}
	}
}
