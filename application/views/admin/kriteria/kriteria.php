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
          <h5 class="panel-title">DATA BLOK & DAGANGAN</h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>

          <div class="col-md-6">
            <div class="panel panel-flat">
              <div class="panel-heading">
                <h5 class="panel-title d-inline-block"> DATA BLOK</h5>
                <a href="<?= base_url('panel_admin/tambah_blok') ?>" class="btn btn-primary btn-sm">Tambah Blok </a>
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
                      <th>Wilayah</th>
                      <th>Nama Blok</th>
                      <th>Penanggung Jawab</th>
                      <!-- <th>No HP PJ Blok</th> -->
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($v_blok->result() as $baris) { ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo "Kelurahan " . $baris->nama_kelurahan; ?></td>
                        <td><?php echo $baris->nama_blok . "1 - " . $baris->nama_blok . "" . $bloknumber->num_rows(); ?></td>
                        <td><?php echo $baris->pj_blok; ?></td>
                        <!-- <td><?php echo $baris->no_hp_pj; ?></td> -->
                        <td align="center"><a href="panel_admin/update_blok/<?php echo $baris->id_blok; ?>">Edit</a>
                        </td>
                      </tr>
                    <?php
                      $no++;
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="panel panel-flat">
              <div class="panel-heading">
                <h5 class="panel-title"> DATA JENIS DAGANGAN</h5>
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
                      <th>Jenis Dagangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($v_jns->result() as $baris) { ?>
                      <tr>
                        <td><?php echo $baris->id_jns; ?></td>
                        <td><?php echo $baris->nama_jns; ?></td>
                        <td align="center"><a href="panel_admin/update_jns/<?php echo $baris->id_jns; ?>">Edit</a>
                        </td>
                      </tr>
                    <?php
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <script type="text/javascript">
            function thn() {
              var thn = $('[name="thn"]').val();
              window.location = "panel_admin/verifikasi/thn/" + thn;
            }

            $('[name="thn"]').select2({
              placeholder: "- Tahun -"
            });
          </script>