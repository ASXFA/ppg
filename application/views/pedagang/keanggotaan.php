<style>
  #tbl_input{width:50px;text-align: center;}
  #tbl_input2{width:100px;text-align: center;}
  #th_center > th {text-align: center;}
</style>

<?php
error_reporting(0);
$user = $user->row();?>
<!-- Main content -->
<div class="content-wrapper">

  <!-- Content area -->
  <div class="content">
    <!-- Dashboard content -->
    <div class="row">

    <div class="col-md-6">
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
                      <td><?php echo "$user->tempat_lahir, ". $this->Model_data->tgl_id($user->tgl_lahir); ?></td>
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
                      <td><?php if($user->tgl_keanggotaan == NULL){echo "-";}else{echo date('d F Y', strtotime($user->tgl_keanggotaan));} ?></td>
                    </tr>
                    
                </table>
              </div>
            </fieldset>
          </div>
      </div>
    </div>
      <?php 
        if($keanggotaan->num_rows() > 0){
            $k = $keanggotaan->row();
            if($k->status != 0){
    ?>
            <div class="col-md-6">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <fieldset class="content-group">
                    <legend class="text-bold"><i class="icon-file-text"></i> Ajukan Permohonan</legend>
                        <form action="<?= base_url('panel_pedagang/tambahkeanggotaan/'.$user->id_pedagang) ?>" method="post">
                            <div class="form group">
                                <label for="" class="form-control-label">Tipe Permohonan</label>
                                <select name="tipe" id="" class="form-control">
                                    <option hidden>PILIH</option>
                                    <option value="Pindah Lokas">Perpanjang Keanggotaan</option>
                                </select>
                            </div>
                            <div class="form group">
                                <label for="" class="form-control-label">Tanggal Keanggotaan Anda</label>
                                <input type="date" name="tgl_keanggotaan_awal" value="<?= $user->tgl_keanggotaan ?>" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Pilih Jangka Tahun</label>
                                        <select name="jangka" id="" class="form-control">
                                            <option hidden>PILIH</option>
                                            <option value="1">1 Tahun</option>
                                            <option value="2">2 Tahun</option>
                                            <option value="3">3 Tahun</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form group">
                                <input type="submit" class="btn btn-primary float-right" value="Ajukan">
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
            </div>
        <?php
            }else{
                echo "<h4> Anda sudah melakukan pengajuan, ajuan anda sedang ditinjau admin, mohon tunggu ...  </h4>";
            }
        }else{

        ?>
        <div class="col-md-6">
        <div class="panel panel-flat">
            <div class="panel-body">
                <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-file-text"></i> Ajukan Permohonan</legend>
                    <form action="<?= base_url('panel_pedagang/tambahkeanggotaan/'.$user->id_pedagang) ?>" method="post">
                        <div class="form group">
                            <label for="" class="form-control-label">Tipe Permohonan</label>
                            <select name="tipe" id="" class="form-control">
                                <option hidden>PILIH</option>
                                <option value="Pindah Lokas">Perpanjang Keanggotaan</option>
                            </select>
                        </div>
                        <div class="form group">
                                <label for="" class="form-control-label">Tanggal Keanggotaan Anda</label>
                                <input type="text" name="tgl_keanggotaan_awal" value="<?= $user->tgl_keanggotaan ?>" class="form-control" readonly>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-control-label">Pilih Jangka Tahun</label>
                                    <select name="jangka" id="" class="form-control">
                                        <option hidden>PILIH</option>
                                        <option value="1">1 Tahun</option>
                                        <option value="2">2 Tahun</option>
                                        <option value="3">3 Tahun</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form group">
                            <input type="submit" class="btn btn-primary float-right" value="Ajukan">
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
        </div>
    <?php
        }
      ?>
              </table>
              </div>
            </fieldset>
          </div>
      </div>
      </div>


    </div>
    <!-- /dashboard content -->
