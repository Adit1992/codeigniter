<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_Login extends CI_Model {
	public function index($kondisi)
	{
		return $this->db->get_where("pengguna",$kondisi);
	}
}
