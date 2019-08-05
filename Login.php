<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model("Login_model");
        $this->load->library('session');
        $this->load->library('Password');
    }

	
	public function generateloginforadmin()
	{
		$this->Login_model->generatepasswordforadmin();
		
		$this->load->view('login/dummy');
	}

	public function generatepasswordforuser()
	{
		$this->Login_model->generatepasswordforuser();
		
		$this->load->view('login/dummy');
	}

	public function logincheck()
	{
		$this->load->view('login/check');
	}

	public function logout(){
        $this->phpsession->clear();
        redirect('login/logincheck');
    }

	public function checkpassword()
	{
		$post = $this->input->post();
		$result = $this->Login_model->checklogin($post);
		if($result == 1)
		{
			redirect('Login/welcome');
		}else{
			$data["errors"][] = "Please enter correct User name and Password";
		}
		$this->load->view('login/check',$data);
	}

	public function welcome()
	{
		 $usertype = $this->phpsession->get('user_type');
        if(empty($usertype)){
            $role = $this->phpsession->get('user_role');
            redirect('Login/logincheck');
        }
         $data = array();
		$this->load->view('login/welcome',$data,$this);
	}

}
