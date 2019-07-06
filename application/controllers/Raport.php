<?php

class Raport extends CI_Controller{
	
	function index(){
		
		$walikelas = $this->db->get_where('tbl_walikelas', array('id_guru' => $this->session->userdata('id_guru')))->row_array();

		$id_rombel = $walikelas['id_rombel'];

		
		$rombel = "SELECT DISTINCT tr.nama_rombel, tr.kelas, j.jurusan, tm.nama_mapel, j.kd_jurusan
				FROM tbl_jadwal as tj, tbl_jurusan as j, tbl_mapel as tm, tbl_rombel as tr
				WHERE tj.kd_jurusan = j.kd_jurusan and tj.kd_mapel = tm.kd_mapel and tj.id_rombel =$id_rombel ";
		
		$siswa 	= "SELECT DISTINCT s.nim,s.nama 
					FROM tbl_history_kelas as hk, tbl_siswa as s
					WHERE hk.nim = s.nim and hk.id_rombel = $id_rombel and hk.id_tahun_akademik ='".get_tahun_akademik_aktif('id_tahun_akademik')."'";

		$nis 	="SELECT tr.nama_rombel 
					FROM tbl_siswa as ts, tbl_rombel as tr
					WHERE ts.id_rombel = tr.id_rombel and tr.id_rombel=$id_rombel ";

		$data['rombel'] = $this->db->query($rombel)->row_array();
		$data['siswa']  = $this->db->query($siswa);
		$data['nis'] = $this->db->query($nis)->row_array();
		$this->template->load('template','raport/list_siswa',$data);
	}
	function nilai_semester(){
		$this->load->library('CFPDF');

		$nim   = $this->uri->segment(3);
		$sqlsiswa = "SELECT DISTINCT hk.nim, ts.nama, tr.kelas, tj.jurusan, tr.nama_rombel  
				FROM tbl_history_kelas as hk, tbl_siswa as ts, tbl_rombel as tr, tbl_jurusan as tj
				WHERE hk.nim = ts.nim and hk.id_rombel = tr.id_rombel and tr.kd_jurusan = tj.kd_jurusan and hk.id_tahun_akademik='".get_tahun_akademik_aktif('id_tahun_akademik')."' and hk.nim='$nim'";
		$siswa = $this->db->query($sqlsiswa)->row_array();

		$pdf = new FPDF();
	    $pdf->AddPage();
	    $pdf->SetFont('Arial','B',10);

	    $pdf->Cell(20,5,'NIS',0,0,'L');
	    $pdf->Cell(100,5,': '.$siswa['nim'],0,0,'L');
	    $pdf->Cell(35,5,'KELAS',0,0,'L');
	    $pdf->Cell(35,5,': '.$siswa['nama_rombel'],0,1,'L');

	    $pdf->Cell(20,5,'NAMA',0,0,'L');
	    $pdf->Cell(100,5,': '.$siswa['nama'],0,0,'L');
	    $pdf->Cell(35,5,'TAHUN AJARAN',0,0,'L');
	    $pdf->Cell(35,5,': '.get_tahun_akademik_aktif('tahun_akademik'),0,1,'L');

	    $pdf->Cell(20,5,'JURUSAN',0,0,'L');
	    $pdf->Cell(100,5,': '.$siswa['jurusan'],0,0,'L');
	    $pdf->Cell(35,5,'SEMESTER',0,0,'L');
	    $pdf->Cell(35,5,': '.get_tahun_akademik_aktif('semester_aktif'),0,0,'L');




	    $pdf->Cell(1,15,'',0,1,'C');

	    $pdf->Cell(7,5,'No',1,0,'C');
	    $pdf->Cell(55,5,'Mata Pelajaran',1,0,'C');
	    $pdf->Cell(10,5,'KKM',1,0,'C');
	    $pdf->Cell(15,5,'Angka',1,0,'C');
	    $pdf->Cell(40,5,'Huruf',1,0,'L');
	    $pdf->Cell(40,5,'Ketercapaian',1,0,'C');
	    $pdf->Cell(25,5,'Rata Kelas',1,1,'C');

	    $walikelas = $this->db->get_where('tbl_walikelas', array('id_guru' => $this->session->userdata('id_guru')))->row_array();

		$id_rombel = $walikelas['id_rombel'];
	    $sqlMapel = "SELECT tj.kd_jurusan, tm.nama_mapel, tj.id_jadwal
					 FROM tbl_jadwal as tj, tbl_mapel as tm
					 WHERE tj.kd_mapel = tm.kd_mapel and tj.id_rombel=$id_rombel";
		$mapel = $this->db->query($sqlMapel)->result();
		
		$no=1;
		foreach($mapel as $m){
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(7,5,$no,1,0,'C');
		    $pdf->Cell(55,5,$m->nama_mapel,1,0,'L');
		    $pdf->Cell(10,5,75,1,0,'C');

		    $x = check_nilai($siswa['nim'],$m->id_jadwal);
		    $pdf->Cell(15,5, $x ,1,0,'C');
		    $pdf->Cell(40,5, Terbilang($x) ,1,0,'L');
		    $pdf->Cell(40,5, $this->ketercapaian_kompetensi($x) ,1,0,'C');
		    $pdf->Cell(25,5,ceil($this->rerata_nilai($m->id_jadwal)),1,1,'C');
		$no++;	
		}
		
		// END BLOCK NILAI SISWA --------------------------------
        
        $pdf->Cell(190,5,'',0,1);
        $pdf->Cell(8, 5, 'No', 1,0);
        $pdf->Cell(50, 5, 'Pengembangan Diri', 1,0);
        $pdf->Cell(10, 5, 'Nilai', 1,0);
        $pdf->Cell(66, 5, 'Kepribadian', 1,0);
        $pdf->Cell(20, 5, 'Niilai', 1,0);
        $pdf->Cell(36, 5, 'Catatan Khusus', 1,1);
        
        $pdf->Cell(190,5,'',0,1);
        $pdf->Cell(45, 15, 'Mengetahui,', 0,0,'C');
        $pdf->Cell(87, 5, '', 0,0,'c');
        $pdf->Cell(25, 5, 'Diberikan Di', 0,0,'c');
        $pdf->Cell(33, 5, ': ', 0,1,'L');
        $pdf->Cell(45, 15, 'Orang Tua Wali', 0,0,'C');
        $pdf->Cell(87, 5, '', 0,0,'c');
        $pdf->Cell(25, 5, 'Pada', 0,0,'c');
        $pdf->Cell(33, 5, ': ', 0,1,'L');
        $pdf->Cell(132, 5, '', 0,0,'c');
        $pdf->Cell(25, 5, 'Wali Kelas', 0,0,'c');
        $pdf->Cell(33, 5, ': ', 0,1,'L');

	    $pdf->Output();
	}

	function rerata_nilai($id_jadwal){
		$sql = "SELECT sum(nilai)/count(id_jadwal) as rerata_nilai 
				FROM tbl_nilai 
				WHERE id_jadwal=$id_jadwal";
		$nilai = $this->db->query($sql)->row_array();
		return $nilai['rerata_nilai'];
	}
	function ketercapaian_kompetensi($x){
		if($x > 90){
			return "Sangat Baik";
		} elseif($x > 75 and $x <= 90){
			return "Baik";
		} elseif($x > 60 and $x <= 75){
			return "Cukup";
		} else {
			return "Kurang";
		}
	}
}