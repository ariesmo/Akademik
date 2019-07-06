<?php

class Jadwal extends CI_Controller{
	function __construct(){
			parent::__construct();
			$this->load->library('ssp');
            $this->load->model('Model_jadwal');
		}
	   
    function index(){
        if($this->session->userdata('id_level_user')==3){
            
            $sql = "SELECT DISTINCT tj.id_jadwal, tjr.jurusan, tj.kelas, tm.nama_mapel, tr.nama_ruangan, tj.hari, tj.jam
                    FROM tbl_jadwal as tj, tbl_jurusan as tjr, tbl_mapel as tm, tbl_ruangan as tr, tbl_guru as tg
                    WHERE tj.kd_jurusan = tjr.kd_jurusan and tj.kd_mapel = tm.kd_mapel and tj.kd_ruangan = tr.kd_ruangan and tj.id_guru=".$this->session->userdata('id_guru');
            $data['jadwal'] = $this->db->query($sql);
            $this->template->load('template', 'jadwal/jadwal_ajar_guru', $data);
        } else {
            $infoSekolah = "SELECT DISTINCT js.jumlah_kelas
            FROM tbl_jenjang_sekolah as js, tbl_sekolah_info as si 
            WHERE js.id_jenjang = si.id_jenjang_sekolah";
            $data['info'] = $this->db->query($infoSekolah)->row_array();
            $this->template->load('template', 'jadwal/list', $data); 
        }  
    }

    function generate_jadwal(){
        if(isset($_POST['submit'])){
            $this->Model_jadwal->generateJadwal();
        }
        redirect('jadwal');
    }

    
    function dataJadwal(){
        $kelas      = $_GET['kelas'];
        $kd_jurusan = $_GET['jurusan'];
        $rombel     = $_GET['rombel'];
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
                        <th>MATA PELAJARAN</th>
                        <th>GURU</th>
                        <th>RUANGAN</th>
                        <th>HARI</th>
                        <th>JAM</th>
                        <th>AKSI</th>
                    </tr>
                </thead>";
        $sql = "SELECT tj.id_jadwal,tm.nama_mapel,tg.id_guru,tg.nama_guru,tr.kd_ruangan,tj.hari,tj.jam
                FROM tbl_jadwal as tj, tbl_mapel as tm, tbl_ruangan as tr, tbl_guru as tg
                WHERE tj.kd_mapel = tm.kd_mapel and tj.kd_ruangan = tr.kd_ruangan and tj.id_guru = tg.id_guru and tj.kelas = '$kelas' and tj.kd_jurusan = '$kd_jurusan' and tj.id_rombel = '$rombel'";
        $jadwal = $this->db->query($sql)->result();
        $no=1;
        $jam_pelajaran = $this->Model_jadwal->getJamPelajaran();
        $hari = array(
            'Senin'  => 'Senin',
            'Selasa' => 'Selasa',
            'Rabu'   => 'Rabu',
            'Kamis'  => 'Kamis',
            'Jumat'  => 'Jumat',
            'Sabtu'  => 'Sabtu'
        );
        foreach($jadwal as $row){
            echo "<tr>
                    <td>".$no."</td>
                    <td>".$row->nama_mapel."</td>
                    <td>".cmb_dinamis("guru".$row->id_jadwal."",'tbl_guru','nama_guru','id_guru',$row->id_guru,"onchange='updateGuru(".$row->id_jadwal.")'")."</td>
                    <td>".cmb_dinamis("ruangan".$row->id_jadwal."",'tbl_ruangan','nama_ruangan','kd_ruangan',$row->kd_ruangan,"onchange='updateRuangan(".$row->id_jadwal.")'")."</td>
                    <td>".form_dropdown('hari',$hari,$row->hari,"class='form-control' id='hari".$row->id_jadwal."' onchange='updateHari(".$row->id_jadwal.")'")."</td>
                    <td>".form_dropdown('jam',$jam_pelajaran,$row->jam,"class='form-control' id='jam".$row->id_jadwal."' onchange='updateJam(".$row->id_jadwal.")'")."</td>
                    <td>".anchor('jadwal/deletedetail'."/".$row->id_jadwal, '<i class="fa fa-trash" title="Hapus"></i>','class="btn btn-xs btn-link"')."</td>
                </tr>";
        $no++;
        }
        echo    "</table>";
    }
   function updateGuru(){
        $id_guru = $_GET['id_guru'];
        $id_jadwal = $_GET['id_jadwal'];
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->update('tbl_jadwal', array('id_guru' => $id_guru));
   }
   function updateRuangan(){
        $kd_ruangan = $_GET['kd_ruangan'];
        $id_jadwal = $_GET['id_jadwal'];
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->update('tbl_jadwal', array('kd_ruangan' => $kd_ruangan));
   }
   function updateHari(){
        $hari = $_GET['hari'];
        $id_jadwal = $_GET['id_jadwal'];
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->update('tbl_jadwal', array('hari' => $hari));
   }
   function updateJam(){
        $jam = $_GET['jam'];
        $id_jadwal = $_GET['id_jadwal'];
        $this->db->where('id_jadwal', $id_jadwal);
        $this->db->update('tbl_jadwal', array('jam' => $jam));
   }
   function loadRombel(){
    echo "<select id='rombel' name='rombel' class='form-control' onchange='loadPelajaran()'>";
    $where = array('kd_jurusan'=>$_GET['jurusan'],'kelas'=>$_GET['kelas']);
    $rombel = $this->db->get_where('tbl_rombel',$where);
    foreach ($rombel->result() as $row){
        echo "<option value=".$row->id_rombel.">".$row->nama_rombel."</option>";
    }
    echo "</select>";
   }
   function cetak_jadwal(){
    $rombel = $_POST['rombel'];

    $this->load->library('CFPDF');
    $days = array(
            'Senin'  => 'Senin',
            'Selasa' => 'Selasa',
            'Rabu'   => 'Rabu',
            'Kamis'  => 'Kamis',
            'Jumat'  => 'Jumat',
            'Sabtu'  => 'Sabtu'
        );
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,10,'NO',1,0,'C');
    $pdf->Cell(30,10,'WAKTU',1,0,'C');
    foreach($days as $day) {
        $pdf->Cell(25,10,$day,1,0,'C');
    }
    $pdf->Cell(20,10,'',0,1,'C');
    $jam_pelajaran = $this->Model_jadwal->getJamPelajaran();
    $no=1;
    foreach ($jam_pelajaran as $jam) {
        $pdf->Cell(10,10,$no,1,0,'C');
        $pdf->Cell(30,10,$jam,1,0,'C');
        foreach($days as $day){
            $pdf->Cell(25,10,$this->getPelajaran($jam,$day,$rombel),1,0,'C');
        }
        $pdf->Cell(20,10,'',0,1,'C');
        $no++;
    }
    $pdf->Output();
   }
   function getPelajaran($jam,$hari,$rombel){
        $sql = "SELECT tj.*, tm.nama_mapel
            FROM tbl_jadwal as tj, tbl_mapel as tm
            WHERE tj.kd_mapel = tm.kd_mapel and tj.jam = '$jam' and tj.hari = '$hari' and tj.id_rombel = '$rombel'";
        $pelajaran = $this->db->query($sql);
        if ($pelajaran->num_rows()>0){
            $row = $pelajaran->row_array();
            return $row['nama_mapel'];
        } else {
            return '-';
        }
   }
}