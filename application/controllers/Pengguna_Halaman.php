<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_Halaman extends CI_Controller {

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

		$this->load->view('head/pengguna');

		$this->load->view('menu_atas');

		$this->load->view('sidebar');

		$this->load->view('konten/pengguna',$data);

		$this->load->view('menu_bawah');
		
		$this->load->view('foot/pengguna');
	}

	public function tambah()
	{
		$nama = $_POST['nama'];
		$level = $_POST['level'];
		$sandi = $_POST['sandi'];
		$foto = $_FILES['foto']['name'];
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
 
		$this->load->library('upload', $config);
 
		if (!$this->upload->do_upload('foto'))
		{
			echo "<h1>Tambah gambar gagal !!!</h1>";
		}
		else
		{
			# $this->db->set('ID_PENGGUNA','UUID()',FALSE);

			$data = array(
				'ID_PENGGUNA' => $id,
				'NAMA_PENGGUNA' => $nama,
				'ID_LEVEL' => $level,
				'SANDI_PENGGUNA' => $sandi,
				'FOTO_PENGGUNA' => $nama_file.".".$file_ext
				);

			$data = $this->mod_pengguna->tambah($data);

			if ($data > 0)
			{
				$this->session->set_flashdata('pesan','Tambah data sukses...!!!');
				redirect(base_url('pengguna'));
			}
			else
			{
				echo "<h1>Tambah data gagal !!!</h1>";
			}
		}
		# ================= Gambar ================= #
	}

	public function edit()
	{
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$level = $_POST['level'];

		if (empty($_POST['sandi']))
		{
			$data = array(
				'NAMA_PENGGUNA' => $nama,
				'ID_LEVEL' => $level,
				);
		}
		else
		{
			$sandi = $_POST['sandi'];
			$data = array(
				'NAMA_PENGGUNA' => $nama,
				'ID_LEVEL' => $level,
				'SANDI_PENGGUNA' => $sandi,
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
		$pengguna = $this->mod_pengguna->index("WHERE ID_PENGGUNA = ".$id); # untuk foto

		$id = array('ID_PENGGUNA' => $id);
		$data = $this->mod_pengguna->hapus($id);

		if ($data > 0)
		{
			$this->session->set_flashdata('pesan','Data berhasil dihapus...!!!');

			unlink('./gambar/'.$pengguna[0]['FOTO_PENGGUNA']);

			redirect(base_url('pengguna'));
		}
		else
		{
			echo "<h1>Hapus data gagal !!!</h1>";
		}
	}
}
