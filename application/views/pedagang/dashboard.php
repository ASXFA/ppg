Fweb<?php
    $cek    = $user->row();
    $id_user = $cek->id_pedagang;
    $nama    = $cek->nama_lengkap;

    $tgl = date('m-Y');
    ?>

<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat bg-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            <?php if ($cek->status_pendaftaran == 'berhasil') { ?>
              <center>Selamat Datang, <?php echo ucwords($nama); ?> pendaftaran anda berhasil.</center>
            <?php } ?>
          </h3>
        </div>
      </div>
      <!-- /basic datatable -->

      <div class="row">
        <div class="col-lg-12">
          <?php if ($web_ppg->status_ppg == 'buka') { ?>

            <?php if ($cek->status_verifikasi == 'diterima') { ?>
              <div class="panel panel-flat bg-success">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <center>
                      <i class="glyphicon glyphicon-bullhorn"></i> Selamat <b><?php echo $nama; ?></b> <span class="label label-info" style="font-size:20px;">TERVERIFIKASI</span> <b>PPG ONLINE</b>, Silahkan Cetak Kartu Sebagai Bukti <b><?php echo $nama; ?></b> Sudah Terverifikasi.
                      <hr style="margin:0px;margin-bottom:10px;">
                    </center>
                  </h4>
                </div>
              </div>
            <?php } elseif ($cek->status_verifikasi == 'ditolak') { ?>
              <div class="panel panel-flat bg-warning">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <center>
                      <i class="glyphicon glyphicon-bullhorn"></i> Mohon Maaf <b><?php echo $nama; ?></b>
                      <span class="label label-danger" style="font-size:20px;">GAGAL TERVEFIRIKASI</span>
                      Dan Belum Bisa Terdaftar di <b>PPG ONLINE</b> Silahkan Cek Kembali Data Untuk Memperbaiki Yang Salah, Jika Tidak Menemukan Kesalahan Kontak CS <b>PPG ONLINE</b> Untuk Info Lebih Lanjut.
                    </center>
                  </h4>
                </div>
              </div>
            <?php } ?>



          <?php } else { ?>
            <div class="panel panel-flat bg-warning">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <center>
                    <i class="glyphicon glyphicon-bullhorn"></i> Mohon Maaf Belum Ada Pengumuman<br>
                    <span class="label label-danger" style="font-size:20px;">Mohon Tunggu</span>
                  </center>
                </h4>
              </div>
            </div>
          <?php } ?>

          <!-- Quick stats boxes -->
          <div class="row">
            <div class="col-lg-3">
              <!-- Current server load -->
              <center>
                <a href="panel_pedagang/biodata">
                  <div class="panel bg-green">
                    <div class="panel-body">
                      <div class="heading-elements">
                        <span class="heading-text"></span>
                      </div>
                      <h1 class="no-margin">
                        <i class="icon-file-check2" style="font-size:200px;"></i>
                      </h1>
                      Biodata Pendaftaran
                    </div>
                  </div>
                </a>
              </center>
              <!-- /current server load -->
            </div>

            <?php if ($web_ppg->status_ppg == 'tutup') { ?>
              <!-- <?php if ($cek->status_verifikasi == 'diterima') { ?>
                <div class="col-lg-3">
                  <center>
                    <a href="panel_pedagang/cetak_lulus" target="_blank">
                      <div class="panel bg-teal-400">
                        <div class="panel-body">
                          <div class="heading-elements">
                            <span class="heading-text"></span>
                          </div>
                          <h1 class="no-margin">
                            <i class="icon-printer2" style="font-size:200px;"></i>
                          </h1>
                          Cetak Bukti Kelulusan
                        </div>
                      </div>
                    </a>
                  </center>
                </div>
                <?php } ?><?php } ?> -->


              <div class="col-lg-3">
                <!-- Current server load -->
                <center>
                  <a href="files/Panduan_PPDB_Online_SMAN1_Belitang.pdf">
                    <div class="panel bg-orange-400">
                      <div class="panel-body">
                        <div class="heading-elements">
                          <span class="heading-text"></span>
                        </div>
                        <h1 class="no-margin">
                          <i class="icon-file-download2" style="font-size:200px;"></i>
                        </h1>
                        Download Panduan
                      </div>
                    </div>
                  </a>
                </center>
                <!-- /current server load -->
              </div>

          </div>
          <!-- /quick stats boxes -->


        </div>

      </div>

    </div>
    <!-- /dashboard content -->