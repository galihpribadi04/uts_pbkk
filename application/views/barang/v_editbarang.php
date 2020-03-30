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
                <small>Barang <?php echo $data['barang_id'] ?></small>

            </h1>
        </div>
    </div>
    <!-- /.row -->
    <!-- Projects Row -->
    <form class="form-horizontal" method="post" action="<?php echo base_url() . 'barang/edit_barang' ?>" onsubmit="$('.preloader').show();">
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label col-xs-3">Nama Barang</label>
                <div class="col-xs-9">
                    <input type="hidden" value="<?php echo $data['barang_id'] ?>" name="id">
                    <input name="nabar" class="form-control" type="text" placeholder="Nama Barang..." style="width:335px;" required value="<?php echo $data['barang_nama'] ?>">
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label col-xs-3">Kategori</label>
                <div class="col-xs-9">
                    <select class="form-control" id="selectkategori" name="kategori" style="width: 335px;"></select>
                    </select>

                </div>
            </div> -->
            <input name="satuan" type="hidden"  value="<?php echo $data['barang_satuan'] ?>">
            <!-- <div class="form-group">
                <label class="control-label col-xs-3">Satuan</label>
                <div class="col-xs-9">
                    <select name="satuan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Satuan" data-width="41%" placeholder="Pilih Satuan" required>
                        <option value="Karung">Karung</option>
                        <option value="Kotak">Kotak</option>
                        <option value="PCS">PCS</option>
                        <option value="LSN">LSN</option>
                        <option value="Gross">Gross</option>
                        <option value="Koli">Koli</option>
                        <option value="Dus">Dus</option>
                        <option value="Bungkus">Bungkus</option>
                        <option value="Kantong">Kantong</option>
                    </select>
                    <span><small class="text-danger"> <?php echo $data['barang_satuan'] ?> </small></span>
                </div>
            </div> -->
            <div class="form-group">
                <label class="control-label col-xs-3">Harga Pokok</label>
                <div class="col-xs-9">
                    <input name="harpok" class="harpok form-control" type="text" placeholder="Harga Pokok..." style="width:335px;" value="<?php echo $data['barang_harpok'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-3">Harga (Eceran)</label>
                <div class="col-xs-9">
                    <input name="harjul" class="harjul form-control" type="text" placeholder="Harga Jual Eceran..." style="width:335px;" value="<?php echo $data['barang_harjul'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-3">Harga (Grosir)</label>
                <div class="col-xs-9">
                    <input name="harjul_grosir" class="harjul form-control" type="text" placeholder="Harga Jual Grosir..." style="width:335px;" value="<?php echo $data['barang_harjul_grosir'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-3">Stok</label>
                <div class="col-xs-9">
                    <input name="stok" class="form-control" type="number" placeholder="Stok..." style="width:335px;" value="<?php echo $data['barang_stok'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-3">Minimal Stok</label>
                <div class="col-xs-9">
                    <input name="min_stok" class="form-control" type="number" placeholder="Minimal Stok..." style="width:335px;" value="<?php echo $data['barang_min_stok'] ?>">
                </div>
            </div>
            <input name="suplier" type="hidden"  value="<?php echo $data['suplier_id'] ?>">
            <!-- <div class="form-group">
                <label class="control-label col-xs-3">Suplier</label>
                <div class="col-xs-9">
                    <select class="form-control" id="selectsuplier" name="suplier" style="width: 335px;"></select><span><small class="text-danger"> <?php echo $data['suplier_nama'] ?> </small></span>
                </div>
            </div> -->
            <div class="form-group">
                <label class="control-label col-xs-3">Keterengan</label>
                <div class="col-xs-9">
                    <textarea name="desc" id="desc" cols="15" rows="10" class="form-control"> <?php echo $data['barang_desc'] ?></textarea>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <a href="<?php echo base_url('barang') ?>" class="btn btn-default">Kembali</a>
            <button class="btn btn-info">Edit</button>
        </div>
    </form>



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
    <script>
        $('#selectsuplier').select2({
            placeholder: "Pilih Supleir",
            allowClear: true,
            ajax: {
                url: '<?php echo base_url('suplier/getsuplier') ?>',
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
        $('#selectkategori').select2({
            placeholder: "Pilih Kategori",
            allowClear: true,
            ajax: {
                url: '<?php echo base_url('kategori/getkategori') ?>',
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