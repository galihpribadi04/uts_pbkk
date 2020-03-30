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
                <small>Penjualan Hutang</small>
                <div class="pull-right">
                    <a href="<?php echo base_url('penjualan_history')?>" class="btn btn-sm btn-default">List History Penjualan</a>
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
                        <th >Aksi</th>
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
<hr>
    <!-- Footer -->
    <?php 
        $this->load->view('include/footer');
   ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#mydata').DataTable();
        });
    </script>

    </body>

    </html>