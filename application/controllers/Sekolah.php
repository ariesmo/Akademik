<?php

class Sekolah extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_sekolah');
	}
	function index(){
		if(isset($_POST['submit'])){
			$this->Model_sekolah->update();
			redirect('sekolah');
		} else {
			$data['info'] = $this->db->get_where('tbl_sekolah_info', array('id_sekolah' => 1))->row_array();
			$this->template->load('template', 'info_sekolah', $data);
		}
		
	}
}