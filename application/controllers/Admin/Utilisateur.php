<?php

class Utilisateur extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Login_model');
		$this->load->model('Admin/Institution_model');
		$this->load->model('Admin/Utilisateur_model');
		$this->load->library('form_validation');


		if(!$this->session->userdata('id_admin')){
			redirect('Admin/Login');
		}

	}

	function getDatetimeNow()
	{
		$tz_object = new DateTimeZone('Africa/Djibouti');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		return $datetime->format('Y-m-d');
	}

	/** Liste des utilisateurs */
	public function index(){
		/** Liste des utilisateurs */
		$listeUsers = $this->Utilisateur_model->getListeUsers();
		$data['listeUsers'] = $listeUsers;

		/** Titre */
		$titreAffiche = 'Liste des serveurs de sécurités';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("admin/templates/header", $data);
		$this->load->view("admin/pages/listeUtilisateurs_view", $data);
		$this->load->view("admin/templates/footer");
	}

	/** Ajout d'un uitilisateur */
	public function ajoutUtilisateur(){
		/** Liste des Institutions */
		$listeInst = $this->Institution_model->getListeInst();
		$data['listeInst'] = $listeInst;

		/** Titre */
		$titreAffiche = 'Ajouter un utilisateur';
		$data['titreAffiche'] = $titreAffiche;


		$this->load->view("admin/templates/header", $data);
		$this->load->view("admin/pages/ajoutUtilisateur", $data);
		$this->load->view("admin/templates/footer");
	}

	public function verificationAjout(){
		$this->form_validation->set_rules('inst', "nom de l'institution", 'trim|required');
		$this->form_validation->set_rules('username', "nom d'utilisateur", 'trim|required|is_unique[utilisateur.username]');
		$this->form_validation->set_rules('pass', 'mot de passe ', 'trim|required|min_length[8]|max_length[10]');
		$this->form_validation->set_rules('cnfpass', 'confiration diu mot de passe ', 'trim|required|min_length[8]|max_length[10]');

		if($this->form_validation->run()==true){
			//True
			$username = $this->input->post('username');
			$inst = $this->input->post('inst');
			$pass = $this->input->post('pass');
			$cnfpass = $this->input->post('cnfpass');
			$id_admin_add = $this->session->userdata('id_admin');
			$date_add = $this->getDatetimeNow();

			if($pass ==$cnfpass){
				$data = array(
					'username'      => $username,
					'password'      => password_hash($pass, PASSWORD_BCRYPT),
					'id_inst '      => $inst,
					'date_ajout'    => $date_add,
					'id_admin_ajout'  => $id_admin_add

				);


				$addUser = $this->Utilisateur_model->addUser($data);

				if ($addUser = true)
				{
					$this->session->set_flashdata('sucess', 'Ajout utilisateur réussi');
					redirect('Admin/Utilisateur/');
				}
				else{
					$this->session->set_flashdata('error', 'Veuillez réessayer.');
					redirect('Admin/Utilisateur/ajoutUtilisateur');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Les deux mot de passes ne sont pas identiques.');
				redirect('Admin/Utilisateur/ajoutUtilisateur');
			}


		}
		else{
			//False
			$this->ajoutUtilisateur();
		}

	}

}
