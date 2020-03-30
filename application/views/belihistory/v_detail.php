<?php 
        $this->load->view('include/head');
   ?>
<style>
	#tabel {
		font-size: 15px;
		border-collapse: collapse;
	}

	#tabel td {
		padding-left: 5px;
		border: 1px solid black;
	}

</style>
<!-- Navigation -->
<?php 
        $this->load->view('include/menu');
   ?>

<!-- Page Content -->
<center>
	<table style='width:550px; font-family:calibri; border-collapse: collapse;' border='0'>
		<?php 
                        $b = $result->row_array();
                    ?>
		<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
			<span style='font-size:12pt'><b>Toko PUNGU JAYA</b></span>
			</br>
			Jl. Kebon Bawang V No. 5B Pasar Ular Permai
			</br>
			No Telp : (021) 4369802 / (021) 4350782
		</td>
		<td style='vertical-align:top' width='30%' align='left'>
			<b><span style='font-size:12pt'>FAKTUR Pembelian</span></b>
			</br>
			No Faktur : <?php echo $b['beli_kode']?></br>
			Tanggal : <?php echo tgl_ind($b['create_date_jual']);?></br>
			No. Suplier : <?php echo ($b['suplier_id']);?></br>
		</td>
	</table>
	<table style='width:550px; font-family:calibri; border-collapse: collapse;' border='0'>
		<td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
	</table>
	<table cellspacing='0' style='width:550px; font-family:calibri;  border-collapse: collapse;' border='1'>

		<tr align='center'>
			<td width='2%'>NO</td>
			<td width='20%'>Nama Barang</td>
			<td width='2%'>Satuan</td>
			<td width='2%'>Qty</td>
			<td width='13%'>Harga Jual</td>
			<td width='15%'>Total Harga</td>
			<?php 
			$no=0;
				foreach ($result->result_array() as $i) {
					$no++;
					$nabar=$i['d_beli_barang'];
					$satuan=$i['d_beli_barang_satuan'];
					$harjul=$i['d_beli_harga'];
					$qty=$i['d_beli_jumlah'];
					$total=$i['d_beli_total'];
			?>
		<tr>
		<tr>
			<td align='center'><?php echo $no;?></td>
			<td><?php echo $nabar;?></td>
			<td><?php echo $satuan;?></td>
			<td><?php echo $qty;?></td>
			<td><?php echo 'Rp '.number_format($harjul).',-';?></td>
			<td style='text-align:right'><?php echo 'Rp '.number_format($total).',-';?></td>
		</tr>
		<?php }?>
		<tr>
			<td colspan='5'>
				<div style='text-align:right'>Total :</div>
			</td>
			<td style='text-align:right'><?php echo 'Rp '.number_format(($b['beli_total'])).',-';?></td>
		</tr>
	</table>
	<br>
	<table style='width:600;' cellspacing='2'>
		<tr>
			<td align='center'>Pembeli</br></br><br><br><u> ( <?php echo $this->session->userdata('nama');?> )</u>
			</td>
				<td style='border:1px solid black; padding:8px; text-align:left; width:50%'>
				<p>Terbilang : <i> <b><?php echo ucwords(number_to_words($b['beli_total']));?></b></i></p>
			</td>
			<td align='center'>Suplier</br></br><br><br><u> ( <?php echo ($b['suplier_nama']);?> )</u></td>
	</table>
	<button class="btn btn-default" onclick="goBack()">Kembali</button>
	<a href="<?php echo base_url('pembelian_history/cetak_faktur/'.$b['beli_kode']) ?> " target="_blank"
		class="btn btn-info">Print Faktur</a>
</center>
<!-- Footer -->
<?php 
        $this->load->view('include/footer');
   ?>
<script>
	function goBack() {
		window.history.back();
	}

</script>
</body>

</html>
