<?php

class Model_guru extends CI_Model{
	public $tabel = 'tbl_guru';
	function save(){
		$data = array(
			'nuptk'	=> $this->input->post('nuptk', TRUE),
			'nama_guru'=> $this->input->post('nama_guru', TRUE),
			'gender'=> $this->input->post('gender', TRUE),
			'username'=> $this->input->post('username', TRUE),
			'password'=> $this->input->post('password', TRUE)
		);
		$this->db->insert($this->tabel, $data);

	}
	function edit(){
		$data = array(
			'nuptk'=> $this->input->post('nuptk', TRUE),
			'nama_guru'=> $this->input->post('nama_guru', TRUE),
			'gender'=> $this->input->post('gender', TRUE),
			'username'=> $this->input->post('username', TRUE),
			'password'=> $this->input->post('password', TRUE)
		);
		$id_guru		= $this->input->post('id_guru', TRUE);
		$this->db->where('id_guru', $id_guru);
		$this->db->update($this->tabel, $data);
	}
	function checkLogin($username,$password){
		
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		// var_dump($username);
		// var_dump($password);
		// 	die;
		$user = $this->db->get_where('tbl_guru')->row_array();
		// var_dump($user);
		// die;
		
		return $user;
	}
}