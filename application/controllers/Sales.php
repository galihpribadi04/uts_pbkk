<?php

class Sales extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '4') {
			$this->load->model('m_barang');
			date_default_timezone_set("Asia/Jakarta");
			$this->load->helper(['terbilang', 'tanggal']);
		} else {
			redirect('login');
		};
	}

	function index()
	{
		$data = [
			'title' => 'Penjualan Sales'
		];
		$this->load->view('penjualan/v_barang', $data);
	}
	function listbarang()
	{
		$list = $this->m_barang->tampil_barang()->result_array();
		foreach ($list as $row) {
			$result[] = array(
				'barang_id' => $row['barang_id'],
				'barang_nama'	=> $row['barang_nama'],
				'barang_satuan'	=> $row['barang_satuan'],
				'barang_harjul'	=> "Rp " . number_format($row['barang_harjul']),
				'barang_harjul_grosir' => "Rp " . number_format($row['barang_harjul_grosir']),
				'barang_stok'	=> $row['barang_stok'],
				'barang_min_stok'	=>	$row['barang_min_stok'],
			);
		}
		$data = [
			'data' => $result,
		];
		echo json_encode($data, JSON_PRETTY_PRINT);
	}

	function history()
	{
		$data = [
			'title'	=> 'History Penjualan',
			'now'	=> $this->db->query('SELECT jual_nofak,jual_tanggal,create_date_jual,jual_keterangan,jual_total,jual_status,pelanggan_nama,user_nama FROM tbl_jual JOIN tbl_pelanggan ON jual_pembeli = pelanggan_id JOIN tbl_user ON jual_user_id = user_id  WHERE jual_user_id = "' . $this->session->userdata('idadmin') . '"')->result_array(),
		];
		// die(print_r($data));
		$this->load->view('jualhistory/v_sales', $data);
	}
}
