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
            <h1 class="page-header">Data
                <small>Barang</small>
                <div class="pull-right">
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
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Harga (Eceran)</th>
                        <th>Harga (Grosir)</th>
                        <th>Stok</th>
                        <th>Min Stok</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->
    <hr>

    <?php $this->load->view('include/footer') ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable({
                "ajax": '<?php echo base_url('sales/listbarang') ?>',
                "columns": [{
                        "data": "barang_id"
                    },
                    {
                        "data": "barang_nama"
                    },
                    {
                        "data": "barang_satuan"
                    },
                    {
                        "data": "barang_harjul"
                    },
                    {
                        "data": "barang_harjul_grosir"
                    },
                    {
                        "data": "barang_stok"
                    },
                    {
                        "data": "barang_min_stok"
                    },
                ]
            });
        });
    </script>

    </body>

    </html>