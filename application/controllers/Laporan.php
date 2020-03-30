<?php
class Laporan extends CI_Controller
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
		$data['title'] = 'Laporan';
		$this->load->view('laporan/v_laporan', $data);
	}
	function lap_stok_barang()
	{
		$x['data'] = $this->m_laporan->get_stok_barang();
		$this->load->view('laporan/v_lap_stok_barang', $x);
	}
	function lap_data_barang()
	{
		$x['data'] = $this->m_laporan->get_data_barang();
		$this->load->view('laporan/v_lap_barang', $x);
	}
	function lap_data_penjualan()
	{
		$x['data'] = $this->m_laporan->get_data_penjualan();
		$x['jml'] = $this->m_laporan->get_total_penjualan();
		$this->load->view('laporan/v_lap_penjualan', $x);
	}
	function lap_penjualan_pertanggal()
	{
		$tanggal = $this->input->post('tgl');
		$x['jml'] = $this->m_laporan->get_data__total_jual_pertanggal($tanggal);
		$x['data'] = $this->m_laporan->get_data_jual_pertanggal($tanggal);
		$this->load->view('laporan/v_lap_jual_pertanggal', $x);
	}
	function lap_penjualan_perbulan()
	{
		$bulan = $this->input->post('bln');
		$x['jml'] = $this->m_laporan->get_total_jual_perbulan($bulan);
		$x['data'] = $this->m_laporan->get_jual_perbulan($bulan);
		$this->load->view('laporan/v_lap_jual_perbulan', $x);
	}
	function lap_penjualan_pertahun()
	{
		$tahun = $this->input->post('thn');
		$x['jml'] = $this->m_laporan->get_total_jual_pertahun($tahun);
		$x['data'] = $this->m_laporan->get_jual_pertahun($tahun);
		$this->load->view('laporan/v_lap_jual_pertahun', $x);
	}
	function lap_laba_rugi()
	{
		$bulan = $this->input->post('bln');
		$x['jml'] = $this->m_laporan->get_total_lap_laba_rugi($bulan);
		$x['data'] = $this->m_laporan->get_lap_laba_rugi($bulan);
		$this->load->view('laporan/v_lap_laba_rugi', $x);
	}
}
