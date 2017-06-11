<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_Kota extends CI_Model {
	public function index($kondisi="")
	{
		$data = $this->db->query("SELECT * FROM kota ".$kondisi);
		return $data->result_array();
	}

	public function tampil_tertentu($kondisi)
	{
		# $data = $this->db->query("SELECT * FROM provinsi WHERE ID_PROVINSI = '$kondisi'");
		
		$this->db->from('kota');
		$this->db->where('ID_KOTA',$kondisi);
		$data = $this->db->get();
 		
		return $data->row();
	}

	public function tambah($data)
	{
		$this->db->insert("kota",$data);
		return $this->db->insert_id();
	}

	public function perbarui($data,$kondisi)
	{
		$this->db->update("kota", $data, $kondisi);
		return $this->db->affected_rows();
		/*
		$data = $this->db->update("provinsi",$data,$kondisi);
		return $data;
		*/
	}

	public function hapus($data)
	{
		$this->db->where("ID_KOTA", $data);
		$this->db->delete("kota");

		# $data = $this->db->delete("provinsi",$data);
		# return $data;
	}
}
