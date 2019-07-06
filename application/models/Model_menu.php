<?php

class Model_menu extends CI_Model{
	public $tabel = 'tabel_menu';
	function save(){
		$data = array(
			'judul_menu'	=> $this->input->post('judul_menu', TRUE),
			'link'=> $this->input->post('link', TRUE),
			'icon'=> $this->input->post('icon', TRUE),
			'is_main_menu'=> $this->input->post('is_main_menu', TRUE)
		);
		$this->db->insert($this->tabel, $data);

	}
	function edit(){
		$data = array(
			'judul_menu'	=> $this->input->post('judul_menu', TRUE),
			'link'			=> $this->input->post('link', TRUE),
			'icon'			=> $this->input->post('icon', TRUE),
			'is_main_menu'	=> $this->input->post('is_main_menu', TRUE)
		);
		$id		= $this->input->post('id', TRUE);
		$this->db->where('id', $id);
		$this->db->update($this->tabel, $data);
	}
}