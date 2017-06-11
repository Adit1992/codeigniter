<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_Pengguna extends CI_Model {
	public function index($kondisi="")
	{
		$data = $this->db->query("SELECT * FROM pengguna ".$kondisi);
		return $data->result_array();
	}

	public function tambah($data)
	{
		$data = $this->db->insert("pengguna",$data);
		return $data;
	}

	public function perbarui($data,$kondisi)
	{
		$data = $this->db->update("pengguna",$data,$kondisi);
		return $data;
	}

	public function hapus($data)
	{
		$data = $this->db->delete("pengguna",$data);
		return $data;
	}
}
