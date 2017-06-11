<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

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
		$data = $this->mod_perusahaan->index();
		
		$data = array('data' => $data);

		$this->load->view('head/perusahaan');

		$this->load->view('menu_atas');

		$this->load->view('sidebar');

		$this->load->view('konten/perusahaan',$data);

		$this->load->view('menu_bawah');
		
		$this->load->view('foot/perusahaan');
	}

	public function tambah()
	{
		$nama = $_POST['nama'];
		$badan = $_POST['badan'];
		$telepon = $_POST['telepon'];
		$email = $_POST['email'];

		$data = array(
			'NAMA_PERUSAHAAN' => $nama,
			'BADAN_PERUSAHAAN' => $badan,
			'TELEPON_PERUSAHAAN' => $telepon,
			'EMAIL_PERUSAHAAN' => $email
			);

		$data = $this->mod_perusahaan->tambah($data);
		echo json_encode(array('status' => true));

		if ($data > 0)
		{
			$this->session->set_flashdata('pesan','Data berhasil disimpan...!!!');
		}
		else
		{
			$this->session->set_flashdata('pesan','Data gagal disimpan...!!!');
		}
	}

	public function edit()
	{
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$telepon = $_POST['telepon'];
		$email = $_POST['email'];

		if (empty($_POST['sandi']))
		{
			$data = array(
				'NAMA_PENGGUNA' => $nama,
				'TELEPON_PENGGUNA' => $telepon,
				'EMAIL_PENGGUNA' => $email
				);
		}
		else
		{
			$sandi = $_POST['sandi'];
			$data = array(
				'NAMA_PENGGUNA' => $nama,
				'TELEPON_PENGGUNA' => $telepon,
				'EMAIL_PENGGUNA' => $email,
				'SANDI_PENGGUNA' => $sandi
				);
		}

		$kondisi = array('ID_PENGGUNA' => $id);

		$data = $this->mod_pengguna->perbarui($data,$kondisi);

		if ($data > 0)
		{
			$this->session->set_flashdata('pesan','Perbarui data sukses...!!!');
			redirect(base_url('pengguna'));
		}
		else
		{
			echo "<h1>Perbarui data gagal !!!</h1>";
		}
	}

	public function hapus($id)
	{
		$id = array('ID_PERUSAHAAN' => $id);

		$data = $this->mod_perusahaan->hapus($id);
		echo json_encode(array("status" => TRUE));
		/*
		if ($data > 0)
		{
			$this->session->set_flashdata('pesan','Data berhasil dihapus...!!!');
			redirect(base_url('perusahaan'));
		}
		else
		{
			echo "<h1>Hapus data gagal !!!</h1>";
		}
		*/
	}
}
