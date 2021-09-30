<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Auth_Controller {

	function __construct(){
		parent:: __construct();
    }

	public function index(){
		$this->session->sess_destroy();
		$this->load->view('Login');
	}

	public function cek_login() {

		$username = htmlspecialchars_decode($this->input->post('username', TRUE));
		$password = htmlspecialchars_decode($this->input->post('password', TRUE));
		$pass = md5($password);

		$where = array(
			'username' => $username,
			'password' => $pass,
		);

		$hasil = $this->MasterData->getWhereDataAll('tbl_login',$where);

		if ($hasil->num_rows() == 1) {
			$role = $hasil->row()->role;
			$sess_data['id_user'] = $hasil->row()->id_login;
			$sess_data['nama_user'] = $hasil->row()->nama_user;
			$sess_data['username'] = $hasil->row()->username;
			$sess_data['role'] = $role;
			$sess_data['logs'] = 'Sim_extract_'.$role;

			$this->session->set_userdata($sess_data);

			if ($role == 'admin') {
				$link = base_url('Admin');
			} else {
				$link = base_url('Petugas');
			}

			$datas = ['success' => true, 'role' => $role, 'link' => $link];

		} else {
			$datas = ['success' => false];
		}

		echo json_encode($datas);
	}

	public function logout(){
		// Hapus semua data pada session
		$this->session->sess_destroy();

		// redirect ke halaman login	
		redirect('Auth');
	}

}
