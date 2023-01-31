<?php

class Parametres extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Login_model');
		$this->load->model('Admin/Parametres_model');
		$this->load->library('form_validation');

		if(!$this->session->userdata('id_admin')){
			redirect('Admin/Login');
		}

		/*if($this->session->userdata('nom_type') != 'admin' || $this->session->userdata('nom_type') != 'police') {
			redirect('Admin/Login');
		}*/
	}

	public function changerMotPasse(){
		/** Titre de la page */
		$titreAffiche = 'Changement de mot de passe';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("admin/templates/header", $data);
		$this->load->view("admin/pages/motPasse_view");
		$this->load->view("admin/templates/footer");
	}

	public function changePassword(){
		$this->form_validation->set_rules('ancien_pass', "ancien mot de passe", 'trim|required|min_length[8]|max_length[10]');
		$this->form_validation->set_rules('nouvo_pass', "nouveau mot de passe", 'trim|required|min_length[8]|max_length[10]');
		$this->form_validation->set_rules('cnfpass', "confirmation du nouveau mot de passe", 'trim|required|min_length[8]|max_length[10]');

		if ($this->form_validation->run() == true) {
			$lastPassword = $this->input->post('ancien_pass');
			$newPassword = $this->input->post('nouvo_pass');
			$cnfnewPassword = $this->input->post('cnfpass');

			$idAdmin = $this->session->userdata('id_admin');

			//Recuperation de l'ancien mot de passe
			$lastPasswordUser = $this->Parametres_model->verifyLastePasswordUser($idAdmin, $lastPassword);



			//Comparaison entre les deux anciens mot de passe

			if($lastPasswordUser != false){
				//Voir si le nouveau mot de passe est pareil que la confirmation
				$passwordUser = $this->Parametres_model->verifyLastePasswordUser($idAdmin, $newPassword);
				if($passwordUser != true){
					if($newPassword == $cnfnewPassword){
						//Modification du mot de passe
						$data = array(
							'pass_admin' => password_hash($newPassword, PASSWORD_BCRYPT)
						);
						$updatePassword = $this->Parametres_model->changePassword($idAdmin, $data);

						if ($updatePassword = true) {
							$this->session->set_flashdata('success', 'Votre mot de passe a bien été modifié');
							redirect('Admin/Login/logout', 'refresh');
						}
						else {
							$this->session->set_flashdata('error', 'Veuillez réessayer.');
							redirect('Admin/Parametres/changerMotPasse', 'refresh');
						}
					}
					else{
						$this->session->set_flashdata('error', 'Les deux mot des passes ne sont pas identiques.');
						redirect('Admin/Parametres/changerMotPasse', 'refresh');
					}
				}
				else{
					$this->session->set_flashdata('error', 'Vous ne pouvez pas réutiliser votre ancien mot de passe.');
					redirect('Admin/Parametres/changerMotPasse', 'refresh');

				}
			}
			else{
				$this->session->set_flashdata('error', 'Votre ancien mot de passe est incorrect.');
				redirect('Admin/Parametres/changerMotPasse', 'refresh');
			}
		}
		else{
			$this->changerMotPasse();
		}
	}

	public function profilUser(){
		/** Titre de la page */
		$titreAffiche = 'Profil';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("admin/templates/header", $data);
		$this->load->view("admin/pages/profil_view");
		$this->load->view("admin/templates/footer");
	}
}
