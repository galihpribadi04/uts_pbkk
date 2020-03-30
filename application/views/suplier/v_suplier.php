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
            <h1 class="page-header">Data
                <small>Suplier</small>
                <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                        data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Suplier</a></div>
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
                        <th>No</th>
                        <th>Nama Suplier</th>
                        <th>Alamat</th>
                        <th>No Telp/HP</th>
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
                    <h3 class="modal-title" id="myModalLabel">Tambah Suplier</h3>
                </div>
                <form class="form-horizontal" method="post"
                    action="<?php echo base_url().'suplier/tambah_suplier'?>"  onsubmit="$('.preloader').show();">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Nama Suplier</label>
                            <div class="col-xs-9">
                                <input name="nama" class="form-control" type="text" placeholder="Nama Suplier..."
                                    style="width:280px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Alamat</label>
                            <div class="col-xs-9">
                            <textarea name="alamat" class="form-control" cols="30" rows="10" style="width:280px;"></textarea>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">No Telp/ HP</label>
                            <div class="col-xs-9">
                                <input name="notelp" class="form-control" type="number" placeholder="No Telp/HP..."
                                    style="width:280px;" required>
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
<!-- /.container -->

<?php 
        $this->load->view('include/footer');
   ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#mydata').DataTable({
                    "ajax": '<?php echo base_url('suplier/listsuplier') ?>',
                    "columns": [{
                            "data": "suplier_id"
                        },
                        {
                            "data": "suplier_nama"
                        },
                        {
                            "data": "suplier_alamat"
                        },
                        {
                            "data": "suplier_notlpn"
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