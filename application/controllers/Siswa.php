<?php

class Siswa extends CI_Controller{
		function __construct(){
			parent::__construct();
			$this->load->library('ssp');
            $this->load->model('Model_siswa');
		}
	   function data() {
        $table = 'tbl_siswa';
        $primaryKey = 'nim';
        $columns = array(
        	array('db' => 'foto', 
        		  'dt' => 'foto',
        		  'formatter' => function($d) {
                    if(empty($d)){
                        return "<img width='30px' src='". base_url()."/uploads/gbr1.jpg'>";
                    } else {
                        return "<img width='30px' src='". base_url()."/uploads/foto_siswa/".$d."'>";
                    }
                }
        	),
            array('db' => 'nim', 'dt' => 'nim'),
            array('db' => 'nama', 'dt' => 'nama'),
            array('db' => 'tempat_lahir', 'dt' => 'tempat_lahir'),
            array('db' => 'tanggal_lahir', 'dt' => 'tanggal_lahir'),
            array(
                'db' => 'nim',
                'dt' => 'aksi',
                'formatter' => function( $d) {
                    return anchor('siswa/edit/'.$d,'<i class="fa fa-edit"></i>','class="btn btn-xs btn-teal tooltips" data-placement="top"').' '.anchor('siswa/delete/'.$d,'<i class="fa fa-trash"></i>','class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remove"');
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
    	$this->template->load('template', 'siswa/list');
    }

    function add(){

        if(isset ($_POST['submit'])){
            $uploadFoto = $this->upload_foto_siswa();
            $this->Model_siswa->save($uploadFoto);
            redirect('siswa');
        } else {
           $this->template->load('template', 'siswa/add'); 
        }
        
    }
    function edit(){
        if(isset($_POST['submit'])){
            $uploadFoto = $this->upload_foto_siswa();
            $this->Model_siswa->update($uploadFoto);
            redirect('siswa');
        } else {
            $nim = $this->uri->segment(3);
            $data['siswa'] = $this->db->get_where('tbl_siswa', array('nim' => $nim))->row_array();
            $this->template->load('template', 'siswa/edit', $data);
        }
    }
    function delete($nim){
        $nim = $this->uri->segment(3);
        if(!empty($nim)){
            $this->db->where('nim', $nim);
            $this->db->delete('tbl_siswa');
        } 
        redirect('siswa');
    }
    function upload_foto_siswa(){
        $config['upload_path']   = './uploads/foto_siswa/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 10000;
        $this->load->library('upload', $config);
        //proses upload
        
        $this->upload->do_upload('userfile');
        $upload = $this->upload->data();
        return $upload['file_name'];

    }
    function siswa_aktif(){
        
        $this->template->load('template','siswa/siswa_aktif');
    }
    function show_siswa_by_rombel(){
        $kirim = $_GET['rombel'];
        echo "<table class='table table-striped table-bordered table-hover table-full-width dataTable' cellspacing='0' width='100%''>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIM</th>
                    <th>NAMA</th>
                </tr>
            </thead>";
        $this->db->where('id_rombel', $kirim);
        $rombel = $this->db->get('tbl_siswa');
        $no=1;
        foreach($rombel->result() as $row){
            echo "<tr><td>".$no."</td><td>".$row->nim."</td><td>".$row->nama."</td></tr>";
        $no++;
        }
        echo "</table>";
    }
    function data_by_rombel_excel(){
        $this->load->library('CPHP_excel');

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'NO');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'NIM');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'NAMA');

        $kirim = $_POST['rombel'];
        $this->db->where('id_rombel', $kirim);
        $rombel = $this->db->get('tbl_siswa');
        $no=2;
        foreach($rombel->result() as $row){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$no, $no-1);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $row->nim);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$no, $row->nama);
        $no++;
        }
       
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
        $objWriter->save("datasiswa.xlsx");
        $this->load->helper('download');
        force_download('datasiswa.xlsx', NULL);
    }
    
}