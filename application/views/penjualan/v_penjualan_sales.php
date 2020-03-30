<?php
$this->load->view('include/head');
?>
<?php
$this->load->view('include/menu');
?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <center><?php echo $this->session->flashdata('msg'); ?></center>
            <h1 class="page-header">Transaksi
                <small>Penjualan (sales)</small>
                <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Cari
                        Produk!</small></a>
            </h1>
        </div>
    </div>
    <!-- /.row -->
    <!-- Projects Row -->
    <div class="row">
        <div class="col-lg-12">
            <form action="<?php echo base_url() . 'penjualan_sales/add_to_cart' ?>" method="post" onsubmit="$('.preloader').show();">
                <table>
                    <tr>
                        <th>Kode Barang</th>
                    </tr>
                    <tr>
                        <th><input type="text" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>
                    </tr>
                    <div id="detail_barang" style="position:absolute;">
                    </div>
                </table>
            </form>
            <br>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th style="text-align:center;">Satuan</th>
                        <th style="text-align:center;">Harga(Rp)</th>
                        <th style="text-align:center;">Qty</th>
                        <th style="text-align:center;">Diskon(%)</th>
                        <th style="text-align:center;">Diskon(Rp)</th>
                        <th style="text-align:center;">Sub Total</th>
                        <th style="width:100px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    $diskon = 0;
                    ?>
                    <?php foreach ($this->cart->contents() as $items) : ?>
                        <?php echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                        <tr>
                            <td><?= $items['id']; ?></td>
                            <td><?= $items['name']; ?></td>
                            <td style="text-align:center;"><?= $items['satuan']; ?></td>
                            <td style="text-align:center;"><?php echo number_format($items['qty']); ?></td>
                            <td style="text-align:right;"><?php echo number_format($items['amount']); ?></td>
                            <td style="text-align:right;"><?php echo number_format($items['disc']); ?></td>
                            <td style="text-align:center;"><?php echo number_format($items['coupon']); ?></td>
                            <td style="text-align:right;"><?php echo number_format($items['subtotal']); ?></td>
                            <td style="text-align:center;"><a href="<?php echo base_url() . 'penjualan/remove/' . $items['rowid']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                        </tr>
                        <?php $i++; ?>
                        <?php
                            $diskon += $items['coupon'];
                            ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form action="<?php echo base_url() . 'penjualan_sales/simpan_penjualan_sales' ?>" method="post" onsubmit="$('.preloader').show();">
                <table>
                    <tr>
                        <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-info btn-lg">
                                Simpan</button></td>
                        <th style="width:140px;">Total Belanja(Rp)</th>
                        <th style="text-align:right;width:140px;"><input type="text" name="total2" value="<?php echo number_format($this->cart->total()); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                        <input type="hidden" id="total" name="total" value="<?php echo $this->cart->total(); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                    </tr>
                    <tr>
                        <th>Total Diskon(Rp)</th>
                        <th style="text-align:right;width:140px;"><input type="text" name="diskon2" value="<?php echo number_format($diskon); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                        <input type="hidden" id="diskon" name="diskon" value="<?php echo $diskon; ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                    </tr>
                    <tr>
                    <tr>
                        <td></td>
                        <th>Tanggal Pembayaran</th>
                        <th><input type="text" name="tgl" class="form-control datepicker" placeholder="Tanggal Pembayaran" tyle="text-align:right;margin-bottom:5px;"></th>
                    <tr>
                        <td>
                        </td>
                        <th>Nama Pembeli</th>
                        <th style="text-align:right;">
                            <select class="form-control input-sm" style="text-align:right;margin-bottom:5px;" id="selectpelanggan" name="pembeli" required></select>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <th>Nama Sales</th>
                        <th style="text-align:right;">
                            <select class="form-control input-sm" style="text-align:right;margin-bottom:5px;" id="selectsales" name="sales" required></select>
                    </tr>
                </table>
            </form>
            <hr />
        </div>
        <!-- /.row -->
        <!-- ============ MODAL ADD =============== -->
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
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga (sales)</th>
                                    <th>Stok</th>
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

        <!--END MODAL-->

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
            $(function() {
                $('#jml_uang').on("input", function() {
                    var total = $('#total').val();
                    var jumuang = $('#jml_uang').val();
                    var hsl = jumuang.replace(/[^\d]/g, "");
                    $('#jml_uang2').val(hsl);
                    $('#kembalian').val(hsl - total);
                })

            });
        </script>
        <script type="text/javascript">
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
                            "data": "barang_harjul_grosir"
                        },
                        {
                            "data": "barang_stok"
                        },
                    ]
                });
            });
        </script>
        <script type="text/javascript">
            $(function() {
                $('.jml_uang').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });
                $('#jml_uang2').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ''
                });
                $('#kembalian').priceFormat({
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
                //Ajax kabupaten/kota insert
                $("#kode_brg").focus();
                $("#kode_brg").on("input", function() {
                    var kobar = {
                        kode_brg: $(this).val()
                    };
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'penjualan_sales/get_barang'; ?>",
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
            $('#selectpelanggan').select2({
                placeholder: "Cari Pelanggan",
                allowClear: true,
                ajax: {
                    url: '<?php echo base_url('pelanggan/getpelanggan') ?>',
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
            $('#selectsales').select2({
                placeholder: "Cari Sales",
                allowClear: true,
                ajax: {
                    url: '<?php echo base_url('penjualan_sales/getsales') ?>',
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