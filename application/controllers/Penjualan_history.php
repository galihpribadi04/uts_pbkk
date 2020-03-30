<?php

class Penjualan_history extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			// $this->load->model('m_penjualan');
			date_default_timezone_set("Asia/Jakarta");
			$this->load->helper(['terbilang', 'tanggal']);
		} else {
			redirect('login');
		};
	}

	function index()
	{
		$data = [
			'title'	=> 'History Penjualan',
			'now'	=> $this->db->query('SELECT jual_nofak,jual_tanggal,create_date_jual,jual_keterangan,jual_total,jual_status,pelanggan_nama,user_nama FROM tbl_jual JOIN tbl_pelanggan ON jual_pembeli = pelanggan_id JOIN tbl_user ON jual_user_id = user_id  WHERE create_date_jual LIKE "' . date('Y-m-d') . '%"')->result_array(),
		];
		// die(print_r($data));
		$this->load->view('jualhistory/v_index', $data);
	}

	function hutang()
	{
		$data = [
			'title'	=> 'History Penjualan',
			'now'	=> $this->db->query("SELECT jual_nofak,jual_tanggal,create_date_jual,jual_keterangan,jual_total,jual_status,pelanggan_nama,user_nama FROM tbl_jual JOIN tbl_pelanggan ON jual_pembeli = pelanggan_id JOIN tbl_user ON jual_user_id = user_id  WHERE jual_status = '0'")->result_array(),
		];
		// die(print_r($data));
		$this->load->view('jualhistory/v_hutang', $data);
	}

	function show_history($nofak = '')
	{
		if ($nofak) {
			$data = [
				'title'	=> 'History Penjualan',
				'result'	=> $this->db->query("SELECT jual_nofak,jual_status,jual_tanggal,jual_total,jual_jml_uang,jual_kembalian,jual_total_diskon,jual_keterangan,jual_pembeli,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total_diskon,d_jual_total,pelanggan_nama,user_nama,create_date_jual FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak = d_jual_nofak JOIN tbl_pelanggan ON jual_pembeli = pelanggan_id JOIN tbl_user ON jual_user_id = user_id WHERE jual_nofak='$nofak'"),
			];
			// die(print_r($data['result']->result_array()));
			$this->load->view('jualhistory/v_detail', $data);
		} else {
			$this->session->set_flashdata('message', 'swal("Berhasil", "data tidak ada", "error");');
			redirect('welcome');
		}
	}

	function tanggal()
	{
		$tanggal = $this->input->get('tanggal');
		$data = [
			'title'	=> 'History Penjualan',
			'now'	=> $this->db->query('SELECT jual_nofak,jual_tanggal,create_date_jual,jual_keterangan,jual_total,jual_status,pelanggan_nama,user_nama FROM tbl_jual JOIN tbl_pelanggan ON jual_pembeli = pelanggan_id JOIN tbl_user ON jual_user_id = user_id  WHERE create_date_jual LIKE "' . $tanggal . '"')->result_array(),
		];
		// die(print_r($data));
		$this->load->view('jualhistory/v_index', $data);
	}
}
