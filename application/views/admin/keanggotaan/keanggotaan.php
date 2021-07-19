<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">
    <?php
    echo $this->session->flashdata('msg');
    ?>
    <!-- Dashboard content -->
    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h5 class="panel-title d-inline"> Permohonan Pedagang</h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>  

        </div>
        <div class="table-responsive">
        <table class="table datatable-basic table-bordered" width="100%">
          <thead>
            <tr>
              <th width="30px;">No.</th>
              <th>Nama Pemohon</th>
              <th>Perihal</th>
              <th>Tanggal Keanggotaan Awal</th>
              <th>Jangka Waktu Perpanjangan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
                <?php 
                    $no = 1;
                    foreach($keanggotaan as $k):
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td>
                        <?php 
                            foreach($pedagang as $pdg):
                                if($pdg->id_pedagang == $k->user_id){
                                    echo $pdg->nama_lengkap;
                                }
                            endforeach
                        ?>
                    </td>
                    <td><?= $k->perihal ?></td>
                    <td><?= date('d F Y',strtotime($k->tgl_keanggotaan_awal)) ?></td>
                    <td><?= $k->jangka ?> Tahun</td>
                    <td>
                        <?php  
                            if($k->status == 0){
                                echo "<span class='badge badge-info'> Menunggu Respon </span>";
                            }else if($k->status == 1){
                                echo "<span class='badge badge-success'> Diterima </span>";
                            }else if($k->status == 2){
                                echo "<span class='badge badge-danger'> Ditolak </span>";
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            if($k->status == 0){
                                ?>
                                <a href="<?= base_url('panel_admin/editStatusKeanggotaan/'.$k->id.'/1/'.$k->user_id.'/'.$k->tgl_keanggotaan_awal.'/'.$k->jangka) ?>" class="btn btn-success btn-sm">Diterima</a>
                                <a href="<?= base_url('panel_admin/editStatusPermohonan/'.$k->id.'/2/'.$k->user_id.'/'.$k->tgl_keanggotaan_awal.'/'.$k->jangka) ?>" class="btn btn-warning btn-sm">Ditolak</a>
                        <?php
                            }
                        ?>
                        <a href="<?= base_url('panel_admin/deleteKeanggotaan/'.$k->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin dihapus ? ')" >Delete</a>
                    </td>
                </tr>
                <?php $no++; endforeach ?>
          </tbody>
        </table>
        </div>
      </div>
      <!-- /basic datatable -->
    </div>
    <!-- /dashboard content -->
<div class="modal" id="tambahModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Iuran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <form action="<?= base_url('panel_admin/tambahIuran') ?>" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="form-control-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-control-label">Nama Petugas</label>
                    <input type="text" name="nama_petugas" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-control-label">Tipe</label>
                    <select name="tipe" id="" class="form-control">
                        <option value="Keamanan">Keamanan</option>
                        <option value="Kebersihan">Kebersihan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="form-control-label">Blok</label>
                    <select name="blok" id="" class="form-control">
                        <?php foreach($blok as $b): ?>
                            <option value="<?= $b->id_blok ?>"> <?= $b->nama_blok ?></option>
                        <?php endforeach ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="" class="form-control-label">Penghasilan</label>
                    <input type="number" name="penghasilan" min="0" class="form-control" required>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Tambah</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php foreach($iuran as $i): ?>
<div class="modal" id="editModal<?= $i->id ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Iuran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <form action="<?= base_url('panel_admin/editIuran/'.$i->id) ?>" method="post">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="form-control-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $i->tanggal ?>" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-control-label">Nama Petugas</label>
                    <input type="text" name="nama_petugas" value="<?= $i->nama_petugas ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="" class="form-control-label">Tipe</label>
                    <select name="tipe" id="" class="form-control">
                        <?php 
                          if($i->blok == 'Keamanan'){
                            echo "<option value='Keamanan' selected> Kemanan </option>
                            <option value='Kebersihan'> Kebersihan </option>
                            ";
                          }else{
                            echo "<option value='Keamanan'> Kemanan </option>
                            <option value='Kebersihan' selected> Kebersihan </option>
                            ";
                          }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="form-control-label">Blok</label>
                    <select name="blok" id="" class="form-control">
                        <?php foreach($blok as $b): ?>
                            <option value="<?= $b->id_blok ?>" <?php if($b->id_blok == $i->id ){ echo "selected";} ?>> <?= $b->nama_blok ?></option>
                        <?php endforeach ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="" class="form-control-label">Penghasilan</label>
                    <input type="number" name="penghasilan" value="<?= $i->penghasilan ?>" min="0" class="form-control" required>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach ?>
<script type="text/javascript">
  function thn()
  {
    var thn = $('[name="thn"]').val();
      window.location = "panel_admin/set_pengumuman/thn/"+thn;
  }

  $('[name="thn"]').select2({
      placeholder: "- Tahun -"
  });

</script>
