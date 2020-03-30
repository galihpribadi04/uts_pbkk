<?php
class M_penjualan extends CI_Model{

	function hapus_retur($kode){
		$hsl=$this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
		return $hsl;
	}

	function simpan_penjualan($nofak,$total,$jml_uang,$kembalian,$pembeli,$diskon){
		$idadmin = $this->session->userdata('idadmin');
		$insert = [
			'jual_nofak'	=> 	$nofak,
			'jual_tanggal'	=>	date('Y-m-d H:i:s'),
			'jual_total'	=>	$total,
			'jual_jml_uang'	=>	$jml_uang,
			'jual_kembalian'	=>	$kembalian,
			'jual_user_id'	=> $idadmin,
			'jual_keterangan' => 'eceran',
			'jual_pembeli' => $pembeli,
			'jual_total_diskon' => $diskon,
			'jual_status'	=> 1,
			'create_date_jual'	=> date('Y-m-d H:i:s'),
		];
			$this->db->insert('tbl_jual',$insert);
		// $this->db->query("INSERT INTO tbl_jual (jual_nofak,jual_tanggal,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan,jual_pembeli,jual_total_diskon,jual_diskon) VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','eceran','$pembeli','$diskon','1')");
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_jual_nofak' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_harpok'	=>	$item['harpok'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'd_jual_total_diskon'	=>	$item['disc'],
				'd_jual_total'			=>	$item['subtotal']
			);
			$this->db->insert('tbl_detail_jual',$data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
		}
		return true;
	}
	
	function simpan_penjualan_grosir($nofak,$total,$jml_uang,$kembalian,$pembeli,$diskon){
		$idadmin = $this->session->userdata('idadmin');
		$insert = [
			'jual_nofak'	=> 	$nofak,
			'jual_tanggal'	=>	date('Y-m-d H:i:s'),
			'jual_total'	=>	$total,
			'jual_jml_uang'	=>	$jml_uang,
			'jual_kembalian'	=>	$kembalian,
			'jual_user_id'	=> $idadmin,
			'jual_keterangan' => 'grosir',
			'jual_pembeli' => $pembeli,
			'jual_total_diskon' => $diskon,
			'jual_status'	=> 1,
			'create_date_jual'	=> date('Y-m-d H:i:s'),
		];
		$this->db->insert('tbl_jual',$insert);	
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_jual_nofak' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_harpok'	=>	$item['harpok'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'd_jual_total_diskon'	=>	$item['coupon'],
				'd_jual_total'			=>	$item['subtotal']
			);
			$this->db->insert('tbl_detail_jual',$data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
		}
		return true;
	}

	function simpan_penjualan_sales($nofak,$total,$pembeli,$diskon,$sales,$tanggal){
		$insert = [
			'jual_nofak'	=> 	$nofak,
			'jual_tanggal'	=>	$tanggal,
			'jual_total'	=>	$total,
			'jual_jml_uang'	=>	'0',
			'jual_kembalian'	=>	'0',
			'jual_user_id'	=> $sales,
			'jual_keterangan' => 'sales',
			'jual_pembeli' => $pembeli,
			'jual_total_diskon' => $diskon,
			'jual_status'	=> 0,
			'create_date_jual'	=> date('Y-m-d H:i:s'),
		];
		$this->db->insert('tbl_jual',$insert);	
		foreach ($this->cart->contents() as $item) {
			$data=array(
				'd_jual_nofak' 			=>	$nofak,
				'd_jual_barang_id'		=>	$item['id'],
				'd_jual_barang_nama'	=>	$item['name'],
				'd_jual_barang_satuan'	=>	$item['satuan'],
				'd_jual_barang_harpok'	=>	$item['harpok'],
				'd_jual_barang_harjul'	=>	$item['amount'],
				'd_jual_qty'			=>	$item['qty'],
				'd_jual_diskon'			=>	$item['disc'],
				'd_jual_total_diskon'	=>	$item['coupon'],
				'd_jual_total'			=>	$item['subtotal']
			);
			$this->db->insert('tbl_detail_jual',$data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[qty]' where barang_id='$item[id]'");
		}
		return true;
	}
	
	function cetak_faktur($nofak){
		$hsl = $this->db->query("SELECT jual_nofak,jual_tanggal,jual_total,jual_jml_uang,jual_kembalian,jual_total_diskon,jual_keterangan,jual_pembeli,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total_diskon,d_jual_total,pelanggan_nama,user_nama,create_date_jual FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak = d_jual_nofak JOIN tbl_pelanggan ON jual_pembeli = pelanggan_id JOIN tbl_user ON jual_user_id = user_id WHERE jual_nofak='$nofak'");
		return $hsl;
	}
	
	function get_nofak(){
		$q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,6)) AS kd_max FROM tbl_jual ");
		$kd = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}else{
			$kd = "000001";
		}
		return 'PJ'.date('dmy').$kd;
	}
}