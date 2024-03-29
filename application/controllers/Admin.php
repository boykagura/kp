<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{

	public function __construct ()
	{
		parent::__construct();
		is_logged_in();

	}
	public function index ()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();

		$data['data_admin'] = $this->admin_model->getDb();
		//contoh

		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('admin/index' , $data);
		$this->load-> view('template/footer');
	}

		public function role ()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();

		$data['role']= $this->db->get('user_role')->result_array();

		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('admin/role' , $data);
		$this->load-> view('template/footer');
	}

	public function roleAccess($role_id)
	{
		$data['title'] = 'Role access';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();

		$data['role']= $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->db->where ('id !=', 1);

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('admin/role-access' , $data);
		$this->load-> view('template/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [ 
			'role_id' => $role_id,
			'menu_id' => $menu_id
			];

			$result = $this->db->get_where('user_access_menu', $data);

			if($result->num_rows() < 1 ){
				$this->db->insert('user_access_menu', $data);
			}
			else {
				$this->db->delete('user_access_menu', $data);
			}
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Access Changes</div>');

  			// redirect('admin/redirect/'. $role_id);
	}

	public function deleteRole($id) 
	{
	
		$this->db->where('id', $id);
		$this->db->delete('user_role');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Data Berhasil Dihapus</div>');
		redirect('admin/role');
		
	}
	public function deleteUser($id)
	{

		$data['data_admin'] = $this->admin_model->deleteUser($id);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Data Berhasil Dihapus</div>');
		redirect('admin/index');


	}
}