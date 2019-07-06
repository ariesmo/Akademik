<?php

class Users extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->library('ssp');
            $this->load->model('Model_users');
		}
	   function data() {
        $table = 'v_tbl_user';
        $primaryKey = 'id_user';
        $columns = array(
            array('db' => 'id_user', 'dt' => 'id_user'),
            array('db' => 'nama_lengkap', 'dt' => 'nama_lengkap'),
            array('db' => 'nama_level', 'dt' => 'nama_level'),
            array(
                'db' => 'id_user',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    return anchor('users/edit/'.$d,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top"').' '.anchor('users/delete/'.$d,'<i class="fa fa-trash"></i>','class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"');
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
    	$this->template->load('template', 'users/list');
    }

    function add(){

        if(isset ($_POST['submit'])){
            $uploadFoto = $this->upload_foto_siswa();
            $this->Model_users->save($uploadFoto);
            redirect('users');
        } else {
           $this->template->load('template', 'users/add'); 
        }
        
    }
    function edit(){
        if(isset($_POST['submit'])){
            $uploadFoto = $this->upload_foto_siswa();
            $this->Model_users->edit($uploadFoto);
            redirect('users');
        } else {
            $id_user = $this->uri->segment(3);
            $data['users'] = $this->db->get_where('tbl_user', array('id_user' => $id_user))->row_array();
            $this->template->load('template', 'users/edit', $data);
        }
    }
    function delete($kd_mapel){
        $id_user = $this->uri->segment(3);
        if(!empty($id_user)){
            $this->db->where('id_user', $id_user);
            $this->db->delete('tbl_user');
        } 
        redirect('users');
    }
    function upload_foto_siswa(){
        $config['upload_path']   = './uploads/foto_user/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 10000;
        $this->load->library('upload', $config);
        //proses upload
        
        $this->upload->do_upload('userfile');
        $upload = $this->upload->data();
        return $upload['file_name'];

    }
    function rule(){
        $this->template->load('template', 'users/rule');
    }
    function modul(){
        $level_user = $_GET['level_user'];
        echo "<table class='table table-striped table-bordered table-hover table-full-width dataTable'>
                                            <thead>
                                                <tr>
                                                    <td align='center'>NO</td>
                                                    <td align='center'>NAMA MODULE</td>
                                                    <td align='center'>LINK</td>
                                                    <td align='center'>HAK AKSES</td>
                                                </tr>
                                            </thead>
                                            <tbody>";
        $no=1;                                    
        $modul = $this->db->get('tabel_menu');
        foreach($modul->result() as $row){
            echo "<tr>
                    <td width='10'>$no</td>
                    <td>".strtoupper($row->judul_menu)."</td>
                    <td>".$row->link."</td>
                    <td align='center' width='50'><input type='checkbox' name='hak_akses' ";
                    $this->check_data($level_user,$row->id);
                    echo "onclick='loadRule($row->id)'></td>
                 </tr>";
        $no++;
        }
                                                
        echo "</tbody>
            </table>";
    }
    function check_data($level_user,$id_menu){
        $data = array('id_level_user' => $level_user, 'id_menu' => $id_menu);
        $check = $this->db->get_where('tbl_user_rule', $data);
        if($check->num_rows()>0){
            echo "Checked='checked'";

        }
    }
    function addRule(){
        $level_user  = $_GET['level_user'];
        $id_menu     = $_GET['id_menu'];
        $data = array('id_level_user' => $level_user, 'id_menu' => $id_menu);
        $check = $this->db->get_where('tbl_user_rule', $data);
        if($check->num_rows()<1){
            $this->db->insert('tbl_user_rule', $data);
        } else {
            $this->db->where('id_level_user', $level_user);
            $this->db->where('id_menu', $id_menu);
            $this->db->delete('tbl_user_rule');
        }

    }
}