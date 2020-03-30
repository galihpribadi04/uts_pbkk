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
                <small>Retur</small>
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
                        <th>Nama Kasir</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Suplier</th>
                        <th>Tanggal Retur</th>
                        <th>Status Retur</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($retur as $row) { ?>
                        <tr>
                            <td><?php echo $row['retur_kode'] ?></td>
                            <td><?php echo $row['user_nama'] ?></td>
                            <td><?php echo $row['pelanggan_nama'] ?></td>
                            <td><?php echo $row['suplier_nama'] ?></td>
                            <td><?php echo tgl_ind($row['retur_tanggal']) ?></td>
                            <?php if ($row['retur_status'] == 1) { ?>
                                <td class="btn-success">Barang berhasil di retur</td>
                            <?php } else { ?>
                                <td class="btn-danger">Barang Sedang di retur</td>
                            <?php } ?>
                            <td style="text-align:center;">
                                <a target="_blank" href="<?php echo base_url('retur/cetak_faktur/' . $row['retur_kode']) ?>" class="btn btn-xs btn-success">
                                    View
                                </a>
                                <button type="button" class="btn btn-xs btn-default" onclick="retur('<?php echo $row['retur_kode'] ?>','<?php echo $row['retur_status'] ?>')">
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
        function retur(id, status) {
            if (status == 1) {
                swal({
                        title: "Masalah lagi barang nya??",
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
                                url: "<?php echo base_url('pembelian/retur') ?>",
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
                        title: "Barang Sudah di retur??",
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
                                url: "<?php echo base_url('pembelian/retur') ?>",
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