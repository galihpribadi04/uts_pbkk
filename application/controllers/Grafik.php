<?php
class Grafik extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '1') {
			$this->load->model(['m_kategori', 'm_barang', 'm_suplier', 'm_pembelian', 'm_penjualan', 'm_laporan', 'm_grafik']);
			date_default_timezone_set("Asia/Jakarta");
		} else {
			redirect('login');
		};
	}
	function index()
	{
		$data['data'] = $this->m_barang->tampil_barang();
		$data['kat'] = $this->m_kategori->tampil_kategori();
		$data['jual_bln'] = $this->m_laporan->get_bulan_jual();
		$data['jual_thn'] = $this->m_laporan->get_tahun_jual();
		$this->load->view('admin/v_grafik', $data);
	}
	function graf_stok_barang()
	{
		$x['report'] = $this->m_grafik->statistik_stok();
		$this->load->view('admin/grafik/v_graf_stok_barang', $x);
	}


	function graf_penjualan_perbulan()
	{
		$bulan = $this->input->post('bln');
		$x['report'] = $this->m_grafik->graf_penjualan_perbulan($bulan);
		$x['bln'] = $bulan;
		$this->load->view('admin/grafik/v_graf_penjualan_perbulan', $x);
	}
	function graf_penjualan_pertahun()
	{
		$tahun = $this->input->post('thn');
		$x['report'] = $this->m_grafik->graf_penjualan_pertahun($tahun);
		$x['thn'] = $tahun;
		$this->load->view('admin/grafik/v_graf_penjualan_pertahun', $x);
	}
}
