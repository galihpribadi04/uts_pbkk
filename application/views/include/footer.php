 <!-- Footer -->
 <footer>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/dataTables.bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
    <script src="<?php echo base_url()?>assets/select2/js/select2.min.js" rel="stylesheet"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap-datepicker.min.js" rel="stylesheet"></script>
    <script><?php echo $this->session->flashdata('message')?></script>
    <div class="preloader">
	<div class="loading">
            <!-- <img src="http://www.qdc.co.id/assets/images/new-qdc.png" width="80"> -->
            <br>
            <img src="<?php echo base_url().'assets/images/loading.gif'?>" width="150"/>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
        $(".preloader").fadeOut();
        })
    </script>
    