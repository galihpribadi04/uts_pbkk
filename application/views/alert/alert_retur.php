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
            <div class="alert alert-success">
                <strong>Silahkan Cetak Dokumen Retur</strong>
                <a class="btn btn-default" href="#" onclick="goBack()"><span class="fa fa-backward"></span>Kembali</a>
                <a class="btn btn-info" href="<?php echo base_url() . 'retur/cetak_faktur/' . $nofak ?>" target="_blank"><span class="fa fa-print"></span>Cetak Retur</a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- Projects Row -->



    <!--END MODAL-->

    <hr>

</div>
<!-- /.container -->
<?php $this->load->view('include/footer') ?>
<script>
    function goBack() {
        window.history.back();
    }
</script>