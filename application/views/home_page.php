<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/home/images/kpu-logo.png" rel="icon">
    <title>Homepage | Koperasi KPU</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/home/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/css/fontawesome.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/css/owl.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/home/css/lightbox.css">
</head>

<body>
    <section class="section main-banner" id="top" data-section="section1">
        <div id="bg-img">
            <img src="<?php echo base_url() ?>assets/home/images/home.jpg" style="width: 100%;" />
        </div>

        <div class="img-overlay header-text">
            <div class="caption" data-aos-delay="100">
                <h6>KOMISI PEMILIHAN UMUM REPUBLIK INDONESIA</h6>
                <h1><em>SIKPUBA</em></h1>
                <h5>(SISTEM INFORMASI KOPERASI KPU KOTA BANDAR LAMPUNG)</h5>
                <div class="main-button">
                    <a href="<?= base_url('login'); ?>">LOGIN</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fa fa-copyright"></i> Hak Cipta <?= date('Y'); ?> - Komisi Pemilihan Umum Kota Bandar Lampung</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url() ?>assets/home/jquery/jquery.min.js"></script>
    <script src="assets/home/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo base_url() ?>assets/home/js/isotope.min.js"></script>
    <script src="<?php echo base_url() ?>assets/home/js/owl-carousel.js"></script>
    <script src="<?php echo base_url() ?>assets/home/js/lightbox.js"></script>
    <script src="<?php echo base_url() ?>assets/home/js/tabs.js"></script>
    <script src="<?php echo base_url() ?>assets/home/js/video.js"></script>
    <script src="<?php echo base_url() ?>assets/home/js/slick-slider.js"></script>
    <script src="<?php echo base_url() ?>assets/home/js/custom.js"></script>
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