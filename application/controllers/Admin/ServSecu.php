<?php

class ServSecu extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Login_model');
		$this->load->model('Admin/Institution_model');
		$this->load->model('Admin/ServSecu_model');
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

	/** Liste des institutions */
	public function index(){
		/** Liste des serveurs de sécurités */
        $listeServ = $this->ServSecu_model->getListeServ();
		$data['listeServ'] = $listeServ;

		/** Titre */
        $titreAffiche = 'Liste des serveurs de sécurités';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("admin/templates/header", $data);
		$this->load->view("admin/pages/listeServSecu_view", $data);
		$this->load->view("admin/templates/footer");
	}

    /** Ajouter un serveur de sécurité */
    public function ajoutServSecu(){
		/** Liste des Institutions */
        $listeInst = $this->Institution_model->getListeInst();
		$data['listeInst'] = $listeInst;
		
		/** Titre */
        $titreAffiche = 'Ajouter un serveur de sécurité';
		$data['titreAffiche'] = $titreAffiche;


		$this->load->view("admin/templates/header", $data);
		$this->load->view("admin/pages/ajoutServSecu", $data);
		$this->load->view("admin/templates/footer");
	}


    public function verificationAjout()
	{
		$this->form_validation->set_rules('inst', "nom de l'institution", 'trim|required');
		$this->form_validation->set_rules('lien_serv', "lien du serveur de sécurité", 'trim|required|is_unique[serv_secu.lien_serv]');
		$this->form_validation->set_rules('env_serv', "environnement du serveur de sécurité", 'trim|required');
		$this->form_validation->set_rules('class_serv', "classe du serveur de sécurité", 'trim|required');
		$this->form_validation->set_rules('code_serv', "code du serveur de sécurité", 'trim|required|is_unique[serv_secu.code_serv]');


		if($this->form_validation->run()==true){
			//True
            $inst = $this->input->post('inst');
			$lien_serv = $this->input->post('lien_serv');
			$env_serv = $this->input->post('env_serv');
			$class_serv = $this->input->post('class_serv');
			$code_serv = $this->input->post('code_serv');
			$id_admin_add = $this->session->userdata('id_admin');
			$date_add = $this->getDatetimeNow();

			$data = array(
				'lien_serv'       => $lien_serv,
				'nom_serv'    	  => $env_serv,
				'class_serv '     => $class_serv,
				'code_serv'       => $code_serv,
				'id_inst'    	  => $inst,
				'date_ajout'      => $date_add,
				'id_admin_ajout'  => $id_admin_add
			);

			$addServ = $this->ServSecu_model->addServ($data);

			if ($addUser = true)
			{
				$this->session->set_flashdata('sucess', 'Ajout serveur de sécurité réussi');
				redirect('Admin/ServSecu/');
			}
			else{
				$this->session->set_flashdata('error', 'Veuillez réessayer.');
				redirect('Admin/ServSecu/ajoutServSecu');
			}

		}
        else{
			//False
            $this->ajoutServSecu();
		}

	}
}
