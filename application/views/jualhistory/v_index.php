<?php 
        $this->load->view('include/head');
   ?>
<!-- Navigation -->
<?php 
        $this->load->view('include/menu');
   ?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <center><?php echo $this->session->flashdata('msg');?></center>
            <h1 class="page-header">History
                <small>Penjualan Hari ini Per Tanggal <?php echo tgl_ind(date('Y-m-d'))?> </small>
                <div class="pull-right">
                    <a href="<?php echo base_url('penjualan_history/hutang')?>" class="btn btn-sm btn-danger">Penjualan HUTANG</a>
                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                        data-target="#largeModal"><span class="fa fa-plus"></span> Cari Tanggal Lain</a>
                </div>
            </h1>
        </div>
    </div>
    <!-- /.row -->
    <!-- Projects Row -->
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-condensed" id="mydata">
                <thead>
                    <tr>
                        <th>No. Faktur</th>
                        <th>Nama Kasir / Sales</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Balanja</th>
                        <th>Tempo Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($now as $row){ ?>
                        <tr>
                            <td><?php echo $row['jual_nofak']?></td>
                            <td><?php echo $row['user_nama']?></td>
                            <td><?php echo $row['pelanggan_nama']?></td>
                            <td>Rp <?php echo number_format($row['jual_total'])?></td>
                            <td><?php echo tgl_ind($row['jual_tanggal'])?></td>
                            <?php if ($row['jual_status'] == 1) { ?>
                            <td class="btn-success">LUNAS</td>
                            <?php }else{ ?>
                            <td class="btn-danger">HUTANG</td>
                            <?php }?>
                            <td style="text-align:center;">
                            <a class="btn btn-xs btn-default" href="<?php echo base_url('penjualan_history/show_history/'.$row['jual_nofak'])?>"><span class="fa fa-eye"></span> View</a>
                        	</td>
                        </tr>
                    <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->
    <!-- ============ MODAL ADD =============== -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel">History berdasarkan tanggal</h3>
                </div>
                <form class="form-horizontal" method="get"
                    action="<?php echo base_url().'penjualan_history/tanggal'?>">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Pilih Tanggal</label>
                            <div class="col-xs-9">
                                <input name="tgl" class="form-control datepicker" type="text" placeholder="Pilih Tanggal"
                                    style="width:280px;" required>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-info">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <hr>

    <!-- Footer -->
    <?php 
        $this->load->view('include/footer');
   ?>
    <script type="text/javascript">
         $(function(){
			 	var date = new Date();
				date.setDate(date.getDate());
			  $(".datepicker").datepicker({
			  	  endDate: date,
			      format: 'yyyy-mm-dd',
			      autoclose: true,
			      todayHighlight: true,
			  });
		});
        $(document).ready(function () {
            $('#mydata').DataTable();
        });
    </script>

    </body>

    </html>