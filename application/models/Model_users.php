<?php

class Model_users extends CI_Model{
	public $tabel = 'tbl_user';
	function save($foto){
		$data = array(
			'nama_lengkap'	=> $this->input->post('nama_lengkap', TRUE),
			'username'		=> $this->input->post('username', TRUE),
			'password'		=> md5($this->input->post('password', TRUE)),
			'id_level_user'	=> $this->input->post('id_level_user', TRUE),
			'foto'			=> $foto
		);
		$this->db->insert($this->tabel, $data);

	}
	function edit($foto){
		if(empty($foto)){
			$data = array(
				'nama_lengkap'	=> $this->input->post('nama_lengkap', TRUE),
				'username'		=> $this->input->post('username', TRUE),
				'password'		=> md5($this->input->post('password', TRUE)),
				'id_level_user'	=> $this->input->post('id_level_user', TRUE)
			);
		} else {
			$data = array(
				'nama_lengkap'	=> $this->input->post('nama_lengkap', TRUE),
				'username'		=> $this->input->post('username', TRUE),
				'password'		=> md5($this->input->post('password', TRUE)),
				'id_level_user'	=> $this->input->post('id_level_user', TRUE),
				'foto'			=> $foto
			);
		}
		
		$id_user			= $this->input->post('id_user', TRUE);
		$this->db->where('id_user', $id_user);
		$this->db->update($this->tabel, $data);
	}
}