<?php
class Welcome extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            redirect('login');
		};
		date_default_timezone_set("Asia/Jakarta");
	}
	
	function index(){
		if ($this->session->userdata('akses') === '1') {
			$data = [
				'title'	=> 'Dashboard',
				'total_omset'	=> $this->db->query('SELECT SUM(jual_total) FROM tbl_jual WHERE create_date_jual LIKE "'.date('Y-m-d').'%" AND jual_status LIKE "1"')->row_array(),
				'total_hutang'	=> $this->db->query('SELECT SUM(jual_total) FROM tbl_jual WHERE jual_status LIKE "0"')->row_array(),
				'pelanggan' => $this->db->query('SELECT COUNT(pelanggan_id) FROM tbl_pelanggan')->row_array()
			];
			// die(print_r($data));
			$this->load->view('v_admin',$data);
		}else if ($this->session->userdata('akses') === '2') {
			$data = [
				'title'	=> 'Dashboard',
				'total_omset'	=> $this->db->query('SELECT SUM(jual_total) FROM tbl_jual WHERE create_date_jual LIKE "'.date('Y-m-d').'%" AND jual_status LIKE "1"')->row_array(),
				'total_hutang'	=> $this->db->query('SELECT SUM(jual_total) FROM tbl_jual WHERE jual_status LIKE "0"')->row_array(),
				'pelanggan' => $this->db->query('SELECT COUNT(pelanggan_id) FROM tbl_pelanggan')->row_array()
			];
			// die(print_r($data));
			$this->load->view('v_kasir',$data);
		}else if ($this->session->userdata('akses') === '3') {
			$data = [
				'title'	=> 'Dashboard',
			];
			// die(print_r($data));
			$this->load->view('v_gudang',$data);
		}else if ($this->session->userdata('akses') === '4') {
			$data = [
				'title'	=> 'Dashboard',
			];
			// die(print_r($data));
			$this->load->view('v_sales',$data);
		}
	}
}
