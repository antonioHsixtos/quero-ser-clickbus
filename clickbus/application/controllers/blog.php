<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_CONTROLLER{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Blog_model', 'blog');
	}

	public function main($usuario, $password)
	{
		$data['info'] ['usuario']   = $usuario;
		$data['info'] ['password'] 	= $password;
		$data['title'] 				= 'Blog-CC';
		$data['content'] 			= 'admin_blog/main_blog';
		$this->load->view('frame/content_all', $data);		
	}

	public function get_blog_content()
	{
		$result 		= $this->blog->get_blog_texts();
		$data['data'] 	= (count($result)>0)?$result: 'No hay contenido almacenado';
		$this->load->view('admin_blog/get_blog_content', $data);
	}

	public function add_blog_content()
	{
		$usuario = $this->input->post('usuario');
		$password = $this->input->post('password');
		$category = ($this->input->post('category')=='')?null:$this->input->post('category');
		$title    = ($this->input->post('title')=='')?null:$this->input->post('title');
		$content  = ($this->input->post('content')=='')?null:$this->input->post('content');

		$result = $this->blog->add_blog_texts($usuario, $password, $category, $title, $content);
		if($result == 1)
		{
			echo "Regristro agregado exitosamente";
		}else{
			echo "Ocurrió un error al guardar el registro";
		}
	}

	public function update_blog_content()
	{
		$blog_content_id = $this->input->post('blog_content_id');
		$category = ($this->input->post('category')=='')?null:$this->input->post('category');
		$title    = ($this->input->post('title')=='')?null:$this->input->post('title');
		$content  = ($this->input->post('content')=='')?null:$this->input->post('content');

		$result = $this->blog->update_blog_texts($blog_content_id, $category, $title, $content);
		if($result == 1)
		{
			echo "Regristro actualizado exitosamente";
		}else{
			echo "Ocurrió un error al actualizar el registro";
		}

	}

	public function delete_blog_content()
	{
		$blog_content_id = $this->input->post('blog_content_id');

		$result = $this->blog->update_blog_texts($blog_content_id, null, null, null, 1);
		if($result == 1)
		{
			echo "Regristro borrado exitosamente";
		}else{
			echo "Ocurrió un error al borrar el registro";
		}		
	} 







}