<?php

class Model_tahunakademik extends CI_Model{
	public $tabel = 'tbl_thn_akademik';
	function save(){
		$data = array(
			'id_tahun_akademik'	=> $this->input->post('id_tahun_akademik', TRUE),
			'tahun_akademik'=> $this->input->post('tahun_akademik', TRUE),
			'is_aktif'=> $this->input->post('is_aktif', TRUE)
		);
		$this->db->insert($this->tabel, $data);

	}
	function edit(){
		$data = array(
			'tahun_akademik'=> $this->input->post('tahun_akademik', TRUE),
			'is_aktif'=> $this->input->post('is_aktif', TRUE)
		);
		$id_tahun_akademik		= $this->input->post('id_tahun_akademik', TRUE);
		$this->db->where('id_tahun_akademik', $id_tahun_akademik);
		$this->db->update($this->tabel, $data);
	}
}