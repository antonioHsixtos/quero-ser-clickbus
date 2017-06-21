<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('encrypt');
	}

	public function get_usuario($usuario, $password){

		$data = array();
		$new_password = sha1($password);
		$query = $this->db->get_where('user', array('username' => $usuario, 'password' => $new_password) );
		if($query->num_rows()>0){
			$data =  $query->result();
		}
		return $data;
	}

	public function add_usuario($usuario, $password){

		$data = 0;
		$new_password = sha1($password);
		$query = $this->db->insert('user', array('username' => $usuario, 'password' => $new_password, 'created_at' => date('Y-m-d H:i:s')) );
		if($this->db->affected_rows()>0){
			$data =  1;
		}
		return $data;
	}

	public function valida_usuario($usuario){

		$query = $this->db->get_where('user', array('username' => $usuario) );
		return  $query->num_rows();
	
	}

}
