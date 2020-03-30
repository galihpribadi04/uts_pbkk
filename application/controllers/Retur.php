<?php
class Retur extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2' ||  $this->session->userdata('akses') == '3') {
			$this->load->model(['m_retur', 'm_barang', 'm_suplier']);
			$this->load->helper(['terbilang', 'tanggal']);
			date_default_timezone_set("Asia/Jakarta");
		} else {
			redirect('login');
		};
	}

	function index()
	{
		$data = array(
			'title' => 'List Retur ',
			'retur'	=> $this->db->query('SELECT * FROM tbl_retur JOIN tbl_suplier ON retur_suplier_id = suplier_id JOIN tbl_pelanggan ON retur_pelanggan = pelanggan_id  JOIN tbl_user ON retur_user_id = user_id')->result_array(),
		);
		$this->load->view('retur/v_history', $data);
	}

	public function pelanggan()
	{
		$data = array(
			'title' => 'Retur Pelanggan',
		);
		$this->load->view('retur/v_retur_pelanggan', $data);
	}

	public function toko()
	{
		$data = array(
			'title' => 'Retur Toko',
		);
		$this->load->view('retur/v_retur_toko', $data);
	}

	function get_barang()
	{
		$kobar = $this->input->post('kode_brg');
		$x['brg'] = $this->m_barang->get_barang($kobar);
		if ($x['brg']->row_array()) {
			$this->load->view('retur/v_detail_barang_retur', $x);
		} else {
			echo '<label class="label label-danger">Item Barang Tidak Ada</label>';
		}
	}

	function add_to_retur()
	{
		$kobar = $this->input->post('kode_brg');
		$qtysebelumnya = $this->input->post('qtysebelumnya');
		$satuan = $this->input->post('satuan');
		$harjul = str_replace(",", "", $this->input->post('harjul'));
		$qty = $this->input->post('qty');
		$keterangan = $this->input->post('keterangan');
		$produk = $this->m_barang->get_barang($kobar);
		$i = $produk->row_array();
		$data = array(
			'id'       => $i['barang_id'],
			'name'     => $i['barang_nama'],
			'satuan'   => $i['barang_satuan'],
			'price'    => $i['barang_harjul'],
			'qty'      => $this->input->post('qty'),
			'coupon'      => $this->input->post('keterangan')
		);
		$this->cart->insert($data);
		redirect('retur/pelanggan');
	}

	function add_to_retur_toko()
	{
		$kobar = $this->input->post('kode_brg');
		$qtysebelumnya = $this->input->post('qtysebelumnya');
		$satuan = $this->input->post('satuan');
		$harjul = str_replace(",", "", $this->input->post('harjul'));
		$qty = $this->input->post('qty');
		$keterangan = $this->input->post('keterangan');
		$produk = $this->m_barang->get_barang($kobar);
		$i = $produk->row_array();
		$data = array(
			'id'       => $i['barang_id'],
			'name'     => $i['barang_nama'],
			'satuan'   => $i['barang_satuan'],
			'price'    => $i['barang_harjul'],
			'qty'      => $this->input->post('qty'),
			'coupon'      => $this->input->post('keterangan')
		);
		$this->cart->insert($data);
		redirect('retur/toko');
	}

	function removepelanggan()
	{
		$row_id = $this->uri->segment(3);
		$this->cart->update(array(
			'rowid'      => $row_id,
			'qty'     => 0
		));
		redirect('retur/pelanggan');
	}

	function simpan_retur_pelanggan()
	{
		$kode = $this->m_retur->get_nofak();
		$insert = array(
			'retur_kode' => $kode,
			'retur_tanggal'	=> date('Y-m-d h:i:s'),
			'retur_suplier_id'	=> $this->input->post('suplier'),
			'retur_user_id'	=> $this->session->userdata('idadmin'),
			'retur_pelanggan' => $this->input->post('pelanggan'),
			'retur_subtotal'	=> 0,
			'retur_status'	=> 0,
			'create_date_retur' => date('Y-m-d h:i:s'),
		);
		$this->db->insert('tbl_retur', $insert);
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_retur_barang_id'	=>	$item['id'],
				'd_retur_harga'		=>	0,
				'd_retur_qty'		=>	$item['qty'],
				'd_retur_barang'	=>	$item['name'],
				'd_retur_total'		=>	0,
				'd_retur_id'		=>	$kode,
				'd_retur_desc'		=>  $item['coupon'],
			);
			$this->db->insert('tbl_detail_retur', $data);
			// $this->db->query("update tbl_barang set barang_stok=barang_stok+'$item[qty]',barang_harpok='$item[price]',barang_harjul='$item[harga]' where barang_id='$item[id]'");
		}
		// $this->db->where('barang_id', $kobar);
		// $this->db->update('tbl_barang', $retur);
		// $this->m_penjualan->simpan_retur($kobar, $nabar, $harjul, $qty, $keterangan);
		$this->cart->destroy();
		$data = array(
			'title' => 'Retur Cetak',
			'nofak'	=> $kode,
		);
		$this->load->view('alert/alert_retur', $data);
	}

	function simpan_retur_toko()
	{
		$kode = $this->m_retur->get_nofak();
		$insert = array(
			'retur_kode' => $kode,
			'retur_tanggal'	=> date('Y-m-d h:i:s'),
			'retur_suplier_id'	=> $this->input->post('suplier'),
			'retur_user_id'	=> $this->session->userdata('idadmin'),
			'retur_pelanggan' => $this->input->post('pelanggan'),
			'retur_subtotal'	=> $this->cart->total(),
			'retur_status'	=> 0,
			'create_date_retur' => date('Y-m-d h:i:s'),
		);
		$this->db->insert('tbl_retur', $insert);
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_retur_barang_id'	=>	$item['id'],
				'd_retur_harga'		=>	$item['price'],
				'd_retur_qty'		=>	$item['qty'],
				'd_retur_barang'	=>	$item['name'],
				'd_retur_total'		=>	$item['subtotal'],
				'd_retur_id'		=>	$kode,
				'd_retur_desc'		=>  $item['coupon'],
			);
			$this->db->insert('tbl_detail_retur', $data);
			// $this->db->query("update tbl_barang set barang_stok=barang_stok+'$item[qty]',barang_harpok='$item[price]',barang_harjul='$item[harga]' where barang_id='$item[id]'");
		}
		// $this->db->where('barang_id', $kobar);
		// $this->db->update('tbl_barang', $retur);
		// $this->m_penjualan->simpan_retur($kobar, $nabar, $harjul, $qty, $keterangan);
		$this->cart->destroy();
		$data = array(
			'title' => 'Retur Cetak',
			'nofak'	=> $kode,
		);
		$this->load->view('alert/alert_retur', $data);
	}

	function cetak_faktur($kode = "")
	{
		$this->load->helper(['terbilang', 'tanggal']);
		if ($kode) {
			$x['data'] = $this->m_retur->cetak_faktur($kode);
			// die(print_r($x['data']->result_array()));
			$this->load->view('laporan/v_retur', $x);
		} else {
			$this->session->set_flashdata('message', 'swal("Berhasil", "data tidak ada", "error");');
			redirect('retur');
		}
	}

	function getsuplier()
	{
		$id = $this->input->get('q');
		if ($id == NULL) {
			$getsup = $this->m_suplier->tampil_suplier()->result_array();
			// die(print_r($getsup));
			foreach ($getsup as $row) {
				$result[] = array(
					'id' => $row['suplier_id'],
					'text' => $row['suplier_nama']
				);
			}
			echo json_encode($data = array('result' => $result), JSON_PRETTY_PRINT);
		} else {
			$getsup = $this->db->query('select suplier_id,suplier_nama from tbl_suplier where suplier_nama like "%' . $id . '%" ')->result_array();
			// die(print_r($getsup));
			if ($getsup) {
				foreach ($getsup as $row) {
					$result[] = array(
						'id' => $row['suplier_id'],
						'text' => $row['suplier_nama']
					);
				}
				echo json_encode($data = array('result' => $result), JSON_PRETTY_PRINT);
			} else {
				$result[] = array(
					'id' => 'kosong',
					'text' => 'data tidak ada'
				);
				echo json_encode($data = array('result' => $result), JSON_PRETTY_PRINT);
			}
		}
	}
}
