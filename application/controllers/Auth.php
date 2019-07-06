<?php

class Auth extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Model_login');
		$this->load->model('Model_guru');
		
	}
	function index(){

	$this->load->view('login/auth');
	}

	function login(){
			$username 	= $this->input->post('username');
			$password 	= $this->input->post('password');
			$loginUser = $this->Model_login->checkLogin($username,$password);
			$loginGuru = $this->Model_guru->checkLogin($username,$password);
			if(!empty($loginUser)){
				$this->session->set_userdata($loginUser);
				$this->template->load('template', 'dashboard');
			} else if (!empty($loginGuru)){
				$session = array(
					'nama_lengkap' 	=> $loginGuru['nama_guru'], 
					'id_guru'		=> $loginGuru['id_guru'],
					'id_level_user'	=> 3
					
				);
			$this->session->set_userdata($session);
			$this->template->load('template', 'dashboard');
			} else {
				redirect('auth');
			}
			
				
				
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('auth');
	}
		
}