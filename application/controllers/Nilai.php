<?php

class Nilai extends CI_Controller{
	function __construct(){
		parent::__construct();
	
	}
	function index(){
		$sql = "SELECT DISTINCT tj.id_jadwal,tj.id_rombel, tjr.jurusan, tj.kelas, tm.nama_mapel, tr.nama_ruangan, tj.hari, tj.jam
                    FROM tbl_jadwal as tj, tbl_jurusan as tjr, tbl_mapel as tm, tbl_ruangan as tr, tbl_guru as tg
                    WHERE tj.kd_jurusan = tjr.kd_jurusan and tj.kd_mapel = tm.kd_mapel and tj.kd_ruangan = tr.kd_ruangan and tj.id_guru=".$this->session->userdata('id_guru');
        $data['jadwal'] = $this->db->query($sql);
		$this->template->load('template', 'nilai/list_kelas', $data);
	}
	function tambah(){

	}
	function rombel(){
		$id_jadwal = $this->uri->segment(3);
		$jadwal = $this->db->get_where('tbl_jadwal', array('id_jadwal' => $id_jadwal))->row_array();
		$id_rombel = $jadwal['id_rombel'];
		
		$rombel = "SELECT DISTINCT tr.nama_rombel, tr.kelas, j.jurusan, tm.nama_mapel
				FROM tbl_jadwal as tj, tbl_jurusan as j, tbl_mapel as tm, tbl_rombel as tr
				WHERE tj.kd_jurusan = j.kd_jurusan and tj.kd_mapel = tm.kd_mapel and tj.id_rombel = tr.id_rombel and tj.id_jadwal=$id_jadwal ";

		$siswa ="SELECT DISTINCT hk.nim, ts.nama
				FROM tbl_history_kelas as hk, tbl_siswa as ts
				WHERE hk.nim = ts.nim  and hk.id_rombel=$id_rombel and hk.id_tahun_akademik=".get_tahun_akademik_aktif('id_tahun_akademik')." ";
		
		$data['rombel'] = $this->db->query($rombel)->row_array();
		$data['siswa']	= $this->db->query($siswa)->result();
		$this->template->load('template', 'nilai/form_nilai', $data);
	}

	function update_nilai(){
		$nim 		= $_GET['nim'];
		$id_jadwal 	= $_GET['id_jadwal'];
		$nilai 		= $_GET['nilai'];
		
		$params = array('nim' => $nim, 'id_jadwal' => $id_jadwal, 'nilai' => $nilai);

		$where = array('nim' => $nim, 'id_jadwal' => $id_jadwal);
		$check = $this->db->get_where('tbl_nilai', $where);
		if($check->num_rows() > 0){
			$this->db->where('nim', $nim);
			$this->db->where('id_jadwal', $id_jadwal);
			$this->db->update('tbl_nilai', array('nilai' => $nilai));
			echo "data updated";
		} else {
			$this->db->insert('tbl_nilai', $params);
			echo "data inserted";
		}
	}
}