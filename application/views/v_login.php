<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/login2/fonts/icomoon/style.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/login2/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/login2/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/login2/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/login2/css/login.css">
  <link href="<?php echo base_url(); ?>assets/home/images/kpu-logo.png" rel="icon">
  <title>Halaman Login | Koperasi KPU</title>
  <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
  <script src="<?= base_url() ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
</head>

<body>
  <?php if ($this->session->flashdata('success_log_out')) { ?>
    <script>
      swal({
        title: "Success!",
        text: "Anda Berhasil Logout!",
        icon: "success",
        timer: 2000
      });
    </script>
  <?php } ?>
  <?php if ($this->session->flashdata('loggin_err_no_user')) { ?>
    <script>
      swal({
        title: "Error!",
        text: "Anda Belum Terdaftar!",
        icon: "error",
      });
    </script>
  <?php } ?>

  <?php if ($this->session->flashdata('loggin_err_pass')) { ?>
    <script>
      swal({
        title: "Error!",
        text: "Password Yang Anda Masukan Salah!",
        icon: "error",
      });
    </script>
  <?php } ?>
  <div class="content">
    <div class="container">
      <div class="row">
        <div id="row1" class="col-md-6">
          <div class="caption">
            <img src="<?php echo base_url() ?>assets/home/images/kpu-logo.png" alt="Logo" />
            <img src="<?php echo base_url() ?>assets/foto/logo/logo1.png" alt="Logo" />
            <h1>SIKPUBA</h1>
            <h5>SISTEM INFORMASI KOPERASI KPU KOTA BANDAR LAMPUNG</h5>
          </div>
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3 class="text-center"><i class="fas fa-sign-in"></i> Login</h3>
                <p class="mb-4">Silahkan login dengan akun anda untuk masuk ke aplikasi!</p>
              </div>
              <form action="<?= base_url('login/login'); ?>" method="post">
                <div class="form-group first">
                  <label for="username"><i class="fas fa-user"></i> Username</label>
                  <input type="text" name="username" class="form-control" id="username" required autofocus>
                </div>
                <div class="form-group last mb-4">
                  <label for="password"><i class="fas fa-lock"></i> Password</label>
                  <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <input type="submit" id="login" value="Login" class="btn btn-block">
              </form>
              <p class="mt-3">Kembali ke Homepage? Klik <a style="color: blue" href="<?= base_url('home'); ?>"> disini</a></p>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p><i class="fa fa-copyright"></i> Hak Cipta <?= date('Y'); ?> - Komisi Pemilihan Umum Kota Bandar Lampung</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="<?php echo base_url() ?>assets/login2/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url() ?>assets/login2/js/popper.min.js"></script>
  <script src="<?php echo base_url() ?>assets/login2/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/login2/js/main.js"></script>
  <script type="text/javascript">
    (function() {
      var options = {
        whatsapp: "0895612127792", // WhatsApp number
        call_to_action: "Message us", // Call to action
        button_color: "#FF6550", // Color of button
        position: "right", // Position may be 'right' or 'left'
      };
      var proto = document.location.protocol,
        host = "getbutton.io",
        url = proto + "//static." + host;
      var s = document.createElement('script');
      s.type = 'text/javascript';
      s.async = true;
      s.src = url + '/widget-send-button/js/init.js';
      s.onload = function() {
        WhWidgetSendButton.init(host, proto, options);
      };
      var x = document.getElementsByTagName('script')[0];
      x.parentNode.insertBefore(s, x);
    })();
  </script>
</body>

</html>