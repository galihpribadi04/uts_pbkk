<?php 
        $this->load->view('include/head');
   ?>
    <style type="text/css">
      .bg {
           width: 100%;
           height: 100%;
           position: fixed;
           z-index: -1;
           float: left;
           left: 0;
           margin-top: -20px;
      }
      </style>
<!-- Navigation -->
<?php 
        $this->load->view('include/menu');
   ?>
<img src="<?php echo base_url().'assets/img/bg2.jpg'?>" alt="gambar" class="bg" />
<!-- Page Content -->
<div class="container">
	<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="color:#fcc;">Hai,
                    <small><?php echo $this->session->userdata('nama')?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
	<div class="mainbody-section text-center">

        <!-- Projects Row -->
        <div class="row">
            <div class="col-md-4 portfolio-item">
                <div class="menu-item blue" style="height:150px;">
                           <i class="fa fa-money pull-right"></i>
                     <a href="#" data-toggle="modal">
                           <i class="">Rp <?php echo number_format($total_omset['SUM(jual_total)'])?></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Total Penualan Hari ini</p>
                      </a>
                </div> 
            </div>
            <div class="col-md-4 portfolio-item">
                <div class="menu-item green" style="height:150px;">
                           <i class="fa fa-money pull-right"></i>
                     <a href="#" data-toggle="modal">
                           <i >Rp <?php echo number_format($total_hutang['SUM(jual_total)'])?></i>
                            <p style="text-align:left;font-size:14px;padding-left:5px;">Transaksi Pelanggan Hutang </p>
                      </a>
                </div> 
            </div>
           
        </div>
	  
	<!-- Footer -->
	<?php 
        $this->load->view('include/footer');
   ?>
	</body>

	</html>
