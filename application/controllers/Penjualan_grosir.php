<?php
class Penjualan_grosir extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$this->load->model(['m_barang', 'm_penjualan']);
			date_default_timezone_set("Asia/Jakarta");
		} else {
			redirect('login');
		};
	}

	function index()
	{
		$data = [
			'title' => 'Penjualan Grosir'
		];
		$this->load->view('penjualan/v_penjualan_grosir', $data);
	}

	function get_barang()
	{
		$kobar = $this->input->post('kode_brg');
		$x['brg'] = $this->m_barang->get_barang($kobar);
		if ($x['brg']->row_array()) {
			$this->load->view('penjualan/v_detail_barang_jual_sales', $x);
		} else {
			echo '<label class="label label-danger">Item Barang Tidak Ada</label>';
		}
	}

	function add_to_cart()
	{
		$kobar = $this->input->post('kode_brg');
		$produk = $this->m_barang->get_barang($kobar);
		$harga = str_replace(",", "", $this->input->post('harjul'));
		$totaldiskon = ($this->input->post('diskon') / 100) * $harga;
		$hasil = $harga - $totaldiskon;
		$result = $totaldiskon * $this->input->post('qty');
		$i = $produk->row_array();
		$data = array(
			'id'       => $i['barang_id'],
			'name'     => $i['barang_nama'],
			'satuan'   => $i['barang_satuan'],
			'harpok'   => $i['barang_harpok'],
			'price'    => $hasil,
			'coupon'   => $result,
			'disc'     => $this->input->post('diskon'),
			'qty'      => $this->input->post('qty'),
			'amount'	  => str_replace(",", "", $this->input->post('harjul'))
		);
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
		redirect('penjualan_grosir');
	}

	function remove()
	{
		$row_id = $this->uri->segment(3);
		$this->cart->update(array(
			'rowid'      => $row_id,
			'qty'     => 0
		));
		redirect('penjualan_grosir');
	}

	function simpan_penjualan_grosir()
	{
		$total = $this->input->post('total');
		$pembeli = $this->input->post('pembeli');
		$jml_uang = $this->input->post('jml_uang2');
		$diskon = $this->input->post('diskon');
		$kembalian = $jml_uang - $total;
		// die(print_r($_POST));
		if (!empty($total) && !empty($jml_uang) && !empty($pembeli)) {
			if ($jml_uang < $total) {
				echo $this->session->set_flashdata('msg', '<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
				redirect('penjualan_grosir');
			} else {
				$nofak = $this->m_penjualan->get_nofak();
				$order_proses = $this->m_penjualan->simpan_penjualan_grosir($nofak, $total, $jml_uang, $kembalian, $pembeli, $diskon);
				if ($order_proses) {
					$this->cart->destroy();
					$data = array(
						'title' => 'Cetak Penjualan_grosir',
						'nofak' => $nofak
					);
					$this->load->view('alert/alert_sukses_grosir', $data);
				} else {
					echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
					redirect('penjualan_grosir');
				}
			}
		} else {
			echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
			redirect('penjualan_grosir');
		}
	}

	function cetak_faktur_grosir($nofak = '')
	{
		$this->load->helper(['terbilang', 'tanggal']);
		if ($nofak) {
			$x['data'] = $this->m_penjualan->cetak_faktur($nofak);
			$this->load->view('laporan/v_faktur_grosir', $x);
		} else {
			$this->session->set_flashdata('message', 'swal("Berhasil", "data tidak ada", "error");');
			redirect('penjualan_grosir');
		}
	}
}
