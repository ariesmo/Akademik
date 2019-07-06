<?php

class Menu extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->library('ssp');
            $this->load->model('Model_menu');
		}
	   function data() {
        $table = 'tabel_menu';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'id', 'dt' => 'id'),
            array('db' => 'judul_menu', 'dt' => 'judul_menu'),
            array('db' => 'link', 'dt' => 'link'),
            array(
                'db' => 'is_main_menu',
                'dt' => 'is_main_menu',
                'formatter' => function( $d) {
                    return $d==0?'MAIN MENU':'SUB MENU';
                }
            ),
            array(
                'db' => 'id',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    return anchor('menu/edit/'.$d,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top"').' '.anchor('menu/delete/'.$d,'<i class="fa fa-trash"></i>','class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"');
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
    	$this->template->load('template', 'menu/list');
    }

    function add(){

        if(isset ($_POST['submit'])){
            $this->Model_menu->save();
            redirect('menu');
        } else {
           $this->template->load('template', 'menu/add'); 
        }
        
    }
    function edit(){
        if(isset($_POST['submit'])){
            $this->Model_menu->edit();
            redirect('menu');
        } else {
            $id = $this->uri->segment(3);
            $data['menu'] = $this->db->get_where('tabel_menu', array('id' => $id))->row_array();
            $this->template->load('template', 'menu/edit', $data);
        }
    }
    function delete($kd_mapel){
        $id = $this->uri->segment(3);
        if(!empty($id)){
            $this->db->where('id', $id);
            $this->db->delete('tabel_menu');
        } 
        redirect('menu');
    }
}