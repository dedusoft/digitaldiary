<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>digitaldiary</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

    <!-- assets CSS Files -->
    <link href="<?= base_url(); ?>assets/bootstrapv4.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/nivo-slider/css/nivo-slider.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/owl.carousel/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/venobox/venobox.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- NavBar -->
    <header id="header" class="">
        <div class="container d-flex">

            <div class="logo mr-auto">
                <h1 class="text-light"><a href="index.html"><span>D</span>Diary</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="<?= base_url(); ?>img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="mx-2"><a class="btn-sm btn-primary" href="auth/login">Sign Out</a></li>

                </ul>
            </nav><!-- .nav-menu -->

        </div>
    </header><!-- End Header -->
    <main class="container">
        <div class="notes" id="app">

        </div>
    </main>

    <!-- assets JS Files -->
    <script src="<?= base_url(); ?>assets/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/bootstrapv4.6/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?= base_url(); ?>assets/php-email-form/validate.js"></script>
    <script src="<?= base_url(); ?>assets/appear/jquery.appear.js"></script>
    <script src="<?= base_url(); ?>assets/knob/jquery.knob.js"></script>
    <script src="<?= base_url(); ?>assets/parallax/parallax.js"></script>
    <script src="<?= base_url(); ?>assets/wow/wow.min.js"></script>
    <script src="<?= base_url(); ?>assets/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url(); ?>assets/nivo-slider/js/jquery.nivo.slider.js"></script>
    <script src="<?= base_url(); ?>assets/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url(); ?>assets/venobox/venobox.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>js/index.js"></script>

    <script src="js/main.js" type="module"></script>
</body>

</html>