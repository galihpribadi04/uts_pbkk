<?php
class Penjualan_sales extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2' ||  $this->session->userdata('akses') == '4') {
			$this->load->model(['m_barang', 'm_penjualan']);
			date_default_timezone_set("Asia/Jakarta");
		} else {
			redirect('login');
		};
	}

	function index()
	{
		$data = [
			'title' => 'Penjualan Sales'
		];
		$this->load->view('penjualan/v_penjualan_sales', $data);
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
		redirect('penjualan_sales');
	}

	function remove()
	{
		$row_id = $this->uri->segment(3);
		$this->cart->update(array(
			'rowid'      => $row_id,
			'qty'     => 0
		));
		redirect('penjualan_sales');
	}

	function simpan_penjualan_sales()
	{
		$pembeli = $this->input->post('pembeli');
		$diskon = $this->input->post('diskon');
		$sales = $this->input->post('sales');
		$total = $this->input->post('total');
		$tanggal = $this->input->post('tgl');
		// die(print_r($_POST));
		if (!empty($sales) && !empty($pembeli)) {
			$nofak = $this->m_penjualan->get_nofak();
			$order_proses = $this->m_penjualan->simpan_penjualan_sales($nofak, $total, $pembeli, $diskon, $sales, $tanggal);
			if ($order_proses) {
				$this->cart->destroy();
				$this->session->unset_userdata('tglfak');
				$this->session->unset_userdata('suplier');
				$data = array(
					'title' => 'Cetak Penjualan_sales',
					'nofak' => $nofak
				);
				$this->load->view('alert/alert_sukses_sales', $data);
			} else {
				echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!asdsa</label>');
				redirect('penjualan_sales');
			}
		} else {
			echo $this->session->set_flashdata('msg', '<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!zzz</label>');
			redirect('penjualan_sales');
		}
	}

	function cetak_faktur_sales($nofak = '')
	{
		$this->load->helper(['terbilang', 'tanggal']);
		if ($nofak) {
			$x['data'] = $this->m_penjualan->cetak_faktur($nofak);
			// die(print_r($x['data']->row_array()));
			$this->load->view('laporan/v_faktur_sales', $x);
		} else {
			$this->session->set_flashdata('message', 'swal("Berhasil", "data tidak ada", "error");');
			redirect('penjualan_sales');
		}
	}

	function lunas()
	{
		$nofak = $this->input->post('id');
		$uang = $this->input->post('uang');
		$where = array('jual_nofak' => $nofak,);
		$insert = array(
			'jual_jml_uang' => $uang,
			'jual_status'	=> 1,
		);
		$this->db->where($where)->update('tbl_jual', $insert);
		echo json_encode($data = array('status' => 'success'), JSON_PRETTY_PRINT);
	}

	function getsales()
	{
		$id = $this->input->get('q');
		$kode = 4;
		if ($id == NULL) {
			$getsel = $this->db->query('select user_id,user_nama from tbl_user where user_level = "' . $kode . '"')->result_array();
			// die(print_r($getsel));
			foreach ($getsel as $row) {
				$result[] = array(
					'id' => $row['user_id'],
					'text' => $row['user_nama']
				);
			}
			echo json_encode($data = array('result' => $result), JSON_PRETTY_PRINT);
		} else {
			$getsel = $this->db->query('select user_id,user_nama from tbl_user where user_level = "' . $kode . '" and user_nama like "' . $id . '" ')->result_array();
			foreach ($getsel as $row) {
				$result[] = array(
					'id' => $row['user_id'],
					'text' => $row['user_nama']
				);
			}
			if ($getarf) {
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
