<?php

class Login extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('Admin/Login_model');
        $this->load->library('form_validation');

    }

    public function index(){

		$titreAffiche = "Connexion";
		$data['titreAffiche'] = $titreAffiche;

		$this->load->view('admin/login_view', $data);
    }

    public function loginVerification(){
        $this->form_validation->set_rules('username', "nom d'utilisateur", 'trim|required');
        $this->form_validation->set_rules('pass', 'mot de passe ', 'trim|required');

        if($this->form_validation->run()==true)
        {
            //true
            $username = $this->input->post('username');
            $password = $this->input->post('pass');

            $result = $this->Login_model->can_login($username, $password);

            if($result != false)
            {
                if($result)
                {
                    $session_data = array(
                        'id_admin' => $result[0]->id_admin,
                        'login_admin' => $result[0]->login_admin
                    );
                }

                $this->session->set_userdata($session_data);

                /** Rédirection du controller */
				redirect("Admin/Administrateur");
            }
            else
            {
                $data['error_message'] = 'Nom d\'utilisateur ou mot de passe incorrect';
                $this->load->view('admin/login_view', $data);
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
        $this->session->unset_userdata('id_admin');
        session_destroy();
        redirect('Admin/Login', 'refresh');
    }
    /** Historique
    public function histoirque($action)
    {
        $data = array(
            'id_user' =>$this->session->userdata('id_user'),
            'action_his' => $action,
            'date_his' =>$this->getDatetimeNow()
        );
        $this->Login_model->log_manager($data);
    } */
}
