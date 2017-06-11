<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('id_pengguna'))
		{
			redirect(base_url());
		}
	}

	public function index()
	{
     	$this->load->view('head/header');

		$this->load->view('menu_atas');

		$this->load->view('sidebar');

		$this->load->view('konten/beranda');
		
		$this->load->view('foot/footer');
	}
}
