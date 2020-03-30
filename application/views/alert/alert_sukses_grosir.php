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
                <div class="alert alert-success">
                    <strong>Transaksi Berhasil Silahkan Cetak Faktur Penjualan!</strong>
                    <a class="btn btn-default" href="<?php echo base_url().'penjualan_grosir'?>"><span class="fa fa-backward"></span>Kembali</a>
                    <a class="btn btn-info" href="<?php echo base_url().'penjualan_grosir/cetak_faktur_grosir/'.$nofak?>" target="_blank"><span class="fa fa-print"></span>Cetak Faktur</a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
       
        

        <!--END MODAL-->

        <hr>

        <!-- Footer -->

    </div>
    <!-- /.container -->
<?php $this->load->view('include/footer') ?>
