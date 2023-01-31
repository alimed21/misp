<?php

class Registre extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('Curl');
		$this->load->model('Enregistrement_model');
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
		$titreAffiche = 'Recherche d\'une personne -Registre National';
		$data['titreAffiche'] = $titreAffiche;

        /** Message d'erreur */
        $data['message_erreur'] = NULL;
		
        $this->load->view('registre_view', $data);
	}

    public function recherchePersonne(){
        $this->form_validation->set_rules('cin', 'cin', 'trim|required');

        if ($this->form_validation->run() == true) {
            $cin = $this->input->post('cin');

            /* Endpoint 
            $url = 'http://terre.pni.dj/r1/DJDEV/GOV/dev10002/test_cm-01/Person/'.$cin;

            /* eCurl 
            $curl = curl_init($url);


            /* Return json 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            /* Define content type 
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json',
                'X-Road-Client:DJDEV/GOV/dev10003/test_pr_01'
            )); */

			$url = 'http://192.168.43.247:5000/person/'.$cin;
			/* Init cURL resource */
			$ch = curl_init($url);


			/* eCurl */
			$curl = curl_init($url);


			/* Return json */
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			/* Define content type */
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/json'
			));



            /* make request */
			$result = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			/* close curl*/
			curl_close($curl);

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
				var_dump($person);die;
				$data['$person'] = $person;

				/** Titre */
				$titreAffiche = 'Recherche d\'une personne -Registre National';
				$data['titreAffiche'] = $titreAffiche;

				$this->load->view('registreResultat_view', $data);
			}

        }
        else{
            $this->index();
        }
    }

	public function rechercheCNI(){
		$this->form_validation->set_rules('cin', 'cin', 'trim|required');

		if ($this->form_validation->run() == true) {
			$cin = $this->input->post('cin');

			/* API URL */
			$url = 'http://192.168.43.247:5000/person/'.$cin;

			/* Init cURL resource */
			$ch = curl_init($url);


			/* eCurl */
			$curl = curl_init($url);


			/* Return json */
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			/* Define content type */
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
					'Content-Type:application/json'
			));


			$result = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			/* close curl*/
			curl_close($curl);



			if($httpcode == '404'){
				/** Message d'erreur */
				$data['message_erreur'] = "La personne que vous cherchez n'existe pas.";

				/** Titre */
				$titreAffiche = 'Recherche d\'une personne -Registre National';
				$data['titreAffiche'] = $titreAffiche;

				$this->load->view('registre_view', $data);
			}
			elseif($httpcode == '400'){
				/** Message d'erreur */
				$data['message_erreur'] = "Le CIN est obligatoire veuillez le saisir.";

				/** Titre */
				$titreAffiche = 'Recherche d\'une personne -Registre National';
				$data['titreAffiche'] = $titreAffiche;

				$this->load->view('registre_view', $data);
			}
			else{
				/** Resultat */
				$person = json_decode($result);
				$data['person'] = $person;

				/** Titre */
				$titreAffiche = 'Recherche d\'une personne -Registre National';
				$data['titreAffiche'] = $titreAffiche;

				$this->load->view('registreResultat_view', $data);
			}
		}
		else{
			$this->index();
		}
	}

	/** Recherche avec le nom, la date de naissance et le cin **/
	public function recherche(){

		/** Titre */
		$titreAffiche = 'Recherche d\'une personne -Registre National';
		$data['titreAffiche'] = $titreAffiche;

		/** Message d'erreur */
		$data['message_erreur'] = NULL;

		$this->load->view('registreRecehrche_view', $data);
	}

	public function rechercheIndividu(){
		$this->form_validation->set_rules('cin', 'cin', 'trim|required');
		$this->form_validation->set_rules('nom', 'nom complet', 'trim|required');
		$this->form_validation->set_rules('date_naissance', 'date de naissance', 'trim|required');


		if ($this->form_validation->run() == true) {
			$cin = $this->input->post('cin');
			$nom = $this->input->post('nom');
			$datenaissance = $this->input->post('date_naissance');

			$noms = explode(" ", $nom);
			$date_naissance = strval($datenaissance);
			$all_date = explode(" ", $date_naissance);
			$years = $all_date[0];
			//$month = $all_date[1];
			//$day = $all_date[2];
			var_dump($nom[0]);die;


			$url = 'http://10.193.71.141:5000/recherche/'.$cin.'/'.$nom[0].'/'.$nom[1].'/'.$nom[2].'/'.$datenaissance;

			/* Init cURL resource */
			$ch = curl_init($url);


			/* eCurl */
			$curl = curl_init($url);


			/* Return json */
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			/* Define content type */
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/json'
			));


			$result = curl_exec($curl);
			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			/* close curl*/
			curl_close($curl);

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
				$data['message_erreur'] = "Les champs CIN, nom et date de naissance sont obligatoires veuillez le saisir.";

				/** Titre */
				$titreAffiche = 'Recherche d\'une personne -Registre National';
				$data['titreAffiche'] = $titreAffiche;

				$this->load->view('registreRecehrche_view', $data);
			}
			else{
				/** Resultat */
				$person = json_decode($result);
				$data['$person'] = $person;

				/** Titre */
				$titreAffiche = 'Recherche d\'une personne -Registre National';
				$data['titreAffiche'] = $titreAffiche;

				$this->load->view('registreResultat_view', $data);
			}

		}else{
			$this->recherche();
		}

	}
}
