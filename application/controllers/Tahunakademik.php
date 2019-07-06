<?php

class Tahunakademik extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->library('ssp');
            $this->load->model('Model_tahunakademik');
		}
	   function data() {
        $table = 'tbl_thn_akademik';
        $primaryKey = 'id_tahun_akademik';
        $columns = array(
            array('db' => 'id_tahun_akademik', 'dt' => 'id_tahun_akademik'),
            array('db' => 'tahun_akademik', 'dt' => 'tahun_akademik'),
            array('db' => 'is_aktif', 
                  'dt' => 'is_aktif',
                  'formatter' => function($d){
                    return $d=='y'?'Aktif':'Tidak Aktif';
                  }
            ),
            array(
                'db' => 'id_tahun_akademik',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    return anchor('tahunakademik/edit/'.$d,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top"').' '.anchor('tahunakademik/delete/'.$d,'<i class="fa fa-trash"></i>','class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"');
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
    	$this->template->load('template', 'tahunakademik/list');
    }

    function add(){

        if(isset ($_POST['submit'])){
            $this->Model_tahunakademik->save();
            $idUpdateWalikelas = $this->db->insert_id();
            $this->load->model('Model_walikelas');
            $this->Model_walikelas->update($idUpdateWalikelas);
            redirect('tahunakademik');
        } else {
           $this->template->load('template', 'tahunakademik/add'); 
        }
        
    }
    function edit(){
        if(isset($_POST['submit'])){
            $this->Model_tahunakademik->edit();
            redirect('tahunakademik');
        } else {
           $id_tahun_akademik = $this->uri->segment(3);
            $data['tahunakademik'] = $this->db->get_where('tbl_thn_akademik', array('id_tahun_akademik' => $id_tahun_akademik))->row_array();
            $this->template->load('template', 'tahunakademik/edit', $data);
        }
    }
    function delete($id_tahun_akademik){
        $id_tahun_akademik = $this->uri->segment(3);
        if(!empty($id_tahun_akademik)){
            $this->db->where('id_tahun_akademik', $id_tahun_akademik);
            $this->db->delete('tbl_thn_akademik');
        } 
        redirect('tahunakademik');
    }
}