<?php

class Model_mapel extends CI_Model{
	public $tabel = 'tbl_mapel';
	function save(){
		$data = array(
			'kd_mapel'	=> $this->input->post('kd_mapel', TRUE),
			'nama_mapel'=> $this->input->post('nama_mapel', TRUE)
		);
		$this->db->insert($this->tabel, $data);

	}
	function edit(){
		$data = array(
			'nama_mapel'=> $this->input->post('nama_mapel', TRUE)
		);
		$kd_mapel		= $this->input->post('kd_mapel', TRUE);
		$this->db->where('kd_mapel', $kd_mapel);
		$this->db->update($this->tabel, $data);
	}
}