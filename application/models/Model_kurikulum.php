<?php

class Model_kurikulum extends CI_Model{
	public $tabel = 'tbl_kurikulum';
	function save(){
		$data = array(
			'id_kurikulum'	=> $this->input->post('id_kurikulum', TRUE),
			'nama_kurikulum'=> $this->input->post('nama_kurikulum', TRUE),
			'is_aktif'=> $this->input->post('is_aktif', TRUE)
		);
		$this->db->insert($this->tabel, $data);

	}
	function edit(){
		$data = array(
			'nama_kurikulum'=> $this->input->post('nama_kurikulum', TRUE),
			'is_aktif'=> $this->input->post('is_aktif', TRUE)
		);
		$id_kurikulum		= $this->input->post('id_kurikulum', TRUE);
		$this->db->where('id_kurikulum', $id_kurikulum);
		$this->db->update($this->tabel, $data);
	}
	function addKurikulumDetail(){
		$data = array(
			'id_kurikulum'=> $this->input->post('id_kurikulum', TRUE),
			'kd_mapel'=> $this->input->post('kd_mapel', TRUE),
			'kd_jurusan'   => $this->input->post('jurusan', TRUE),
			'kelas'	  	=> $this->input->post('kelas', TRUE)
		);
		$id_kurikulum_detail = $this->input->post('id_kurikulum_detail', TRUE);
		$this->db->insert('tbl_kurikulum_detail', $data);
	}
}