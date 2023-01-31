<?php

class Institution extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Login_model');
		$this->load->model('Admin/Institution_model');
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
		/** Liste des Institutions */
        $listeInst = $this->Institution_model->getListeInst();
		$data['listeInst'] = $listeInst;

		/** Titre */
        $titreAffiche = 'Liste des institutions';
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view("admin/templates/header", $data);
		$this->load->view("admin/pages/listeInstitution_view", $data);
		$this->load->view("admin/templates/footer");
	}

    /** Ajouter une institution */
    public function ajoutInst(){
		/** Titre */
        $titreAffiche = 'Ajouter une institution';
		$data['titreAffiche'] = $titreAffiche;


		$this->load->view("admin/templates/header", $data);
		$this->load->view("admin/pages/ajoutInstitution", $data);
		$this->load->view("admin/templates/footer");
	}


    public function verificationAjout()
	{
		$this->form_validation->set_rules('inst', "nom de l'institution", 'trim|required');
		$this->form_validation->set_rules('ancro', "acronyme de l'institution", 'trim|required');


		if($this->form_validation->run()==true){
			//True
            $inst = $this->input->post('inst');
			$ancro = $this->input->post('ancro');
			$id_admin_add = $this->session->userdata('id_admin');
			$date_add = $this->getDatetimeNow();

			$data = array(
				'nom_inst'          => $inst,
				'nom_court_inst'    => $ancro,
				'date_ajout '       => $date_add,
				'id_admin_ajout'    => $id_admin_add

			);

			$addInst = $this->Institution_model->addInst($data);

			if ($addUser = true)
			{
				$this->session->set_flashdata('sucess', 'Ajout institution réussi');
				redirect('Admin/Institution/');
			}
			else{
				$this->session->set_flashdata('error', 'Veuillez réessayer.');
				redirect('Admin/Institution/ajoutInst');
			}

		}
        else{
			//False
            $this->ajoutInst();
		}

	}
}
