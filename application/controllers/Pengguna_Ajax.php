<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_Ajax extends CI_Controller {

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
		$level = $this->mod_level->index();

		$pengguna = $this->mod_pengguna->index('INNER JOIN level ON pengguna.ID_LEVEL = level.ID_LEVEL');
		
		$data = array(
			'level' => $level,
			'pengguna' => $pengguna
			);

		$this->load->view('head/header');

		$this->load->view('menu_atas');

		$this->load->view('sidebar');

		$this->load->view('konten/pengguna_ajax',$data);
		
		$this->load->view('foot/footer');
	}

	public function tambah()
	{
		$nama 		= $_POST['nama'];
		$level 		= $_POST['level'];
		$sandi 		= $_POST['sandi'];
		$foto 		= $_FILES['foto']['name'];
		$file_ext	= strtolower(end(explode('.', $foto)));

		# ================= Gambar ================= #
		$stamp = date("his") ; $ip = $_SERVER['REMOTE_ADDR'] ;
		$id = "$ip-$stamp" ; $id = str_replace(":","",$id) ; $id = str_replace("-","",$id) ;
		$nama_file = "$ip-$stamp" ; $nama_file = str_replace(":","",$nama_file) ;
		
		$config['upload_path']          = './gambar/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 1000; # maksimum besar file 1M
		$config['max_width']            = 1024; # lebar maksimum 1000 px
		$config['max_height']           = 1024; # tinggi maksimum 1000 px
		$config['file_name']			= $nama_file; # rename gambar
 
		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload()) { # cek apakah ada file yg diupload
			$status = array('status' => false, 'msg' => $this->upload->display_errors());
		} else {
			$file = $this->upload->data();
			// pura-puranya disini ada sebuah proses mengenai file yg d upload.
			$status = array(
				'ID_PENGGUNA' => $id,
				'NAMA_PENGGUNA' => $nama,
				'ID_LEVEL' => $level,
				'SANDI_PENGGUNA' => $sandi,
				'FOTO_PENGGUNA' => $nama_file.".".$file_ext,
				'status' => true
				);
		}

		$data = $this->mod_pengguna->tambah($data);

		echo json_encode($status);

		if ($data > 0)
		{
			$this->session->set_flashdata('pesan','Data berhasil disimpan...!!!');
		}
		else
		{
			$this->session->set_flashdata('pesan','Data gagal disimpan...!!!');
		}

		// if (!$this->upload->do_upload('foto'))
		// {
		// 	echo "<h1>Tambah gambar gagal !!!</h1>";
		// }
		// else
		// {
		// 	# $this->db->set('ID_PENGGUNA','UUID()',FALSE);

		// 	$data = array(
		// 		'ID_PENGGUNA' => $id,
		// 		'NAMA_PENGGUNA' => $nama,
		// 		'ID_LEVEL' => $level,
		// 		'SANDI_PENGGUNA' => $sandi,
		// 		'FOTO_PENGGUNA' => $nama_file.".".$file_ext
		// 		);

		// 	$data = $this->mod_pengguna->tambah($data);

		// 	echo json_encode(array('status' => true));

		// 	if ($data > 0)
		// 	{
		// 		$this->session->set_flashdata('pesan','Data berhasil disimpan...!!!');
		// 	}
		// 	else
		// 	{
		// 		$this->session->set_flashdata('pesan','Data gagal disimpan...!!!');
		// 	}
		// }

	}

	public function edit($id)
	{
		$data = $this->mod_provinsi->tampil_tertentu($id);

		echo json_encode($data);
	}

	public function simpan_edit()
	{
		$id = $_POST['id_provinsi'];
		$nama = $_POST['nama'];

		$data = array('NAMA_PROVINSI' => $nama);
		$kondisi = array('ID_PROVINSI' => $id);

		$data = $this->mod_provinsi->perbarui($data,$kondisi);
		echo json_encode(array('status' => true));
		/*
		if ($data > 0)
		{
			$this->session->set_flashdata('pesan','Perbarui data sukses...!!!');
			redirect(base_url('provinsi'));
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

		$this->mod_provinsi->hapus($id);
		echo json_encode(array("status" => TRUE));
	}
}
