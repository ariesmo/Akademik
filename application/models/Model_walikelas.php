<?php

class Model_walikelas extends CI_Model{
	function update($idUpdateWalikelas){

		$rombel = $this->db->get('tbl_rombel');
		foreach($rombel->result() as $row){
			$walikelas = array(
				'id_guru' => 1,
				'id_tahun_akademik' => $idUpdateWalikelas,
				'id_rombel' => $row->id_rombel
			);

			$this->db->insert('tbl_walikelas', $walikelas);

		}
	}
}