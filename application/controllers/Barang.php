<?php
class Barang extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '3') {
			$this->load->model(['m_barang']);
			date_default_timezone_set("Asia/Jakarta");
		} else {
			redirect('login');
		};
	}
	function index()
	{
		$data = [
			'title' => 'Data Barang',
		];
		$this->load->view('barang/v_barang', $data);
	}

	function create_barang(){
		$data = [
			'title' => 'tambah Barang',
		];
		$this->load->view('barang/v_tambahbarang', $data);
	}

	function tambah_barang()
	{
		$kobar = $this->m_barang->get_kobar();
		$nabar = $this->input->post('nabar');
		$satuan = $this->input->post('satuan');
		$harpok = str_replace(',', '', $this->input->post('harpok'));
		$harjul = str_replace(',', '', $this->input->post('harjul'));
		$desc = $this->input->post('desc');
		$harjul_grosir = str_replace(',', '', $this->input->post('harjul_grosir'));
		$stok = $this->input->post('stok');
		$min_stok = $this->input->post('min_stok');
		$suplier = $this->input->post('suplier');
		$this->m_barang->simpan_barang($kobar, $nabar, $satuan, $harpok, $harjul, $harjul_grosir, $stok, $min_stok, $suplier, $desc);
		$this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Tambah ", "success");');
		redirect('barang');
	}

	function show_barang($id = '')
	{
		$result = $this->m_barang->show_barang($id)->row_array();
		if ($result) {
			$data = array(
				'title' => 'Edit Barang',
				'data'	=> $result
			);
			// die(print_r($data));
			$this->load->view('barang/v_editbarang', $data);
		} else {
			$this->session->set_flashdata('message', 'swal("error", "Data Tidak Ada", "error");');
			redirect('barang');
		}
	}

	function edit_barang()
	{
		$data = array(
			'barang_nama' =>  $this->input->post('nabar'),
			'barang_satuan' => $this->input->post('satuan'),
			'barang_harpok' => str_replace(',', '', $this->input->post('harpok')),
			'barang_harjul' => str_replace(',', '', $this->input->post('harjul')),
			'barang_harjul_grosir' => str_replace(',', '', $this->input->post('harjul_grosir')),
			'barang_stok' => $this->input->post('stok'),
			'barang_desc' => $this->input->post('desc'),
			'barang_min_stok' => $this->input->post('min_stok'),
			'barang_suplier_id' => $this->input->post('suplier'),
			// 'barang_kategori_id' => $this->input->post('kategori'),
			'barang_user_id' => $this->session->userdata('idadmin'),
		);
		// print_r($data);
		// die();
		$where = array(
			'barang_id' => $this->input->post('id' )
		);
		$this->db->where($where);
		$this->db->update('tbl_barang', $data);
		$this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Edit ", "success");');
		redirect('barang');
	}

	function hapus_barang($kode = '')
	{
		$this->m_barang->hapus_barang($kode);
		$this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Hapus ", "info");');
		redirect('barang');
	}

	function listbarang()
	{
		$hello = "'Are you sure you want to delete this item?'";
		$list = $this->m_barang->tampil_barang()->result_array();
		// die(print_r($list));
		foreach ($list as $row) {
			$result[] = array(
				'barang_id' => $row['barang_id'],
				'barang_nama'	=> $row['barang_nama'],
				'barang_satuan'	=> $row['barang_satuan'],
				'barang_harpok'	=> "Rp " . number_format($row['barang_harpok']),
				'barang_harjul'	=> "Rp " . number_format($row['barang_harjul']),
				'barang_harjul_grosir' => "Rp " . number_format($row['barang_harjul_grosir']),
				'barang_stok'	=> $row['barang_stok'],
				'barang_min_stok'	=>	$row['barang_min_stok'],
				'suplier_nama'	=> $row['suplier_nama'],
				'barang_desc'	=> $row['barang_desc'],
				'action'	=>	'<td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="' . base_url('barang/show_barang/' . $row['barang_id']) . '"><span class="fa fa-edit"></span> Edit</a>
                            
                            <a class="btn btn-xs btn-info" href="' . base_url('barang/barcode/' . $row['barang_id']) . '" target="_blank"></span> Barcode</a>
                        	</td>'
			);
		}
		// <a class="btn btn-xs btn-danger" href="' . base_url('barang/hapus_barang/' . $row['barang_id']) . '" onclick="return confirm(' . $hello . ');"><span class="fa fa-close"></span> Hapus</a>
		$data = [
			'data' => $result,
		];
		echo json_encode($data, JSON_PRETTY_PRINT);
	}

	public function barcode($id = '')
	{
		// echo $generator->getBarcode('A222', $generator::TYPE_CODE_128);
		// die();
		$data = array(
			'code'	=> $id,
		);
		$this->load->view('barang/v_barcode', $data);
	}

	public function allbarcode()
	{
		$data = array(
			'barcode' => $this->m_barang->tampil_barang()->result_array(),
		);
		$this->load->view('barang/v_allbarcode', $data);
	}
	public function cekbarang()
	{
		// die(print_r($this->input->post('id')));
		$hsl = $this->db->select('barang_nama')->like('barang_nama', $this->input->get('id'))->get('tbl_barang');
		if ($hsl) {
			$data = [
				'data' => $hsl->result_array(),
				'status'	=>'ada'
			];
		}else{
			$data = [
				'status'	=>'kosong'
			];

		}
		echo json_encode($data, JSON_PRETTY_PRINT);
	}
}
