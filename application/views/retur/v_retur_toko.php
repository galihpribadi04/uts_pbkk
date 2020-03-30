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
            <center><?php echo $this->session->flashdata('msg'); ?></center>
            <h1 class="page-header">Retur
                <small>Toko</small>
                <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Cari
                        Produk!</small></a>
            </h1>
        </div>
    </div>
    <!-- /.row -->
    <!-- Projects Row -->
    <div class="row">
        <div class="col-lg-12">

            <form action="<?php echo base_url() . 'retur/add_to_retur_toko' ?>" method="post" enctype="multipart/form-data" onsubmit="$('.preloader').show();">
                <table>
                    <tr>
                        <th>Retur Toko</th>
                    </tr>
                    <tr>
                        <th><input type="text" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>
                    </tr>
                    <div id="detail_barang" style="position:absolute;">
                    </div>
                </table>
            </form>
            <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th style="text-align:center;">Qty</th>
                        <th style="text-align:center;">Harga</th>
                        <th style="text-align:center;">Jumlah</th>
                        <th style="text-align:center;">Keterengan</th>
                        <th style="width:100px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($this->cart->contents() as $items) : ?>
                        <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                        <tr>
                            <td><?= $items['id']; ?></td>
                            <td><?= $items['name']; ?></td>
                            <td style="text-align:center;"><?= $items['satuan']; ?></td>
                            <td style="text-align:right;"><?php echo number_format($items['price']); ?></td>
                            <td style="text-align:center;"><?php echo number_format($items['qty']); ?></td>
                            <td style="text-align:right;"><?php echo $items['coupon']; ?></td>
                            <td style="text-align:center;"><a href="<?php echo base_url() . 'retur/removepelanggan/' . $items['rowid']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div>
                <form action="<?php echo base_url() . 'retur/simpan_retur_toko' ?>" method="post" enctype='multipart/form-data' onsubmit="$('.preloader').show();">

                    <div class="form-group">
                        <label for="pwd">Suplier:</label>
                        <select class="form-control" id="selectsuplier" name="suplier"></select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-info btn-lg pull-right">
                        Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Data Barang</h3>
                    </div>
                    <div class="modal-body">

                        <table class="table table-bordered table-condensed" id="mydata">
                            <thead>
                                <tr>
                                    <th style="width:120px;">Kode Barang</th>
                                    <th style="width:240px;">Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Stok</th>
                                    <th>Suplier</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Footer -->
        <?php
        $this->load->view('include/footer');
        ?>

        <script type="text/javascript">
            $(function() {
                var date = new Date();
                date.setDate(date.getDate());
                $(".datepicker").datepicker({
                    startDate: date,
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true,
                });
            });
            $(document).ready(function() {
                $('#mydata').DataTable({
                    "ajax": '<?php echo base_url('penjualan/listbarang') ?>',
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
                            "data": "barang_stok"
                        },
                        {
                            "data": "suplier_nama"
                        },
                    ]
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                //Ajax kabupaten/kota insert
                $("#kode_brg").focus();
                $("#kode_brg").keyup(function() {
                    var kobar = {
                        kode_brg: $(this).val()
                    };
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'retur/get_barang'; ?>",
                        data: kobar,
                        success: function(msg) {
                            $('#detail_barang').html(msg);
                        }
                    });
                });

                $("#kode_brg").keypress(function(e) {
                    if (e.which == 13) {
                        $("#jumlah").focus();
                    }
                });
            });
        </script>
        <script>
            $('#selectsuplier').select2({
                placeholder: "Pilih Suplier",
                allowClear: true,
                ajax: {
                    url: '<?php echo base_url('retur/getsuplier ') ?>',
                    dataType: 'json',
                    type: "GET",
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.result
                        };
                    }
                },

            });
        </script>
        <script>
            $('form').bind("keypress", function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    return false;
                }
            })
        </script>
        </body>

        </html>