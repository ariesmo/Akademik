<?php

class Model_sekolah extends CI_Model{
	public $tabel = 'tbl_sekolah_info';
	function update(){
		$data = array(
			'nama_sekolah'	=> $this->input->post('nama_sekolah', TRUE),
			'alamat_sekolah'=> $this->input->post('alamat_sekolah', TRUE),
			'id_jenjang_sekolah' => $this->input->post('id_jenjang_sekolah', TRUE),	
			'email'			=> $this->input->post('email', TRUE),
			'telepon'		=> $this->input->post('telepon', TRUE)
			
		);
		$id_sekolah		= $this->input->post('id_sekolah', TRUE);
		$this->db->where('id_sekolah', $id_sekolah);
		$this->db->update($this->tabel, $data);
	}
}