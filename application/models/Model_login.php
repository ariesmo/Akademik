<?php

class Model_login extends CI_Model{
	function checkLogin($username,$password){
		$this->db->where('username',$username);
		$this->db->where('password', md5($password));
		$user = $this->db->get('tbl_user')->row_array();
		return $user;
	}
}