<?php

class Enregistrement extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('Curl');
		$this->load->model('Login_model');
		$this->load->model('Enregistrement_model');
		$this->load->model('Profile_model');


		if (!$this->session->userdata('id_user')) {
			redirect('Login');
		}

		if($this->session->userdata('nom_type') != "Enregistrement")
		{
			redirect('Erreur/erreur404');
		}
	}

	function getDatetimeNow()
	{
		$tz_object = new DateTimeZone('Africa/Djibouti');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		return $datetime->format('Y-m-d H:i:s');
	}

	public function index(){
		
		/** Titre */
		$titreAffiche = 'Ajouter une personne -Registre des Personnes Handicapées';
		$data['titreAffiche'] = $titreAffiche;
		
		/** Information utilisateur */
		$id = $this->session->userdata('id_user');
		$infoUser = $this->Profile_model->getProfileUser($id);
		$data['infoUser'] = $infoUser;

		$this->load->view('templates/header_view', $data);
		$this->load->view('pages/ajoutPerson_view');
		$this->load->view('templates/footer_view');
	}

	public function rechercherCin(){
		$cin = $this->input->post('cin');
		/* Endpoint */
		$url = 'http://10.193.113.36/r1/DJ/GOV-PRE/10014/registre/RechercheIndividu/'.$cin;

		/* eCurl */
		$curl = curl_init($url);


		/* Return json */
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		/* Define content type */
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'X-Road-Client:DJ/GOV-PRE/100018/SIGPH'
		));

		/* make request */
		$result = curl_exec($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		/* close curl*/
		curl_close($curl);

		if($httpcode == 200){
			$person = json_decode($result);
			$this->ajoutPersonneTrouve($person);
		}
		elseif($httpcode == 404){
		
			/** Message d'erreur */
			$message_erreur = "Le numéro CNI est obligatoire";
			$this->personneNonTrouver($message_erreur, $httpcode);
		}
		else{
			
			/** Message d'erreur */
			$message_erreur = "La personne que vous cherchez n'existe pas.";
			$this->personneNonTrouver($message_erreur, $httpcode);
		}
	}

	/** Code success 200 */
	public function ajoutPersonneTrouve($person){
		/** Titre **/
		$titreAffiche = 'Ajout enregsitrement-Registre des Personnes Handicapées';
		$data['titreAffiche'] = $titreAffiche;

		/** Image utilisateur **/
		$id = $this->session->userdata('id_user');
		$infoUser = $this->Profile_model->getProfileUser($id);
		$data['infoUser'] = $infoUser;

		$data['person'] = $person;
		
		$this->load->view('templates/header_view', $data);
		$this->load->view('pages/ajoutPersonneRech_view', $data);
		$this->load->view('templates/footer_view');
	}


	/** Code erreur 400 & 404 */
	public function personneNonTrouver($messageErreur, $code){
		/** Données passer en paramètres */
		$message = $messageErreur;
		$data['message'] = $message;
		
		$codeHttp = $code;
		$data['codeHttp'] = $codeHttp;
		
		/** Titre **/
		$titreAffiche = 'Erreur-Registre des Personnes Handicapées';
		$data['titreAffiche'] = $titreAffiche;

		/** Image utilisateur **/
		$id = $this->session->userdata('id_user');
		$infoUser = $this->Profile_model->getProfileUser($id);
		$data['infoUser'] = $infoUser;
		
		$this->load->view('templates/header_view', $data);
		$this->load->view('pages/pageErreur', $data);
		$this->load->view('templates/footer_view');
	}

	public function validationAjout()
	{
		# code...
		$this->form_validation->set_rules('cin', 'cin ', 'trim|required');
		$this->form_validation->set_rules('nom', 'nom ', 'trim|required');
		$this->form_validation->set_rules('nom2', 'deuxième nom ', 'trim|required');
		$this->form_validation->set_rules('nom3', 'troisième nom ', 'trim|required');
		$this->form_validation->set_rules('sexe', 'genre ', 'trim|required');
		$this->form_validation->set_rules('nom_mere', 'nom de la mère', 'trim|required');
		$this->form_validation->set_rules('nom_mere2', 'nom de la mère 2', 'trim|required');
		$this->form_validation->set_rules('datenaissance', 'date de naissance ', 'trim|required');
		$this->form_validation->set_rules('lieunaissance', 'lieu de naissance ', 'trim|required');
		$this->form_validation->set_rules('pays', 'pays ', 'trim|required');
		$this->form_validation->set_rules('etat_civil', 'état civil ', 'trim|required');
		$this->form_validation->set_rules('adresse', 'adresse ', 'trim|required');
		$this->form_validation->set_rules('telephone', 'téléphone ', 'trim|required');
		$this->form_validation->set_rules('region', 'région ', 'trim|required');
		$this->form_validation->set_rules('ville_village', 'ville/village ', 'trim|required');

		
		if ($this->form_validation->run() == true) {
			$cni = $this->input->post('cin');
			$nom = $this->input->post('nom');
			$nom2 = $this->input->post('nom2');
			$nom3 = $this->input->post('nom3');
			$sexe = $this->input->post('sexe');
			$nom_mere = $this->input->post('nom_mere');
			$nom_mere2 = $this->input->post('nom_mere2');
			$datenaissance = $this->input->post('datenaissance');
			$lieunaissance = $this->input->post('lieunaissance');
			$pays = $this->input->post('pays');
			$etat_civil = $this->input->post('etat_civil');
			$adresse = $this->input->post('adresse');
			$telephone = $this->input->post('telephone');
			$region = $this->input->post('region');
			$ville_village = $this->input->post('ville_village');
			$id_user = $this->session->userdata('id_user');
			$date_add = $this->getDatetimeNow();


			$data = array(
				'cin' => $cni,
				'nom1' => $nom,
				'nom2' => $nom2,
				'nom3' => $nom3,
				'sexe' => $sexe,
				'nom1_mere' => $nom_mere,
				'nom2_mere' => $nom_mere2,
				'datenaissance' => $datenaissance,
				'lieunaissance' => $lieunaissance,
				'pays' => $pays,
				'etat_civil' => $etat_civil,
				'adresse' => $adresse,
				'telephone' => $telephone,
				'region' => $region,
				'ville_village' => $ville_village,
				'id_user_add' => $id_user,
				'date_add' => $date_add
			);

			$addPerson = $this->Enregistrement_model->enregistrement($data);

			if ($addUser = true)
			{
				$action = "Enregistrement d'une personne";
				$this->histoirque($action);
				$this->session->set_flashdata('sucess', 'Enregistrement d\'une personne réussi');
				redirect('Enregistrement/Liste');
			}
			else{
				$this->session->set_flashdata('error', 'Veuillez réessayer.');
				redirect('Enregistrement');
			}
			
		}
		else{
			//false 
			$this->index();
		}
	}

	/** Liste des enregistrements */
	public function Liste(){
		//Liste des rôles
		$listeEnregistrements = $this->Enregistrement_model->listeEnregistrements();
		$data['listeEnregistrements'] = $listeEnregistrements;

		/** Titre */
		$titreAffiche = 'Liste des enregistrements-Registre des Personnes Handicapées';
		$data['titreAffiche'] = $titreAffiche;
		
		/** Information utilisateur */
		$id = $this->session->userdata('id_user');
		$infoUser = $this->Profile_model->getProfileUser($id);
		$data['infoUser'] = $infoUser;

		$this->load->view('templates/header_view', $data);
		$this->load->view('pages/listeEnregistrement_view', $data);
		$this->load->view('templates/footer_view');
	}

	public function modifierPersonne($cin)
	{
		/** Titre */
		$titreAffiche = 'Modification d\'un enregistrement-Registre des Personnes Handicapées';
		$data['titreAffiche'] = $titreAffiche;
		
		/** Information utilisateur */
		$id = $this->session->userdata('id_user');
		$infoUser = $this->Profile_model->getProfileUser($id);
		$data['infoUser'] = $infoUser;

		/** Detail de la personne grâce à son cin*/
		$detailPerson = $this->Enregistrement_model->detailPerson($cin);
		$data['detailPerson'] = $detailPerson;

		$this->load->view('templates/header_view', $data);
		$this->load->view('pages/modifierPersonne_view', $data);
		$this->load->view('templates/footer_view');
	}

	public function modificationPerson(){
		# code...
		$cin1 = $this->input->post('cin1');
		$this->form_validation->set_rules('cin', 'cin ', 'trim|required');
		$this->form_validation->set_rules('nom', 'nom ', 'trim|required');
		$this->form_validation->set_rules('nom2', 'deuxième nom ', 'trim|required');
		$this->form_validation->set_rules('nom3', 'troisième nom ', 'trim|required');
		$this->form_validation->set_rules('sexe', 'genre ', 'trim|required');
		$this->form_validation->set_rules('nom_mere', 'nom de la mère', 'trim|required');
		$this->form_validation->set_rules('nom_mere2', 'nom de la mère 2', 'trim|required');
		$this->form_validation->set_rules('datenaissance', 'date de naissance ', 'trim|required');
		$this->form_validation->set_rules('lieunaissance', 'lieu de naissance ', 'trim|required');
		$this->form_validation->set_rules('pays', 'pays ', 'trim|required');
		$this->form_validation->set_rules('etat_civil', 'état civil ', 'trim|required');
		$this->form_validation->set_rules('adresse', 'adresse ', 'trim|required');
		$this->form_validation->set_rules('telephone', 'téléphone ', 'trim|required');
		$this->form_validation->set_rules('region', 'région ', 'trim|required');
		$this->form_validation->set_rules('ville_village', 'ville/village ', 'trim|required');

		
		if ($this->form_validation->run() == true) {
			$cni = $this->input->post('cin');
			$nom = $this->input->post('nom');
			$nom2 = $this->input->post('nom2');
			$nom3 = $this->input->post('nom3');
			$sexe = $this->input->post('sexe');
			$nom_mere = $this->input->post('nom_mere');
			$nom_mere2 = $this->input->post('nom_mere2');
			$datenaissance = $this->input->post('datenaissance');
			$lieunaissance = $this->input->post('lieunaissance');
			$pays = $this->input->post('pays');
			$etat_civil = $this->input->post('etat_civil');
			$adresse = $this->input->post('adresse');
			$telephone = $this->input->post('telephone');
			$region = $this->input->post('region');
			$ville_village = $this->input->post('ville_village');


			$data = array(
				'cin' => $cni,
				'nom1' => $nom,
				'nom2' => $nom2,
				'nom3' => $nom3,
				'sexe' => $sexe,
				'nom1_mere' => $nom_mere,
				'nom2_mere' => $nom_mere2,
				'datenaissance' => $datenaissance,
				'lieunaissance' => $lieunaissance,
				'pays' => $pays,
				'etat_civil' => $etat_civil,
				'adresse' => $adresse,
				'telephone' => $telephone,
				'region' => $region,
				'ville_village' => $ville_village
			);

			$updatePerson = $this->Enregistrement_model->modificationEnregistrement($data, $cin1);

			if ($updatePerson = true)
			{
				$action = "Modification d'une personne";
				$this->histoirque($action);
				$this->session->set_flashdata('sucess', 'Modification d\'une personne réussi');
				redirect('Enregistrement/Liste');
			}
			else{
				$this->session->set_flashdata('error', 'Veuillez réessayer.');
				redirect('modifierPersonne/'.$cin1);
			}
			
		}
		else{
			//false 
			$this->modifierPersonne($cin1);
		}
	}

	public function supprimerPersonne($cin)
	{
		$id_user = $this->session->userdata('id_user');
		$date_add = $this->getDatetimeNow();

		$data = array(

			'id_user_delete' => $id_user,
			'date_delete' => $date_add,
		);

		$supprimerPersonne = $this->Enregistrement_model->supprimerPersonne($data, $cin);

		if ($supprimerPersonne = true)
		{
			$action = "Suppression d'une personne qui a le cin ".$cin.".";
			$this->histoirque($action);
			$this->session->set_flashdata('sucess', "Suppression d'une personne réussi");
			redirect('Enregistrement/Liste');
		}
		else{
			$this->session->set_flashdata('error', 'Veuillez réessayer.');
			redirect('Enregistrement/Liste');
		}
	}

	/** Historique Admin */
	public function histoirque($action)
	{
		$data = array(
			'id_user' =>$this->session->userdata('id_user'),
			'action_his' => $action,
			'date_his' =>$this->getDatetimeNow()
		);
		$this->Login_model->log_manager($data);
	}
}
