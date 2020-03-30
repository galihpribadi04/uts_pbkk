<?php
class Penjualan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$this->load->model(['m_kategori', 'm_barang','m_penjualan']);
			date_default_timezone_set("Asia/Jakarta");
		} else {
			redirect('login');
		};
	}

	function index()
	{
		$data = [
			'title' => 'Penjualan Eceran'
		];
		// die(print_r($this->cart->contents()));
		$this->load->view('penjualan/v_penjualan', $data);
	}

	function get_barang()
	{
		$kobar = $this->input->post('kode_brg');
		$x['brg'] = $this->m_barang->get_barang($kobar);
		if ($x['brg']->row_array()) {
			$this->load->view('penjualan/v_detail_barang_jual', $x);
		} else {
			echo '<label class="label label-danger">Item Barang Tidak Ada</label>';
		}
	}

	function add_to_cart()
	{
		$kobar = $this->input->post('kode_brg');
		$produk = $this->m_barang->get_barang($kobar);
		$harga = str_replace(",", "", $this->input->post('harjul'));
		$diskon =  $this->input->post('diskon');
		$hasil = $harga - $diskon;
		$i = $produk->row_array();
		$data = array(
			'id'       => $i['barang_id'],
			'name'     => $i['barang_nama'],
			'satuan'   => $i['barang_satuan'],
			'harpok'   => $i['barang_harjul'],
			'price'    => $hasil,
			'disc'     => $diskon,
			'qty'      => $this->input->post('qty'),
			'amount'	  => str_replace(",", "", $this->input->post('harjul'))
		);
		// die(print_r($data));
		if (!empty($this->cart->total_items())) {
			foreach ($this->cart->contents() as $items) {
				$id = $items['id'];
				$qtylama = $items['qty'];
				$rowid = $items['rowid'];
				$kobar = $this->input->post('kode_brg');
				$qty = $this->input->post('qty');
				if ($id == $kobar) {
					$up = array(
						'rowid' => $rowid,
						'qty' => $qtylama + $qty
					);
					$this->cart->update($up);
				} else {
					$this->cart->insert($data);
				}
			}
		} else {
			$this->cart->insert($data);
		}
		redirect('penjualan');
	}

	function remove()
	{
		$row_id = $this->uri->segment(3);
		$this->cart->update(array(
			'rowid'      => $row_id,
			'qty'     => 0
		));
		redirect('penjualan');
	}

	function simpan_penjualan()
	{
		$total = $this->input->post('total');
		$pembeli = $this->input->post('pembeli');
		$jml_uang = $this->input->post('jml_uang2');
		$diskon = $this->input->post('diskon');
		$totaldiskon = $this->input->post('diskon');
		$kembalian = $jml_uang - $total;
		// die(print_r($_POST));
		if (!empty($total) && !empty($jml_uang) && !empty($pembeli)) {
			if ($jml_uang < $total) {
				echo $this->session->set_flashdata('msg', '<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
				redirect('penjualan');
			} else {
				$nofak = $this->m_penjualan->get_nofak();
				$order_proses = $this->m_penjualan->simpan_penjualan($nofak, $total, $jml_uang, $kembalian, $pembeli, $diskon);
				if ($order_proses) {
					$this->cart->destroy();
					$data = array(
						'title' => 'Cetak Penjualan',
						'nofak' => $nofak
					);
					$this->load->view('alert/alert_sukses', $data);
				} else {
					echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
					redirect('penjualan');
				}
			}
		} else {
			echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
			redirect('penjualan');
		}
	}

	function cetak_faktur($nofak = '')
	{
		$this->load->helper(['terbilang', 'tanggal']);
		if ($nofak) {
			$x['data'] = $this->m_penjualan->cetak_faktur($nofak);
			$this->load->view('laporan/v_faktur', $x);
		} else {
			$this->session->set_flashdata('message', 'swal("Berhasil", "data tidak ada", "error");');
			redirect('penjualan');
		}
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
				'suplier_nama'	=>	$row['suplier_nama'],
			);
		}
		$data = [
			'data' => $result,
		];
		echo json_encode($data, JSON_PRETTY_PRINT);
	}
}
