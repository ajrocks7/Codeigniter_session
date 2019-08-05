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

	public function index()
	{
		$data = array();
		$data['details'] = $this->Login_model->viewdetails();
		$this->load->view('login/view',$data);
	}

	public function addnew()
	{
		$data = array();
		$data['details'] = $this->Login_model->viewdetails();
		$this->load->view('login/sample',$data);
	}

	public function submit()
	{
		
		parse_str($_POST['values'], $searcharray);
		$data = $this->Login_model->insertdata($searcharray);
		
	}

	public function editsumbit()
	{
		$id = $_POST['id'];
		parse_str($_POST['values'], $searcharray);
		$data = $this->Login_model->updatedata($searcharray,$id);
	}

	public function editform($id)
	{
		$data['details']  = $this->Login_model->editdata($id);
		$this->load->view('login/sample',$data);
	}

	public function delete()
	{
		$id = $_POST['id'];
      $res = $this->Login_model->delete($id);
      
	}
   
	public function getdetails()
	{
		$res = $this->Login_model->getdetails();
		echo json_encode($res);
	}

public function geteditdetails()
{
	$id = $_POST['id'];
	$res = $this->Login_model->geteditdetails($id);
		echo json_encode($res);
}
	public function dynamicform()
	{
		$data = array();
		$this->load->view('login/dynamic',$data);
	}

	public function dynamicsave()
	{
		$post = $this->input->post();
	
		$res = $this->Login_model->savedynamic($post);
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
