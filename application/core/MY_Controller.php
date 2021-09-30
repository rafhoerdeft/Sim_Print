<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
     * Common data
     */
    public $user;
    public $settings;
    public $includes;
    public $current_uri;
    public $theme;
    public $template;
    public $error;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
		// define("assets_url", "https://scn.magelangkab.go.id/backend/modernadmin/");
		define("assets_url", base_url('theme/modern/'));
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('MasterData');
	}

}

		// --------------------------------------------------------------------


class Adm_Controller extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->secure->auth('Sim_extract_admin');
		
		$this->username = $this->session->userdata('username');
		$this->nama_user = $this->session->userdata('nama_user');
		$this->role = $this->session->userdata('role');
		$this->id_logs = $this->session->userdata('id_logs');
	}
}

class Ptgs_Controller extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->secure->auth('Sim_extract_petugas');
		
		$this->username = $this->session->userdata('username');
		$this->nama_user = $this->session->userdata('nama_user');
		$this->role = $this->session->userdata('role');
		$this->id_user = $this->session->userdata('id_user');
	}
}

class Auth_Controller extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
}


/**
	Untuk API
*/
class Api_Controller extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		session_start();
		date_default_timezone_set('Asia/Jakarta');

		$this->load->helper('encrypt');
		$this->load->model('MasterData');
		$this->load->library('session');

		$this->load->helper('auths');

		$keys = "b67637121b047df82bb7648804d5d2ae";
		$user = "magelangkab";

		$cekKey = cek_key($keys, $user);

		if(!$cekKey) {

			$respon = array(
				'response' => "Illegal Access" 
             );		

			echo json_encode($respon);
			exit();
		}
	}

}



