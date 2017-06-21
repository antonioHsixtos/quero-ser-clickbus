<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model', 'login');
	}

	public function index()
	{
		$data['title']   = 'BLOG';
		$data['content'] = 'login/index'; 
		$this->load->view('frame/content_all', $data);
	}

	public function sign_in()
	{
		$usuario    = $this->input->post('usuario');
		$password   = $this->input->post('password');
		$datos 		= $this->validacionDatos($usuario, $password);
		if(count($datos)>0){
			echo "Ingresando...";
		}else{
			echo "El usuario no existe, favor de verificar";
		}
	}

	public function sign_up()
	{
		$usuario  = $this->input->post('usuario');
		$password = $this->input->post('password');
		$validacion = $this->validacionUsuario($usuario);
		if($validacion==0){
			$this->login->add_usuario($usuario, $password);
			$datos = $this->validacionDatos($usuario, $password);
			echo "Usuario agregado existosamete";
		}else{
			echo "El usuario ya existe, elige otro";
		}
	}

	public function validacionDatos($usuario = null, $password = null)
	{
		$result = $this->login->get_usuario($usuario, $password);
		return $result;
	}

	public function validacionUsuario($usuario = null)
	{
		$result = $this->login->valida_usuario($usuario);
		return $result;
	}
}
