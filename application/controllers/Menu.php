<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
	public function __construct ()
	{
		parent::__construct();
		is_logged_in();
		

	}

	public function index () {
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if($this->form_validation->run() == false) {

		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('menu/index' , $data);
		$this->load-> view('template/footer');


		} else {
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			New Menu added</div>');
			redirect('menu');
			}
		}


		public function submenu() {

		$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where ('user', ['email' => 
		$this -> session->userdata('email')])->row_array();
		$this->load->model('Menu_model', 'menu');
		

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();


		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('icon', 'icon', 'required');

		if($this->form_validation->run() == false ) {
		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('menu/submenu' , $data);
		$this->load-> view('template/footer');
	
		}
		else {
			$data = [

				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			New Sub Menu added</div>');
			redirect('menu/submenu');
		}
		}
		public function pertanyaan(){
		$data['title'] = 'Pertanyaan';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();
		$data['data_pertanyaan'] = $this->pertanyaan_model->getPertanyaan();
		$data['kategori'] = $this->db->get_where('tbl_kategori')->result_array();



		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('menu/pertanyaan' , $data);
		$this->load-> view('template/footer');
		}

		public function tambahPertanyaan()
		{
			$pertanyaan = $this->input->post('pertanyaan');
			$id_kategori = $this->input->post('id_kategori');

			$data = ['pertanyaan' => $pertanyaan, 'id_kategori' => $id_kategori];

			$this->pertanyaan_model->insertData($data, 'tbl_pertanyaan');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Pertanyaan berhasil disimpan</div>');

			redirect('menu/pertanyaan');
		}

		public function deletePertanyaan ($id) {

		$data['data_pertanyaan'] = $this->pertanyaan_model->deletePertanyaan($id);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  		Data Berhasil Dihapus</div>');
		redirect('menu/pertanyaan');
		}

		public function indexEdit ($id) {
		$data['title'] = 'Edit Pertanyaan';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();

		$data['pertanyaan'] = $this->db->get_where('tbl_pertanyaan', ['id'=>$id])->row_array();



		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('menu/editpertanyaan' , $data);
		$this->load-> view('template/footer');
		}

		

		public function editPertanyaan($id) {
		$data['title'] = 'Edit Pertanyaan';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();

			$pertanyaan = $this->input->post('pertanyaan');
			$id_kategori = $this->input->post('id_kategori');

			$data = ['pertanyaan' => $pertanyaan,
					 'id_kategori' => $id_kategori
					];

		$this->pertanyaan_model->editPertanyaan($id, $data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Profile anda sudah terupdate</div>');
			redirect('menu/pertanyaan');
		}

		public function jawaban(){
		$data['title'] = 'Jawaban';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();
		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('menu/jawaban' , $data);
		$this->load-> view('template/footer');
		}
		

		public function pilihan($id) {

		$data['pertanyaan'] = $this->db->get_where('tbl_pertanyaan', ['id' => $id])->row_array();
		$data['title'] = 'Pilihan '.$data['pertanyaan']['pertanyaan'];
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();
		$data['data_pilihan'] = $this->db->get_where('tbl_pilihan', ['id_pertanyaan' => $id])->result_array();

		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('menu/pilihan' , $data);
		$this->load-> view('template/footer');
		}
		public function deletePilihan ($id, $id_pertanyaan) {

		$data['data_pilihan'] = $this->pilihan_model->deletePilihan($id);


		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  		Data Berhasil Dihapus</div>');
		redirect('menu/pilihan/'. $id_pertanyaan);
		}

		public function addPilihan (){
			$pilihan = $this->input->post('pilihan');
			$id_pertanyaan = $this->input->post('id_pertanyaan');
			$lainnya = $this->input->post('lainnya');
			if($lainnya == 'on'){
				$lainnya2 = 1;
			}else{
				$lainnya2 = 0;
			}
			
			$data = ['pilihan' => $pilihan, 'id_pertanyaan' => $id_pertanyaan, 'lainnya' => $lainnya2];

			$this->pilihan_model->insertData($data, 'tbl_pilihan');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Pertanyaan berhasil disimpan</div>');

			redirect('menu/pilihan/'.$id_pertanyaan );
		}
		public function indexPilihan ($id) {
		$data['title'] = 'Edit Pilihan ';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();

		$data['pilihan'] = $this->db->get_where('tbl_pilihan', ['id'=>$id])->row_array();



		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('menu/editpilihan' , $data);
		$this->load-> view('template/footer');
		}
		public function pilihanEdit ($id) {
		$data['title'] = 'Edit Pilihan';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();

			$pilihan = $this->input->post('pilihan');
			$id_pertanyaan = $this->input->post('id_pertanyaan');
			$lainnya = $this->input->post('lainnya');
			if($lainnya == 'on'){
				$lainnya2 = 1;
			}else{
				$lainnya2 = 0;
			}

			$data = ['pilihan' => $pilihan,
					 'id_pertanyaan' => $id_pertanyaan,
					 'lainnya' => $lainnya2
					];

		$this->pilihan_model->editPilihan($id, $data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Profile anda sudah terupdate</div>');
			redirect('menu/pilihan/'.$id_pertanyaan);
		}
		

		public function kategori(){

		$data['title'] = 'Kategori';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();
		$data['data_kategori'] = $this->kategori_model->getKategori();
		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('menu/kategori' , $data);
		$this->load-> view('template/footer');
		}
		public function tambahKategori()
		{
			$kategori = $this->input->post('kategori');
			

			$data = ['kategori' => $kategori
					];


			$this->kategori_model->insertKategori($data, 'tbl_kategori');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Pertanyaan berhasil disimpan</div>');

			redirect('menu/kategori');
		}
		public function indexKategori ($id) {
		$data['title'] = 'Edit Kategori ';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();

		$data['kategori'] = $this->db->get_where('tbl_kategori', ['id'=>$id])->row_array();



		$this->load-> view('template/header' , $data);
		$this->load-> view('template/sidebar' , $data);
		$this->load-> view('template/topbar' , $data);
		$this->load-> view('menu/editkategori' , $data);
		$this->load-> view('template/footer');
		}
		public function kategoriEdit ($id) {
		$data['title'] = 'Edit Kategori';
		$data['user'] = $this->db->get_where ('user', ['email' => $this -> session->userdata('email')])->row_array();

			$kategori = $this->input->post('kategori');

			$data = ['kategori' => $kategori
					];

		$this->kategori_model->editkategori($id, $data);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Profile anda sudah terupdate</div>');
			redirect('menu/kategori');
		}


		public function deleteKategori ($id){

		$data['data_kategori'] = $this->kategori_model->deleteKategori($id);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  		Data Berhasil Dihapus</div>');
		redirect('menu/kategori');
			}


		}
