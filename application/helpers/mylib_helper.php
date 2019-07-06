<?php

function cmb_dinamis($name,$table,$field,$pk,$selected=null,$extra=null) {
	$ci =& get_instance();
	$cmb = "<select name='$name' id='$name' class='form-control' $extra>";
	$data = $ci->db->get($table)->result();
	foreach($data as $row){
		$cmb .= "<option value='".$row->$pk."'";
		$cmb .= $selected==$row->$pk?'selected':'';
		$cmb .= ">".$row->$field."</option>";
	}
	$cmb .= "</select>";
	return $cmb;
}

function check_nilai($nim,$id_jadwal){
	$ci =& get_instance();
	$nilai = $ci->db->get_where('tbl_nilai', array('nim' => $nim, 'id_jadwal' => $id_jadwal));
	if($nilai->num_rows() > 0){
		$row = $nilai->row_array();
		return $row['nilai'];
	} else {
		return 0;
	}
}

function get_tahun_akademik_aktif($field){
	$ci =& get_instance();
	$ci->db->where('is_aktif','y');
	$tahun = $ci->db->get('tbl_thn_akademik')->row_array();
	return $tahun[$field];
}

function check_modul(){
	$ci =& get_instance();

	//ambil parameter uri segment
	$controller = $ci->uri->segment(1);
	$method		= $ci->uri->segment(2);

	//cek url
	if(empty($method)){
		$url = $controller;
	} else {
		$url = $controller."/".$method;
	}

	//cek id menu
	$menu 			= $ci->db->get_where('tabel_menu', array('link' => $url))->row_array();
	$level_user 	= $ci->session->userdata('id_level_user');

	if(!empty($level_user)){
		//cek apakah level ini diberikan hak akses atau tidak
		$check 			= $ci->db->get_where('tbl_user_rule', array('id_menu' => $menu['id'], 'id_level_user' => $level_user));
		if($check->num_rows()<1){
			echo "ANDA TIDAK BERHAK AKSES";
			die;
		} 
	} else {
		redirect('auth');
	}
	}

	function Terbilang($x){
		$bil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh","Sebelas");
		if($x < 12){
			return " " . $bil[$x];
		} elseif($x < 20){
			return Terbilang($x - 10) . "belas";
		} elseif($x < 100){
			return Terbilang($x / 10) . "puluh" . Terbilang($x % 10);
		} elseif($x < 200){
			return  "Seratus" . Terbilang($x - 100);
		} elseif($x < 1000){
			return Terbilang($x / 100) . "ratus" . Terbilang($x % 100);
		} elseif($x < 2000){
			return "Seribu" . Terbilang($x - 1000);
		} elseif($x <10000){
			return Terbilang($x / 1000) . "ribu" . Terbilang($x % 1000);
		} elseif($x < 1000000000){
			return Terbilang($x / 1000000) . "juta" . Terbilang($x % 1000000);
		}
	}
	
