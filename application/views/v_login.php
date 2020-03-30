<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title ?></title>

  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url().'assets/css/all.min.css'?>" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url().'assets/css/sb-admin.css'?>" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style type="text/css">
        .preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 10;
                background-color: #fff;
        }
        .preloader .loading {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
                font: 14px arial;
        }
    </style> 
</head>

<body class="bg-dark">
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="container">

    <div class="page-content container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="login-wrapper">
            <div class="box">
              <div class="content-wrap">
                
                <p><?php echo $this->session->flashdata('msg');?></p>
                <hr />
                <form action="<?php echo base_url().'login/cekuser'?>" method="post" id="form">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" id="username" name="username" class="form-control" required="required"
                        autofocus="autofocus">
                      <label for="username">Username</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="password" id="password" name="password" class="form-control" required="required"
                        autofocus="autofocus">
                      <label for="inputPassword">Password</label>
                      <div class="form-group">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="remember-me">
                            Remember Password
                          </label>
                        </div>
                      </div>
                      <button class="btn btn-primary btn-block" type="submit">Login </button>
                      <br>
                </form>
              </div>
            </div>
          </div>
          <p id="getUserIP" class="login-box-msg"></p>


          <!-- Bootstrap core JavaScript-->
          <script src="<?php echo base_url().'assets/jquery/jquery.min.js'?>"></script>
          <script src="<?php echo base_url().'assets/js/bootstrap.bundle.min.js'?>"></script>
          <!-- Core plugin JavaScript-->
          <script src="<?php echo base_url().'assets/jquery-easing/jquery.easing.min.js'?>"></script>
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
          <script type="text/javascript">
            $(function () {
              $("form").submit(function () {
                $(".preloader").show();
                $.ajax({
                  url: $(this).attr("action"),
                  data: $(this).serialize(),
                  type: $(this).attr("method"),
                  dataType: 'html',
                  success: function (data) {
                    $(".preloader").hide();
                    var obj = jQuery.parseJSON(data);
                    if (obj.status === "success") {
                      window.location.replace("<?php echo base_url('welcome') ?>");
                    } else if (obj.status === "password") {
                      swal("Sorry", "Password Salah", "error");
                    } else if (obj.status === "username") {
                      swal("Sorry", "Username Salah", "error");
                    } else {
                      swal("Sorry", "Error Hubungi IT Support", "error");
                    }
                  },
                  error: function (data) {
                    $(".preloader").hide();
                    // $("#form")[0].reset();
                    swal("Sorry", "Password Salah", "error");
                  },
                })
                return false;
              });
            });
          </script>
          <script>
            $.ajax({
              type: "GET",
              url: '<?php echo base_url('login/getUserIP') ?>',
              success: function (response) {
                $('#getUserIP').append(`Your IP <b>` + response + `</b> `);
              }
            });
          </script>

</body>

</html>