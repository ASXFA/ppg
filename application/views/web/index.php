<?php $ceks = $this->session->userdata('no_pendaftaran'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PENDATAAN DAN PENATAAN PEDAGANG GASIBU</title>
    <base href="<?php echo base_url(); ?>" />

    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <!-- Bootstrap Core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/faa.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="assets/css/freelancer.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom bxshad">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top"><img src="img/logo.png" alt="Logo" width="30" style="position:absolute;margin-top:-10px;"> <span style="margin-left:35px;">PPG Online</span> </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio"><img src="img/logo.png" alt="Logo" width="15"> Tentang PPG</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about"><i class="fa fa-info-circle"></i> Informasi</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact"><i class="fa fa-phone-square"></i> Kontak Kami</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <?php
        if (strtolower($this->uri->segment(1)) == 'logcs') {
            $this->load->view('web/login');
        } ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="img/logo.png" style="margin-top:-15%;margin-bottom:0px;" width="100">
                    <div class="intro-text">
                        <span class="name shad" style="font-size:35px">PENDATAAN DAN PENATAAN PEDAGANG GASIBU</span>

                        <br>
                        <?php if ($web_ppg->status_ppg == 'buka') { ?>
                            <hr class="star-light">
                            <br>
                            <!-- <h3>Login Calon Siswa Terdaftar di PPDB Online SMP NEGERI 1 PAMULIHAN</h3> -->
                            <span>
                                <a href="pendaftaran" class="btn btn-success btn-lg" style="width:300px;margin:5px;"><i class="fa fa-file faa-pulse animated"></i> &nbsp;Pendaftaran PPG Online</a>
                                <a href="logcs" class="btn btn-success btn-lg" style="width:300px;margin:5px;"><i class="fa fa-users faa-pulse animated"></i> &nbsp;<?php if ($ceks == '') {
                                                                                                                                                                        echo "Login";
                                                                                                                                                                    } else {
                                                                                                                                                                        echo "Panel";
                                                                                                                                                                    } ?> Pedagang</a>
                                <br>
                            </span>
                        <?php } else { ?>
                            <span class="skills">
                            </span>
                            <br> <br>
                            <hr class="star-light">
                            <br>
                            <!-- <h3>Login Calon Siswa Terdaftar di PPDB Online SMP NEGERI 1 PAMULIHAN</h3> -->
                            <span>
                                <a href="javascript:void(0);" class="btn btn-success btn-lg" style="margin:5px;"><i class="fa fa-file faa-pulse animated"></i> &nbsp;Pendaftaran PPDB Online ditutup</a>
                                <br>
                            </span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Pemetaan Pedagang Gasibu</h2>
                    <hr class="star-primary">

                </div>
            </div>
            <center>
                <div class="row">
                    <div class="col-sm-12 portfolio-item">
                        <img src="img/logo.png" class="img-thumbnail" alt=""><br><br>
                        </a>
                    </div>
            </center>
        </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Informasi PPG ONLINE</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2" style="text-align:justify">
                    <p>Dengan adanya PPG ONLINE ini kami mengharapkan pendataan yang berada di Gasibu akan lebih cepat dan tepat karena mudah nya proses untuk mendaftar. </p>
                </div>
                <div class="col-lg-4" style="text-align:justify">
                    <p>Pengisian form PPG ONLINE mohon diperhatikan data yang dibutuhkan yang nantinya akan dipakai dalam proses PPG. Setelah proses pengisian form PPG secara online berhasil dilakukan, pedagang akan mendapat bukti daftar dengan nomor pendaftaran dan harus disimpan yang akan digunakan untuk proses selanjutnya.</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center page-scroll">
                    <a href="#page-top" class="btn btn-md btn-outline">
                        <i class="fa fa-pencil-square-o "></i> PPG ONLINE
                    </a> &nbsp;&nbsp;
                    <a href="#prosedur" class="btn btn-md btn-outline">
                        <i class="fa fa-tasks"></i> Prosedur PPG ONLINE
                    </a>&nbsp;&nbsp;
                    <a href="logcs" class="btn btn-md btn-outline">
                        <i class="fa fa-sign-in"></i> <?php if ($ceks == '') {
                                                            echo "Login";
                                                        } else {
                                                            echo "Panel";
                                                        } ?> Pedagang
                    </a>&nbsp;&nbsp;

                </div>
            </div>
        </div>
    </section>

    <section id="prosedur">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Prosedur PPG Online</h2>
                    <hr class="star-primary">
                    <ol style="font-size:18px;text-align:justify">
                        <li>Pedagang mendaftarkan diri atau melakukan <b><a href="pendaftaran">Pendaftaran PPG <i>online</i></a></b> melalui website <b><a href="">PPG ONLINE</a></b>.</li>
                        <li>Setelah Pedagang berhasil melakukan pendaftaran, Pedagang wajib melakukan <b>Print Out Pendaftaran & Mempersiapkan Kelengkapan Berkas PPG ONLINE</b>.</li>
                        <li>Admin PPG melakukan <b>Verifikasi dan Validasi Berkas Pendaftaran</b>.</li>
                        <li>PENGUMUMAN HASIL PPG ONLINE bisa dilihat di Web PPG ONLINE. Untuk <b>Username</b> sesuaikan dengan <b>NIK</b> & <b>Passwordnya</b> yaitu <b>No. Pendaftaran</b> Pedagang tersebut.</li>
                        <li>Jika Pedagang dinyatakan <b>LOLOS</b> maka Pedagang dapat mencetak bukti yang berupa kartu untuk menjadi identitas saat akan berjualan di Gasibu</b>.</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="success" id="contact">
        <!-- <div class="container"> -->
        <div class="row" style="margin-top:-100px;margin-bottom:-105px;">
            <div class="col-lg-4 text-center">
                <br><br>
                <h2>Kontak Kami</h2>
                <hr class="star-light">
                <h4>
                    Repeh Rapih Kertaraharja <br><br>
                </h4>
                <span style="color:#222;"><b><i class="fa fa-phone-square"></i> 022-14045</b> </span>
                &nbsp;
                <span class="eml" style="color:#222;"><i class="fa fa-envelope"></i> ppgonline@info.com</span>
                <br>
                <h4 class="btn btn-success">PPG ONLINE </h4></a>
            </div>
            <div class="col-lg-8 text-center">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9296027003697!2d107.61482811538862!3d-6.8990230694335395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e64dc8126bb5%3A0xf8b482f96c27424!2sGasibu!5e0!3m2!1sid!2sid!4v1601071369366!5m2!1sid!2sid" width="100%" height="465" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
        <!-- </div> -->
    </section>



    <!-- Footer -->
    <footer class="text-center">

        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; PPG ONLINE</a> <?php echo date('Y'); ?> | Hamba Allah
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- jQuery -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="assets/js/jqBootstrapValidation.js"></script>
    <script src="assets/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="assets/js/freelancer.min.js"></script>

</body>

</html>