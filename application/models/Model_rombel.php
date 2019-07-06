<?php

class Model_rombel extends CI_Model{
	public $tabel = 'tbl_rombel';
	function save(){
		$data = array(
			'id_rombel'	=> $this->input->post('id_rombel', TRUE),
			'nama_rombel'=> $this->input->post('nama_rombel', TRUE),
			'kelas'=> $this->input->post('kelas', TRUE),
			'kd_jurusan'=> $this->input->post('jurusan', TRUE)
		);
		$this->db->insert($this->tabel, $data);

	}
	function edit(){
		$data = array(
			'nama_rombel'=> $this->input->post('nama_rombel', TRUE),
			'kelas'=> $this->input->post('kelas', TRUE),
			'kd_jurusan'=> $this->input->post('jurusan', TRUE)
		);
		$id_rombel		= $this->input->post('id_rombel', TRUE);
		$this->db->where('id_rombel', $id_rombel);
		$this->db->update($this->tabel, $data);
	}
}