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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <style>
        #mapid {
            height: 600px;
        }

        .button {
            margin-top: 10px;
            background-color: #2B589C;
            width: 100px;
            /* Green */
            border: none;
            color: white !important;
            padding: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
        }

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            text-align: left;
            line-height: 18px;
            color: #555;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>
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
                        <a href="logcs"> <i class="fa fa-user"></i> &nbsp;<?php if ($ceks == '') {
                                                                                echo "Login";
                                                                            } else {
                                                                                echo "Panel";
                                                                            } ?> Pedagang</a></a>
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

    <!-- Portfolio Grid Section -->
    <section>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Pemetaan Pedagang Gasibu</h2>
                <hr class="star-primary">

            </div>
        </div>
        <center>
            <div class="row">
                <div class="col-sm-12 portfolio-item">
                    <div id="mapid"></div>
                </div>
            </div>
        </center>
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
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="<?= base_url() ?>assets/leaflet.ajax.js"></script>
    <script>
        var mymap = L.map('mapid').setView([-7.0121636, 107.633879], 13);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 20,
            id: 'mapbox/light-v9',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }).addTo(mymap);
        var p = 0;
        var n = 0;
        var id = '';


        function getColor(d) {
            return d == 2 ? '#ff0000' :
                // d < 0.5 ? '#BD0026' :
                // d > 0.5 ? '#E31A1C' :
                // d > 0.3 ? '#FC4E2A' :
                // d > 0.1 ? '#FD8D3C' :
                '#009933';
        }

        // control that shows state info on hover
        var info = L.control();

        info.onAdd = function(mymap) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
        };

        info.update = function(props) {
            this._div.innerHTML = '<h4>KECAMATAN BALEENDAH</h4>' + (props ?
                '<b> Kelurahan ' + props.NAME_4 + '</b>' :
                'Geser mouse pada peta untuk mendapatkan informasi Nama Kelurahan');
        };

        info.addTo(mymap);

        function popUp(f, layer) {
            var out = [];
            if (f.properties) {
                // // out.push(key + ": " + f.properties[key]);
                // out.push("Provinsi : " + f.properties['NAME_1']);
                // out.push("Kota : " + f.properties['NAME_2']);
                // out.push("Kecamatan : " + f.properties['NAME_3']);
                // out.push("Kelurahan / Desa : " + f.properties['NAME_4']);
                // out.push("Positif : " + p);
                // out.push("Negatif : " + n);
                // out.push(id);
                // layer.bindPopup(out.join("<br />"));
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetHighlight
                });
            }
        }

        function style(nilai) {
            return {
                fillColor: getColor(nilai),
                weight: 2,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 1
            };
        }


        function highlightFeature(e) {
            var layer = e.target;

            // layer.setStyle({
            //     weight: 5,
            //     color: '#ddd',
            //     dashArray: '1',
            //     fillOpacity: 1
            // });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }
            info.update(layer.feature.properties);
        }


        var geojson;

        function resetHighlight(e) {
            // geojson.resetStyle(e.target);
            info.update();
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        mymap.createPane('labels');

        // This pane is above markers but below popups
        mymap.getPane('labels').style.zIndex = 650;

        // Layers in this pane are non-interactive and do not obscure mouse/touch events
        mymap.getPane('labels').style.pointerEvents = 'none';

        var cartodbAttribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="https://carto.com/attribution">CARTO</a>';

        var positron = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png', {
            attribution: cartodbAttribution
        }).addTo(mymap);

        var positronLabels = L.tileLayer('http://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}.png', {
            attribution: cartodbAttribution,
            pane: 'labels'
        }).addTo(mymap);


        <?php
        foreach ($kelurahan as $k) :
        ?>
            p = <?= $k->positif_kelurahan ?>;
            n = <?= $k->negatif_kelurahan ?>;
            id = "<a href='<?= $k->id_kelurahan ?>' class='btn btn-sm btn-primary'>Daftar </a>";
            geojson = new L.GeoJSON.AJAX(['assets/<?= $k->file_geo_kelurahan ?>'], {
                style: style(<?= $k->nilai_kmeans_kelurahan ?>),
                onEachFeature: popUp
            }).addTo(mymap).bindPopup('Kelurahan : <?= $k->nama_kelurahan ?> <br> Kasus Positif : <?= $k->positif_kelurahan ?> Orang <br> Kasus Negatif : <?= $k->negatif_kelurahan ?> Orang');
            geojson.eachLayer(function(layer) {
                layer.bindPopup(layer.feature.properties.NAME_4);
            });
        <?php
        endforeach;
        ?>
        var legend = L.control({
            position: 'bottomright'
        });

        legend.onAdd = function(mymap) {

            var div = L.DomUtil.create('div', 'info legend'),
                grades = [0, 1],
                labels = [],
                from, to;

            for (var i = 0; i < grades.length; i++) {
                from = i + 1;

                if (from == 1) {
                    labels.push(
                        '<i style="background:' + getColor(from) + '"></i> Zona Hijau<br>');
                } else {
                    labels.push(
                        '<i style="background:' + getColor(from) + '"></i> Zona Merah<br>');
                }
            }

            div.innerHTML = labels.join('<br>');
            return div;
        };

        legend.addTo(mymap);

        // var jsonTest = new L.GeoJSON.AJAX(['assets/baleendah.geojson'], {
        //     onEachFeature: popUp
        // }).addTo(mymap);
        // var jsonTest = new L.GeoJSON.AJAX(['assets/andir.geojson'], {
        //     onEachFeature: popUp
        // }).addTo(mymap);
        // var jsonTest = new L.GeoJSON.AJAX(['assets/bojongmalaka.geojson'], {
        //     onEachFeature: popUp
        // }).addTo(mymap);
        // var jsonTest = new L.GeoJSON.AJAX(['assets/jelekong.geojson'], {
        //     onEachFeature: popUp
        // }).addTo(mymap);
        // var jsonTest = new L.GeoJSON.AJAX(['assets/malakasari.geojson'], {
        //     onEachFeature: popUp
        // }).addTo(mymap);
        // var jsonTest = new L.GeoJSON.AJAX(['assets/manggahang.geojson'], {
        //     onEachFeature: popUp
        // }).addTo(mymap);
        // var jsonTest = new L.GeoJSON.AJAX(['assets/rancamanyar.geojson'], {
        //     onEachFeature: popUp
        // }).addTo(mymap);
        // var jsonTest = new L.GeoJSON.AJAX(['assets/wargamekar.geojson'], {
        //     onEachFeature: popUp
        // }).addTo(mymap);
    </script>
</body>

</html>