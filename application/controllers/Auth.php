<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index()
	{
		if ($this->session->userdata('email')){
		redirect('user');
	}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == false)
		{
		$data['title'] = 'Login Page';
		$this->load->view('template/auth_header', $data);
		$this->load->view('auth/login');
		$this->load->view('template/auth_footer');
	}
	else{
		//validasi sukses
		$this->_login();
	}
}
private function _login()
{

	$email = $this->input->post('email');
	$password = $this->input->post('password');

	$user = $this->db->get_where('user', ['email' => $email]) -> row_array();
	//user ada
	if($user){
		

		if($user['is_active'] == 1)
		{
			//check password
			if(password_verify($password, $user['password'])) {
				$data = [
					'email' => $user['email'],
					'role_id' => $user['role_id']
				];
				$this->session->set_userdata($data);
				if($user['role_id']==1){
					redirect('admin');
				}
				else{
					redirect('user');
				}
				

			}
			else
				{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
  			Password Salah</div>');
			redirect('auth');
				}
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
  			Email Tidak Teraktivasi</div>');
			redirect('auth');
			}
		
	}
	else
	{
		$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
  			Email Tidak Terdaftar</div>');
			redirect('auth');
	}
}

	public function regist()
	{
		if ($this->session->userdata('email')){
		redirect('user');
	}
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',
			[
				'is_unique' => 'This email is already registered'
			]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]',[
			'matches'=> 'Password dont match'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


		if($this-> form_validation->run() == false){

		$data['title'] = 'WPU User Registration';
		$this->load->view('template/auth_header', $data);
		$this->load->view('auth/regist');
		$this->load->view('template/auth_footer');
		} else {
			$data = [
				'name'=> htmlspecialchars($this->input->post('name', true)),
				'email'=> htmlspecialchars($this->input->post('email', true)),
				'image'=> 'default.jpg',
				'password'=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id'=> 2,
				'is_active'=> 1, 
				'date_created' => time()

			];

			$this->db->insert('user',$data);
			$this->_sendEmail();
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Selamat Data Anda Sudah Terdaftar. Silahkan Login</div>');
			redirect('auth');
		}

	}


	private function _sendEmail ($token, $type) 
	{
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'd1041201027@student.untan.ac.id',
			'smtp_pass' => 'kambing123',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('d1041201027@student.untan.ac.id', 'BOY BOY GEODEVANDRY');
		$this->email->to($this->input->post('email'));


		if ($type == 'forgot')
		{
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password : <a href="'. base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}
		if ($this->email->send()) {
			return true;
		}
		else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function logout ()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('email');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  		Anda sudah keluar </div>');
			redirect('auth');

	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}

	public function forgotPassword()
	{

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if($this->form_validation->run() == false) {
		$data['title'] = 'Forgot Password';
		$this->load->view('template/auth_header', $data);
		$this->load->view('auth/forgot-password');
		$this->load->view('template/auth_footer');
		}

		else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email])->row_array();

			if($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];
				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Please check your email to reset your password</div>');
			redirect('auth/forgotpassword');

			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
  			Email Belum Terdaftar</div>');
			redirect('auth/forgotpassword');
			}

		}
		
	}
	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if($user){

			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if($user_token){
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();	
			}
			else {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
  			Reset Password Gagal! Token Salah</div>');
			redirect('auth');
			}
		}
		else {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
  			Reset Password Gagal! Email Salah</div>');
			redirect('auth');
		}
	}
	public function changePassword() 
	{
		if(!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'trim|required|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|matches[password1]');
		if($this->form_validation->run() == false)
		{
			$data['title'] = 'Change Password';
		$this->load->view('template/auth_header', $data);
		$this->load->view('auth/change-password');
		$this->load->view('template/auth_footer');
		}
		else  {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
  			Password Berhasil diganti Silahkan Login</div>');
			redirect('auth');
		}
	}
}