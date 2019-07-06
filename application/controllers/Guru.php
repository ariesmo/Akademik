<?php

class Guru extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->library('ssp');
            $this->load->model('Model_guru');
		}
	   function data() {
        $table = 'tbl_guru';
        $primaryKey = 'id_guru';
        $columns = array(
            array('db' => 'id_guru', 'dt' => 'id_guru'),
            array('db' => 'nuptk', 'dt' => 'nuptk'),
            array('db' => 'nama_guru', 'dt' => 'nama_guru'),
            array('db' => 'gender', 
                  'dt' => 'gender',
                  'formatter' => function( $d) {
                    return $d=='P'?'Pria' : 'Wanita';
                }
            ),
            array(
                'db' => 'id_guru',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    return anchor('guru/edit/'.$d,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top"').' '.anchor('guru/delete/'.$d,'<i class="fa fa-trash"></i>','class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"');
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
    	$this->template->load('template', 'guru/list');
    }

    function add(){

        if(isset ($_POST['submit'])){
            $this->Model_guru->save();
            redirect('guru');
        } else {
           $this->template->load('template', 'guru/add'); 
        }
        
    }
    function edit(){
        if(isset($_POST['submit'])){
            $this->Model_guru->edit();
            redirect('guru');
        } else {
           $id_guru = $this->uri->segment(3);
            $data['guru'] = $this->db->get_where('tbl_guru', array('id_guru' => $id_guru))->row_array();
            $this->template->load('template', 'guru/edit', $data);
        }
    }
    function delete($id_guru){
        $id_guru = $this->uri->segment(3);
        if(!empty($id_guru)){
            $this->db->where('id_guru', $id_guru);
            $this->db->delete('tbl_guru');
        } 
        redirect('guru');
    }
}