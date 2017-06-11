<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_Level extends CI_Model {
	public function index($kondisi="")
	{
		$data = $this->db->query("SELECT * FROM level ".$kondisi);
		return $data->result_array();
	}
}
