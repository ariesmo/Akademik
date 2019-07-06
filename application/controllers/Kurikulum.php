<?php

class Kurikulum extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->library('ssp');
            $this->load->model('Model_kurikulum');
		}
	   function data() {
        $table = 'tbl_kurikulum';
        $primaryKey = 'id_kurikulum';
        $columns = array(
            array('db' => 'id_kurikulum', 'dt' => 'id_kurikulum'),
            array('db' => 'nama_kurikulum', 'dt' => 'nama_kurikulum'),
            array('db' => 'is_aktif', 
                  'dt' => 'is_aktif',
                  'formatter' => function($d){
                    return $d=='y'?'Aktif':'Tidak Aktif';
                  }
            ),
            array(
                'db' => 'id_kurikulum',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    return anchor('kurikulum/edit/'.$d,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top"').' '.anchor('kurikulum/delete/'.$d,'<i class="fa fa-trash"></i>','class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"').' '.anchor('kurikulum/detail/'.$d,'<i class="fa fa-eye"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top"');
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
    	$this->template->load('template', 'kurikulum/list');
    }

    function add(){

        if(isset ($_POST['submit'])){
            $this->Model_kurikulum->save();
            redirect('kurikulum');
        } else {
           $this->template->load('template', 'kurikulum/add'); 
        }
        
    }
    function edit(){
        if(isset($_POST['submit'])){
            $this->Model_kurikulum->edit();
            redirect('kurikulum');
        } else {
           $id_kurikulum = $this->uri->segment(3);
            $data['kurikulum'] = $this->db->get_where('tbl_kurikulum', array('id_kurikulum' => $id_kurikulum))->row_array();
            $this->template->load('template', 'kurikulum/edit', $data);
        }
    }
    function delete($id_kurikulum){
        $id_kurikulum = $this->uri->segment(3);
        if(!empty($id_kurikulum)){
            $this->db->where('id_kurikulum', $id_kurikulum);
            $this->db->delete('tbl_kurikulum');
        } 
        redirect('kurikulum');
    }
    function detail(){
        $kelas = "SELECT js.jumlah_kelas
        FROM tbl_jenjang_sekolah as js, tbl_sekolah_info as si 
        WHERE js.id_jenjang = si.id_jenjang_sekolah";
        $data['info'] = $this->db->query($kelas)->row_array();
        $this->template->load('template', 'kurikulum/detail', $data);
    }
    function kurikulumDetail(){
        $kelas      = $_GET['kelas'];
        $kd_jurusan = $_GET['jurusan'];
        $id_kurikulum = $_GET['id_kurikulum'];

        if($kelas == 'semua_kelas'){
            $selected_kelas = '';
        } else {
            $selected_kelas= "and kd.kelas ='$kelas'";
        }
        echo "<table class='table table-striped table-bordered table-hover table-full-width dataTable' cellspacing='0' width='100%''>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>KODE MAPEL</th>
                        <th>NAMA MAPEL</th>
                        <th>KELAS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>";
        $sql = "SELECT tj.jurusan, kd.kd_mapel, tm.nama_mapel, kd.kelas, kd.id_kurikulum_detail, kd.id_kurikulum
                FROM tbl_kurikulum_detail as kd, tbl_kurikulum as tk, tbl_mapel as tm, tbl_jurusan as tj 
                WHERE kd.id_kurikulum = tk.id_kurikulum and kd.kd_mapel = tm.kd_mapel and kd.kd_jurusan = tj.kd_jurusan $selected_kelas and kd.id_kurikulum = '$id_kurikulum' and kd.kd_jurusan='$kd_jurusan'";
        $kurikulum = $this->db->query($sql)->result();
        $no=1;
        foreach($kurikulum as $row){
            echo "<tr>
                    <td>".$no."</td>
                    <td>".$row->kd_mapel."</td>
                    <td>".$row->nama_mapel."</td>
                    <td>".$row->kelas."</td>
                    <td>".anchor('kurikulum/deletedetail'."/".$row->id_kurikulum_detail."/".$row->id_kurikulum, '<i class="fa fa-trash" title="Hapus"></i>','class="btn btn-xs btn-link"')."</td>
                </tr>";
        $no++;
        }
        echo    "</table>";
    }
    function addDetail(){
        if(isset($_POST['submit'])){
            $this->Model_kurikulum->addKurikulumDetail();
            redirect('kurikulum/detail/'.$this->input->post('id_kurikulum'));
        } else {
            $kelas = "SELECT js.jumlah_kelas
            FROM tbl_jenjang_sekolah as js, tbl_sekolah_info as si 
            WHERE js.id_jenjang = si.id_jenjang_sekolah";
        $data['info'] = $this->db->query($kelas)->row_array();
        $this->template->load('template', 'kurikulum/adddetail', $data);
        }

        
    }
    function deletedetail(){
        $id_kurikulum_detail = $this->uri->segment(3);
        $id_kurikulum        = $this->uri->segment(4);
        if(!empty($id_kurikulum_detail)){
            $this->db->where('id_kurikulum_detail', $id_kurikulum_detail);
            $this->db->delete('tbl_kurikulum_detail');
        } 
        redirect('kurikulum/detail/'.$id_kurikulum);
    }


}