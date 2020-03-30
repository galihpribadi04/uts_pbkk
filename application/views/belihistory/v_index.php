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
            <h1 class="page-header">History
                <small>Pembelian</small>
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
                        <th>No. Faktur</th>
                        <th>Nama Pembeli</th>
                        <th>Nama Suplier</th>
                        <th>Total Balanja</th>
                        <th>Tempo Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($now as $row) { ?>
                        <tr>
                            <td><?php echo $row['beli_kode'] ?></td>
                            <td><?php echo $row['user_nama'] ?></td>
                            <td><?php echo $row['suplier_nama'] ?></td>
                            <td>Rp <?php echo number_format($row['beli_total']) ?></td>
                            <td><?php echo tgl_ind($row['beli_tanggal']) ?></td>
                            <?php if ($row['beli_status'] == 1) { ?>
                                <td class="btn-success">LUNAS</td>
                            <?php } else { ?>
                                <td class="btn-danger">HUTANG</td>
                            <?php } ?>
                            <td style="text-align:center;">
                                <a href="<?php echo base_url('pembelian_history/view/'.$row['beli_kode'])?>" class="btn btn-xs btn-success">
                                    View
                                </a>
                                <button type="button" class="btn btn-xs btn-default" onclick="lunas('<?php echo $row['beli_kode'] ?>','<?php echo $row['beli_status'] ?>')">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php
    $this->load->view('include/footer');
    ?>
    <script type="text/javascript">
        function lunas(id, status) {
            if (status == 1) {
                swal({
                        title: "Batalkan??",
                        // text: 'asds',
                        icon: "info",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $(".preloader").show();
                            $.ajax({
                                type: "post",
                                url: "<?php echo base_url('pembelian/lunas') ?>",
                                data: {
                                    id: id,
                                    status: status
                                },
                                dataType: "json",
                                success: function(response) {
                                    window.location.reload()
                                }
                            });

                        }
                    });
            } else {
                swal({
                        title: "Lunass??",
                        // text: 'asds',
                        icon: "info",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $(".preloader").show();
                            $.ajax({
                                type: "post",
                                url: "<?php echo base_url('pembelian/lunas') ?>",
                                data: {
                                    id: id,
                                    status: status
                                },
                                dataType: "json",
                                success: function(response) {
                                    window.location.reload()
                                }
                            });

                        }
                    });
            }
        }
        $(document).ready(function() {
            $('#mydata').DataTable();
        });
    </script>

    </body>

    </html>