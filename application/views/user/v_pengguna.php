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
            <center><?php echo $this->session->flashdata('msg');?></center>
            <h1 class="page-header">Data
                <small>Pengguna</small>
                <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                        data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Pengguna</a></div>
            </h1>
        </div>
    </div>
    <!-- /.row -->
    <!-- Projects Row -->
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;
                        $id=$a['user_id'];
                        $nm=$a['user_nama'];
                        $username=$a['user_username'];
                        $level=$a['user_level'];
                        $status=$a['user_status'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td><?php echo $nm;?></td>
                        <td><?php echo $username;?></td>
                        <td><?php if($level === '1'){
                            echo 'admin';
                        }elseif($level === '2'){
                            echo 'kasir';
                        }elseif($level === '3'){
                            echo 'gudang';
                        }else{
                            echo 'sales';
                        }
                            ?>
                        </td>
                        <td><?php if($status === '1'){
                            echo 'aktif';
                        }else{
                            echo 'nonaktif';
                        }
                            ?></td>
                        <td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="#modalEditPelanggan<?php echo $id?>"
                                data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                                <?php if($status === '1'){ ?>
                            <a class="btn btn-xs btn-danger" href="<?php echo base_url("pengguna/nonaktifkan/".$id)?>"><span class="fa fa-close"></span> Nonaktifkan</a>
                        <?php }else{ ?>
                            <a class="btn btn-xs btn-success" href="<?php echo base_url("pengguna/aktifkan/".$id) ?>"><span class="fa fa-close"></span> aktifkan</a>
                        <?php } ?>

                        </td>
                    </tr>
                    <?php endforeach;?>
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
                    <h3 class="modal-title" id="myModalLabel">Tambah Pengguna</h3>
                </div>
                <form class="form-horizontal" method="post"
                    action="<?php echo base_url().'pengguna/tambah_pengguna'?>">
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Nama</label>
                            <div class="col-xs-9">
                                <input name="nama" class="form-control" type="text" placeholder="Input Nama..."
                                    style="width:280px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Username</label>
                            <div class="col-xs-9">
                                <input name="username" class="form-control" type="text" placeholder="Input Username..."
                                    style="width:280px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Password</label>
                            <div class="col-xs-9">
                                <input name="password" class="form-control" type="password"
                                    placeholder="Input Password..." style="width:280px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Ulangi Password</label>
                            <div class="col-xs-9">
                                <input name="password2" class="form-control" type="password"
                                    placeholder="Ulangi Password..." style="width:280px;" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Level</label>
                            <div class="col-xs-9">
                                <select name="level" class="form-control" style="width:280px;" required>
                                    <option value="1">Admin</option>
                                    <option value="2">Kasir</option>
                                    <option value="3">Gudang</option>
                                    <option value="4">Sales</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <hr>

    <!-- Footer -->
    <?php 
        $this->load->view('include/footer');
   ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#mydata').DataTable();
        });
    </script>

    </body>

    </html>