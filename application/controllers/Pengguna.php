<?php
class Pengguna extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '1') {
			$this->load->model('m_pengguna');
			date_default_timezone_set("Asia/Jakarta");
		} else {
			redirect('login');
		};
	}

	function index()
	{
		$data = [
			'data' => $this->m_pengguna->get_pengguna(),
			'title'	=> 'List User',
		];
		$this->load->view('user/v_pengguna', $data);
	}

	function tambah_pengguna()
	{
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password2 = $this->input->post('password2');
		$level = $this->input->post('level');
		if ($password2 <> $password) {
			echo $this->session->set_flashdata('msg', '<label class="label label-danger">Password yang Anda Masukan Tidak Sama</label>');
			redirect('pengguna');
		} else {
			$this->m_pengguna->simpan_pengguna($nama, $username, $password, $level);
			echo $this->session->set_flashdata('msg', '<label class="label label-success">Pengguna Berhasil ditambahkan</label>');
			redirect('pengguna');
		}
	}

	function edit_pengguna()
	{
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password2 = $this->input->post('password2');
		$level = $this->input->post('level');
		if (empty($password) && empty($password2)) {
			$this->m_pengguna->update_pengguna_nopass($kode, $nama, $username, $level);
			echo $this->session->set_flashdata('msg', '<label class="label label-success">Pengguna Berhasil diupdate</label>');
			redirect('pengguna');
		} elseif ($password2 <> $password) {
			echo $this->session->set_flashdata('msg', '<label class="label label-danger">Password yang Anda Masukan Tidak Sama</label>');
			redirect('pengguna');
		} else {
			$this->m_pengguna->update_pengguna($kode, $nama, $username, $password, $level);
			echo $this->session->set_flashdata('msg', '<label class="label label-success">Pengguna Berhasil diupdate</label>');
			redirect('pengguna');
		}
	}

	function nonaktifkan($kode = '')
	{
		if ($kode) {
			$status = 0;
			$this->m_pengguna->update_status($kode, $status);
			echo $this->session->set_flashdata('msg', '<label class="label label-success">Pengguna Berhasil diupdate</label>');			# code...
			redirect('pengguna');
		} else { }
	}

	function aktifkan($kode = '')
	{
		if ($kode) {
			$status = 1;
			$this->m_pengguna->update_status($kode, $status);
			echo $this->session->set_flashdata('msg', '<label class="label label-success">Pengguna Berhasil diupdate</label>');
			redirect('pengguna');
		} else {
			echo $this->session->set_flashdata('msg', '<label class="label label-danger">Data Tidak Ada</label>');
			redirect('pengguna');
		}
	}
}
