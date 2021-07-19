<style>
  #tbl_input {
    width: 50px;
    text-align: center;
  }

  #tbl_input2 {
    width: 100px;
    text-align: center;
  }

  #th_center>th {
    text-align: center;
  }
</style>

<?php
error_reporting(0);
$user = $user->row(); ?>
<!-- Main content -->
<div class="content-wrapper">

  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-flat">
          <div class="panel-body">
            <center>
              <img src="img/logo.png" alt="<?php echo $user->nama_lengkap; ?>" class="" width="176">
            </center>
            <br>
            <fieldset class="content-group">
              <hr style="margin-top:0px;">
              <i class="icon-calendar"></i> <b>Tanggal Daftar</b> :
              <?php echo $this->Model_data->tgl_id(date('d-m-Y H:i:s', strtotime($user->tgl_pedagang))); ?>
              <hr>
              <!-- <b>Rayonisasi : <?php echo $user->rayonisasi; ?></b> -->
            </fieldset>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="panel panel-flat">
          <div class="panel-body">
            <fieldset class="content-group">
              <legend class="text-bold"><i class="icon-user"></i> Biodata Pedagang</legend>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <tr>
                    <th width="20%">NO. PENDAFTARAN</th>
                    <th width="1%">:</th>
                    <td><?php echo $user->no_pendaftaran; ?></td>
                  </tr>
                  <tr>
                    <th>N.I.K</th>
                    <th>:</th>
                    <td><?php echo $user->nik; ?></td>
                  </tr>
                  <tr>
                    <th>No KK</th>
                    <th>:</th>
                    <td><?php echo $user->nokk; ?></td>
                  </tr>
                  <th>Nama Lengkap</th>
                  <th>:</th>
                  <td><?php echo ucwords($user->nama_lengkap); ?></td>
                  </tr>
                  <tr>
                    <th>Jenis Kelamin</th>
                    <th>:</th>
                    <td><?php echo $user->jk; ?></td>
                  </tr>
                  <tr>
                    <th>Tempat, Tgl Lahir</th>
                    <th>:</th>
                    <td><?php echo "$user->tempat_lahir, " . $this->Model_data->tgl_id($user->tgl_lahir); ?></td>
                  </tr>
                  <tr>
                    <th>Agama</th>
                    <th>:</th>
                    <td><?php echo $user->agama; ?></td>
                  </tr>
                  <th>Alamat</th>
                  <th>:</th>
                  <td><?php echo $user->alamat_pedagang; ?></td>
                  </tr>
                  <tr>
                    <th>No. Handphone</th>
                    <th>:</th>
                    <td><?php echo $user->no_hp_pedagang; ?></td>
                  </tr>
                  <tr>
                    <th>Keanggotaan</th>
                    <th>:</th>
                    <td><?php if ($user->tgl_keanggotaan == NULL) {
                          echo "-";
                        } else {
                          echo date('d F Y', strtotime($user->tgl_keanggotaan));
                        } ?></td>
                  </tr>

                </table>
              </div>
            </fieldset>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="panel panel-flat">
          <div class="panel-body">
            <fieldset class="content-group">
              <legend class="text-bold"><i class="icon-user"></i> Data Dagangan</legend>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <tr>
                    <th width="20%">Nama Lengkap</th>
                    <th width="1%">:</th>
                    <td><?php echo ucwords($user->nama_dagangan); ?></td>
                  </tr>
                  <tr>
                    <th>Jenis Dagangan</th>
                    <th>:</th>
                    <td><?php echo $user->jns_dagangan; ?></td>
                  </tr>
                  <th>No. Handphone</th>
                  <th>:</th>
                  <td><?php echo $user->no_hp_dagangan; ?></td>
                  </tr>
                </table>
              </div>
            </fieldset>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="panel panel-flat">
          <div class="panel-body">
            <fieldset class="content-group">
              <legend class="text-bold"><i class="icon-user"></i> Data Lokasi</legend>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <tr>
                    <th width="20%">Blok Dagangan</th>
                    <th width="1%">:</th>
                    <td><?php echo ($ngambilblok->nama_blok); ?></td>
                  </tr>
                  <tr>
                    <th width="20%">Blok Nomor Dagangan</th>
                    <th width="1%">:</th>
                    <td><?php echo ($ngambilblok->nama_blok) . " - " . ($user->bloknomor); ?></td>
                  </tr>
                  <tr>
                    <th width="20%">Penanggung Jawab</th>
                    <th width="1%">:</th>
                    <td><?php echo ($ngambilblok->pj_blok); ?></td>
                  </tr>
                  <tr>
                    <th width="20%">No HP Penanggung Jawab</th>
                    <th width="1%">:</th>
                    <td><?php echo ($ngambilblok->no_hp_pj); ?></td>
                  </tr>
                  <tr>
                    <th>Lokasi Dagang</th>
                    <th>:</th>
                    <td><?php echo $ngambilblok->detail_lokasi_dagangan; ?></td>
                  </tr>
                  <tr>
                    <th>Wilayah Dipilih </th>
                    <th>:</th>
                    <?php $kel = $this->db->get_where('tbl_kelurahan', "id_kelurahan='$ngambilblok->id_kelurahan_dagangan'")->row(); ?>
                    <td><?php echo "Kelurahan " . $kel->nama_kelurahan ?></td>
                  </tr>
                </table>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
      </table>
    </div>
    </fieldset>
  </div>
</div>
</div>


</div>
<!-- /dashboard content -->