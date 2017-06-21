<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model', 'login');
	}


	public function get_blog_texts()
	{
		$data = array();
		$query = $this->db->get_where('blog_content', array('deleted_at' => NULL) );
		if($query->num_rows()>0){
			$data =  $query->result();
		}
		return $data;
	}

	public function add_blog_texts($usuario = null, $password = null, $category = null, $title = null, $content = null)
	{
		$data = 0;
		$user_info = $this->login->get_usuario($usuario, $password);
		$query = $this->db->insert('blog_content', array('id_user' => $user_info[0]->id, 'category' => $category,'title' => $title, 'content' => $content, 'created_at' => date('Y-m-d H:i:s')) );
		if($this->db->affected_rows()>0){
			$data =  1;
		}
		return $data;
	}

	public function update_blog_texts($blog_content_id = null, $category = null, $title = null, $content = null, $delete_flag = 0)
	{
		$res = 0;
		$data = ($delete_flag==0)? array( 'category' => $category, 'title' => $title, 'content' => $content, 'updated_at' => date('Y-m-d H:i:s')): array( 'deleted_at' => date('Y-m-d H:i:s') );
		$this->db->where('id', $blog_content_id);
		$this->db->update('blog_content', $data);
		if($this->db->affected_rows()>0){
			$res =  1;
		}
		return $res;
	}

	public function delete_blog_texts($blog_content_id = null)
	{
		$this->db->delete('blog_content', array('blog_content_id' => $blog_content_id));
	}

}