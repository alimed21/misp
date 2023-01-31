<?php

class Connexion extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Connexion_model');
		$this->load->library('form_validation');

	}

	public function index(){

		$titreAffiche = "Connexion";
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view('users/login_view', $data);
	}

	public function loginVerification(){
		$this->form_validation->set_rules('username', "nom d'utilisateur", 'trim|required');
		$this->form_validation->set_rules('pass', 'mot de passe ', 'trim|required');

		if($this->form_validation->run()==true)
		{
			//true
			$username = $this->input->post('username');
			$password = $this->input->post('pass');

			$result = $this->Connexion_model->can_login($username, $password);

			if($result != false)
			{
				if($result)
				{
					$session_data = array(
						'id_user' => $result[0]->id_user,
						'username' => $result[0]->username,
						'id_inst' => $result[0]->id_inst,
						'logged_in' 	=> TRUE
					);
				}

				$this->session->set_userdata($session_data);

				/** Rédirection du controller */
				redirect("Consommation");
			}
			else
			{
				$data['error_message'] = 'Nom d\'utilisateur ou mot de passe incorrect';
				$this->load->view('users/login_view', $data);
			}

		}
		else
		{
			//false
			$this->index();
		}
	}


	//Logout function
	public function logout()
	{
		/* $action = "Déconnexion";
		 $this->histoirque($action);*/
		$this->session->unset_userdata('id_user');
		session_destroy();
		redirect('Connexion', 'refresh');
	}
}
