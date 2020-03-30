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
                    <a href="<?php echo base_url('barang/allbarcode') ?>" class="btn btn-sm btn-default" target="_blank"><span class="fa fa-print"></span> Print Semua Barcode Barang</a>
                    <a href="<?php echo base_url('barang/create_barang') ?>" class="btn btn-sm btn-success" ><span class="fa fa-plus"></span> Tambah Barang</a>
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
                        <th>Harga Pokok</th>
                        <th>Harga (Eceran)</th>
                        <th>Harga (Grosir)</th>
                        <th>Stok</th>
                        <th>Min Stok</th>
                        <th>Suplier</th>
                        <th>Keterengan</th>
                        <th style="width:200px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->
    

    <!--END MODAL-->
    <!--BUAT BARCODE-->
    <!--END BARCODE-->
    <hr>

    <?php $this->load->view('include/footer') ?>
    <script type="text/javascript">
        $(function() {
            $('.harpok').priceFormat({
                prefix: '',
                //centsSeparator: '',
                centsLimit: 0,
                thousandsSeparator: ','
            });
            $('.harjul').priceFormat({
                prefix: '',
                //centsSeparator: '',
                centsLimit: 0,
                thousandsSeparator: ','
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#mydata').DataTable({
                "ajax": '<?php echo base_url('barang/listbarang') ?>',
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
                        "data": "barang_harpok"
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
                    {
                        "data": "suplier_nama"
                    },
                    {
                        "data": "barang_desc"
                    },
                    {
                        "data": "action"
                    },
                ]
            });
        });
    </script>
   

    </body>

    </html>