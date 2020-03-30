<?php

class Pembelian_history extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$this->load->model('m_pembelian');
			date_default_timezone_set("Asia/Jakarta");
			$this->load->helper(['terbilang', 'tanggal']);
		} else {
			redirect('login');
		};
	}

	function index()
	{
		$data = [
			'title'	=> 'History pembelian',
			'now'	=> $this->db->query('SELECT * FROM tbl_beli JOIN tbl_suplier ON beli_suplier_id = suplier_id JOIN tbl_user ON beli_user_id = user_id')->result_array(),
		];
		// die(print_r($data));
		$this->load->view('belihistory/v_index', $data);
	}
	function view($kode = "")
	{
		if ($kode) {
			$data = [
				'title'	=> 'View pembelian',
				'result'	=> $this->db->query('SELECT * FROM tbl_beli  JOIN tbl_detail_beli ON beli_kode = d_beli_kode  JOIN tbl_suplier ON beli_suplier_id = suplier_id JOIN tbl_user ON beli_user_id = user_id  WHERE beli_kode = "' . $kode . '"'),
			];
			// die(print_r($data));
			$this->load->view('belihistory/v_detail', $data);
		} else {
			$this->session->set_flashdata('message', 'swal("Berhasil", "data tidak ada", "error");');
			redirect('welcome');
		}
	}

	function tanggal()
	{
		$tanggal = $this->input->get('tanggal');
		$data = [
			'title'	=> 'History pembelian',
			'now'	=> $this->db->query('SELECT * FROM tbl_beli JOIN tbl_pelanggan ON jual_pembeli = pelanggan_id JOIN tbl_user ON jual_user_id = user_id  WHERE create_date_jual LIKE "' . $tanggal . '%"')->result_array(),
		];
		// die(print_r($data));
		$this->load->view('belihistory/v_index', $data);
	}

	function cetak_faktur($kode = "")
	{
		if ($kode) {
			$data = [
				'title'	=> 'View pembelian',
				'result'	=> $this->db->query('SELECT * FROM tbl_beli  JOIN tbl_detail_beli ON beli_kode = d_beli_kode  JOIN tbl_suplier ON beli_suplier_id = suplier_id JOIN tbl_user ON beli_user_id = user_id  WHERE beli_kode = "' . $kode . '"'),
			];
			// die(print_r($data));
			$this->load->view('belihistory/v_print', $data);
		} else {
			$this->session->set_flashdata('message', 'swal("Berhasil", "data tidak ada", "error");');
			redirect('welcome');
		}
	}
}
