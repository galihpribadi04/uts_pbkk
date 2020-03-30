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
            <h1 class="page-header">Kategori
                <small>Barang</small>
                <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                        data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Kategori</a></div>
            </h1>
        </div>
    </div>
    <!-- /.row -->
    <!-- Projects Row -->
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-condensed"  id="mydata">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                 
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
                    <h3 class="modal-title" id="myModalLabel">Tambah Kategori</h3>
                </div>
                <form class="form-horizontal" method="post"
                    action="<?php echo base_url().'kategori/tambah_kategori'?>"  onsubmit="$('.preloader').show();">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Nama Kategori</label>
                            <div class="col-xs-9">
                                <input name="kategori" class="form-control" type="text"
                                    placeholder="Input Nama Kategori..." style="width:280px;" required>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-info" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php 
        $this->load->view('include/footer');
   ?>
    <script type="text/javascript">
            $(document).ready(function () {
                $('#mydata').DataTable({
                    "ajax": '<?php echo base_url('kategori/listkategori') ?>',
                    "columns": [{
                            "data": "kategori_id"
                        },
                        {
                            "data": "kategori_nama"
                        },
                        {
                            "data": "action"
                        },
                    ]
                });
            });
        </script>