<?php

class Ruangan extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->library('ssp');
            $this->load->model('Model_ruangan');
		}
	   function data() {
        $table = 'tbl_ruangan';
        $primaryKey = 'kd_ruangan';
        $columns = array(
            array('db' => 'kd_ruangan', 'dt' => 'kd_ruangan'),
            array('db' => 'nama_ruangan', 'dt' => 'nama_ruangan'),
            array(
                'db' => 'kd_ruangan',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    return anchor('ruangan/edit/'.$d,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top"').' '.anchor('ruangan/delete/'.$d,'<i class="fa fa-trash"></i>','class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"');
                }
            )
        );
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
 
        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    function index(){
    	$this->template->load('template', 'ruangan/list');
    }

    function add(){

        if(isset ($_POST['submit'])){
            $this->Model_ruangan->save();
            redirect('ruangan');
        } else {
           $this->template->load('template', 'ruangan/add'); 
        }
        
    }
    function edit(){
        if(isset($_POST['submit'])){
            $this->Model_ruangan->edit();
            redirect('ruangan');
        } else {
           $kd_ruangan = $this->uri->segment(3);
            $data['ruangan'] = $this->db->get_where('tbl_ruangan', array('kd_ruangan' => $kd_ruangan))->row_array();
            $this->template->load('template', 'ruangan/edit', $data);
        }
    }
    function delete($kd_ruangan){
        $kd_ruangan = $this->uri->segment(3);
        if(!empty($kd_ruangan)){
            $this->db->where('kd_ruangan', $kd_ruangan);
            $this->db->delete('tbl_ruangan');
        } 
        redirect('ruangan');
    }
}