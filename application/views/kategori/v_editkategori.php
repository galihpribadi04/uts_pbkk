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
            <h1 class="page-header">Edit
                <small>Kategori</small>
            </h1>
        </div>
    </div>
     <form class="form-horizontal" method="post"
                    action="<?php echo base_url().'kategori/edit_kategori'?>"  onsubmit="$('.preloader').show();">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Nama Kategori</label>
                            <div class="col-xs-9">
                                <input type="hidden" name="id" value="<?php echo $data['kategori_id']?>">
                                <input name="kategori" class="form-control" type="text"
                                    placeholder="Input Nama Kategori..." style="width:280px;" required  value="<?php echo $data['kategori_nama']?>">
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <a href="<?php echo base_url('kategori')?>" class="btn btn-default">Kembali</a>
			            <button class="btn btn-info" type="submit">Edit</button>
                    </div>
                </form>
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