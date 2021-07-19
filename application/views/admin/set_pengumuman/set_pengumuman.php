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
          <h5 class="panel-title"> Setting Pengumuman</h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>

          <div class="input-group">
            <div class="input-group-addon"><i class="icon-calendar22"></i></div>
            <select class="form-control" name="thn" onchange="thn()">
              <?php for ($i = date('Y'); $i >= 2018; $i--) { ?>
                <option value="<?php echo $i; ?>" <?php if ($v_thn == $i) {
                                                    echo "selected";
                                                  } ?>>Tahun <?php echo $i; ?></option>
              <?php } ?>
            </select>
          </div>


        </div>
        <div class="table-responsive">
          <table class="table datatable-basic table-bordered" width="100%">
            <thead>
              <tr>
                <th width="30px;">No.</th>
                <th>Nama Lengkap</th>
                <th>No Pendaftaran</th>
                <th>NIK</th>
                <th>NO KK</th>
                <th>Nama Dagangan</th>
                <th>Jenis Dagangan</th>
                <th>Blok Dagangan</th>
                <th>Wilayah</th>
                <th>Alamat Dagangan</th>
                <th>Status Pedagang</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($v_pedagang->result() as $baris) { ?>

                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $baris->nama_lengkap; ?></td>
                  <td><?php echo $baris->no_pendaftaran; ?></td>
                  <td><?php echo $baris->nik; ?></td>
                  <td><?php echo $baris->nokk; ?></td>
                  <td><?php echo $baris->nama_dagangan; ?></td>
                  <td><?php echo $baris->jns_dagangan; ?></td>
                  <td><?php foreach ($v_blok as $v) {
                        if ($v->id_blok == $baris->blokdagangan) {
                          echo $v->nama_blok . " " . $baris->bloknomor;
                        }
                      } ?></td>
                  <td><?php foreach ($kelurahan as $k) {
                        if ($k->id_kelurahan == $baris->id_kelurahan_dagangan) {
                          echo $k->nama_kelurahan;
                        }
                      } ?></td>
                  <td><?php echo $baris->detail_lokasi_dagangan; ?></td>
                  <td align="center"><?php if ($baris->status_verifikasi == 'diterima') { ?>
                      <label class="label label-success">Diterima</label>
                    <?php } else if ($baris->status_verifikasi == 'ditolak') { ?>
                      <label class="label label-danger">Ditolak</label>
                    <?php } else { ?>
                      <label class="label label-warning">Menunggu</label>
                    <?php } ?>
                  </td>
                  <?php
                  $id = $baris->id_siswa;
                  ?>

                  <td align="center">
                    <a href="panel_admin/terima/<?php echo $baris->id_pedagang; ?>">Terima</a>
                    &nbsp;
                    <a href="panel_admin/tolak/<?php echo $baris->id_pedagang; ?>">Tolak</a>
                  </td>
                </tr>

              <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /basic datatable -->
    </div>
    <!-- /dashboard content -->

    <script type="text/javascript">
      function thn() {
        var thn = $('[name="thn"]').val();
        window.location = "panel_admin/set_pengumuman/thn/" + thn;
      }

      $('[name="thn"]').select2({
        placeholder: "- Tahun -"
      });
    </script>