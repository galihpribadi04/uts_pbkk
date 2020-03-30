<!-- head -->
<?php $this->load->view('include/head'); ?>
<!-- Navigation -->
<?php 
        $this->load->view('include/menu');
   ?>

<!-- Page Content -->
<div class="container">

	<!-- Page Heading -->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Edit
				<small>Suplier</small>

			</h1>
		</div>
	</div>
	<!-- /.row -->
	<form class="form-horizontal" method="post" action="<?php echo base_url().'suplier/edit_suplier'?>"  onsubmit="$('.preloader').show();">
		<div class="modal-body">

			<div class="form-group">
				<label class="control-label col-xs-3">Nama Suplier</label>
				<div class="col-xs-9">
				<input type="hidden" value="<?php echo $data['suplier_id']?>" name="id">
					<input name="nama" class="form-control" type="text" placeholder="Nama Suplier..."
						style="width:280px;" required value="<?php echo $data['suplier_nama']?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-3">Alamat</label>
				<div class="col-xs-9">
				<textarea name="alamat" class="form-control" cols="30" rows="10" style="width:280px;"><?php echo $data['suplier_alamat']?></textarea>
	
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-3">No Telp/ HP</label>
				<div class="col-xs-9">
					<input name="notelp" class="form-control" type="text" placeholder="No Telp/HP..."
						style="width:280px;" required value="<?php echo $data['suplier_notelp']?>">
				</div>
			</div>

		</div>

		<div class="modal-footer">
                        <a href="<?php echo base_url('suplier')?>" class="btn btn-default">Kembali</a>
			<button class="btn btn-info" type="submit">Edit</button>
		</div>
	</form>
	<hr>

	<?php $this->load->view('include/footer') ?>