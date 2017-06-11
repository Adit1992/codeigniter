<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kota extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('id_pengguna'))
		{
			redirect(site_url());
		}
	}

	public function index()
	{
		$kota = $this->mod_kota->index('INNER JOIN provinsi ON kota.ID_PROVINSI = provinsi.ID_PROVINSI');

		$provinsi = $this->mod_provinsi->index();
		
		$data = array(
			'kota' => $kota,
			'provinsi' => $provinsi
			);

		$this->load->view('head/kota');

		$this->load->view('menu_atas');

		$this->load->view('sidebar');

		$this->load->view('konten/kota',$data);

		$this->load->view('menu_bawah');
		
		$this->load->view('foot/kota');
	}

	public function tambah()
	{
		$nama = $_POST['nama'];
		$provinsi = $_POST['provinsi'];

		$data = array(
			'NAMA_KOTA' => $nama,
			'ID_PROVINSI' => $provinsi
			);

		$data = $this->mod_kota->tambah($data);
		echo json_encode(array('status' => true));

		if ($data > 0)
		{
			$this->session->set_flashdata('pesan','Data berhasil disimpan...!!!');
		}
		else
		{
			$this->session->set_flashdata('pesan','Data gagal disimpan...!!!');
		}

		/*
		if ($data > 0)
		{
			$this->session->set_flashdata('pesan','Tambah data sukses...!!!');
			redirect(site_url('kota'));
		}
		else
		{
			echo "<h1>Tambah data gagal !!!</h1>";
		}
		*/
	}

	public function edit($id)
	{
		$kota = $this->mod_kota->tampil_tertentu($id);

		echo json_encode($kota);
	}

	public function simpan_edit()
	{
		$id = $_POST['id_kota'];
		$nama = $_POST['nama'];
		$provinsi = $_POST['provinsi'];

		$data = array(
			'NAMA_KOTA' => $nama,
			'ID_PROVINSI' => $provinsi
			);

		$kondisi = array('ID_KOTA' => $id);

		$data = $this->mod_kota->perbarui($data,$kondisi);
		echo json_encode(array('status' => true));
		/*
		if ($data > 0)
		{
			$this->session->set_flashdata('pesan','Perbarui data sukses...!!!');
			redirect(base_url('kota'));
		}
		else
		{
			echo "<h1>Perbarui data gagal !!!</h1>";
		}
		*/
	}

	public function hapus($id)
	{
		/*
		$id = array('ID_PENGGUNA' => $id);

		$data = $this->mod_pengguna->hapus($id);

		if ($data > 0)
		{
			$this->session->set_flashdata('pesan','Data berhasil dihapus...!!!');
			redirect(base_url('pengguna'));
		}
		else
		{
			echo "<h1>Hapus data gagal !!!</h1>";
		}
		*/

		$this->mod_kota->hapus($id);
		echo json_encode(array("status" => TRUE));
	}
}
