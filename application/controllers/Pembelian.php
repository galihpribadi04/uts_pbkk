<?php
class Pembelian extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '3') {
			$this->load->model(['m_barang', 'm_pembelian']);
			date_default_timezone_set("Asia/Jakarta");
		} else {
			redirect('administrator');
		};
	}

	function index()
	{
		$data = array(
			'title' =>  'Pemebelian Barang',
		);
		$this->load->view('pembelian/v_pembelian', $data);
	}

	function get_barang()
	{
		$kobar = $this->input->post('kode_brg');
		$x['brg'] = $this->m_barang->get_barang($kobar);
		if ($x['brg']->row_array()) {
			$this->load->view('pembelian/v_detail_barang_beli', $x);
		} else {
			echo '<label class="label label-danger">Item Barang Tidak Ada</label>';
		}
	}

	function simpan_pembelian()
	{
		$beli_kode = $this->m_pembelian->get_kobel();
		$data = [
			'beli_kode' => $beli_kode,
			'beli_tanggal' => $this->input->post('tgl'),
			'beli_suplier_id' => $this->input->post('suplier'),
			'beli_user_id'	=> $this->session->userdata('idadmin'),
			'beli_total'	=> $this->cart->total(),
			'beli_path'	=> '',
			'beli_status' => 0,
			'create_date_jual'	=> date('Y-m-d H:i:s')
		];
		$this->db->insert('tbl_beli', $data);
		$order_proses = $this->m_pembelian->simpan_pembelian($beli_kode);
		if ($order_proses) {
			$this->cart->destroy();
			echo $this->session->set_flashdata('msg', '<label class="label label-success">Pembelian Berhasil di Simpan ke Database</label>');
			redirect('pembelian');
		} else {
			echo $this->session->set_flashdata('msg', '<label class="label label-danger">Pembelian Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
			redirect('pembelian');
		}
	}

	function removeupload($id)
	{
		if ($id) {
			$this->session->unset_userdata('file');
			array_map('unlink', glob(FCPATH . "assets/upload/$id"));
			echo $this->session->set_flashdata('msg', '<label class="label label-succes">Remove Upload Berhasil</label>');
			redirect('pembelian');
		} else {
			echo $this->session->set_flashdata('msg', '<label class="label label-danger">Remove Upload tidak ada</label>');
			redirect('pembelian');
		}
	}

	function add_to_cart()
	{
		$suplier = $this->input->post('suplier');
		$this->session->set_userdata('suplier', $suplier);
		$kobar = $this->input->post('kode_brg');
		$produk = $this->m_barang->get_barang($kobar);
		$i = $produk->row_array();
		$data = array(
			'id'       => $i['barang_id'],
			'name'     => $i['barang_nama'],
			'satuan'   => $i['barang_satuan'],
			'price'    => $this->input->post('harpok'),
			'harga'    => $this->input->post('harjul'),
			'qty'      => $this->input->post('jumlah')
		);

		$this->cart->insert($data);
		redirect('pembelian');
	}

	function remove()
	{
		$row_id = $this->uri->segment(3);
		$this->cart->update(array(
			'rowid'      => $row_id,
			'qty'     => 0
		));
		redirect('pembelian');
	}

	function lunas()
	{
		// die(print_r($_POST));
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		if ($status == 0) {
			$result = 1;
		} else {
			$result = 0;
		}
		$where = array('beli_kode' => $id,);
		$insert = array(
			'beli_status'	=> $result,
		);
		$this->db->where($where)->update('tbl_beli', $insert);
		echo json_encode($data = array('status' => 'success'), JSON_PRETTY_PRINT);
	}

	function detail()
	{ }
}
