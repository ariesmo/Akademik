<?php

class Model_ruangan extends CI_Model{
	public $tabel = 'tbl_ruangan';
	function save(){
		$data = array(
			'kd_ruangan'	=> $this->input->post('kd_ruangan', TRUE),
			'nama_ruangan'=> $this->input->post('nama_ruangan', TRUE)
		);
		$this->db->insert($this->tabel, $data);

	}
	function edit(){
		$data = array(
			'nama_ruangan'=> $this->input->post('nama_ruangan', TRUE)
		);
		$kd_ruangan		= $this->input->post('kd_ruangan', TRUE);
		$this->db->where('kd_ruangan', $kd_ruangan);
		$this->db->update($this->tabel, $data);
	}
}