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
        <div class="row">
      <form action="" method="get">
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Tahun</label>
          <div class="col-sm-10">
            <select name="thn" id="" class="form-control">
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Pilih Bulan</label>
          <div class="col-sm-10">
            <select name="bln" id="" class="form-control">
              <option value="1">Januari</option>
              <option value="2">Februari</option>
              <option value="3">Maret</option>
              <option value="4">April</option>
              <option value="5">Mei</option>
              <option value="6">Juni</option>
              <option value="7">Juli</option>
              <option value="8">Agustus</option>
              <option value="9">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <input type="submit" class="btn btn-primary btn-sm" value="Submit">
      </div>
      </form>
    </div>
    <hr>
          <h5 class="panel-title d-inline"> Iuran Keamanan & Kebersihan</h5>
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
              <th>Tanggal Tagihan</th>
              <th>Nama Pedagang</th>
              <th>Blok</th>
              <th>Total Tagihan</th>
              <th>Jatuh Tempo</th>
              <th>Petugas Yang Terima Iuaran</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
        <?php 
          if (isset($iuran)) {
        ?>
          <tbody>
                <?php 
                    $no = 1;
                    foreach($iuran as $i):
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= date('d F Y', strtotime($i->tanggal)) ?></td>
                    <td>
                      <?php 
                        foreach($pedagang as $p):
                          if($p->id_pedagang == $i->user_id){
                            echo $p->nama_lengkap;
                          }
                        endforeach
                      ?>
                    </td>
                    <td>
                      <?php 
                        foreach($bloks as $b):
                          if($b->id_blok == $i->blok){
                            echo substr($b->nama_blok,5)." - ".$i->bloknomor;
                          }
                        endforeach
                      ?>
                    </td>
                    <td>Rp. <?= number_format($i->tagihan) ?></td>
                    <td><?= date('d F Y',strtotime($i->tempo)) ?></td>
                    <td>
                      <?php 
                        foreach($bloks as $b):
                          if($b->id_blok == $i->blok){
                            echo $b->pj_blok;
                          }
                        endforeach
                      ?>
                    </td>
                    <td>
                      <?php 
                        if($i->status == 1){
                          echo "<label class='label label-success'> Sudah Dibayar </label>";
                        }else{
                          echo "<label class='label label-danger'> Belum Dibayar </label>";
                        }
                      ?>
                    </td>
                    <td>
                        <?php if($i->status == 0){ ?>
                        <a href="<?= base_url('panel_admin/editIuran/'.$i->id.'/'.$_GET['thn'].'/'.$_GET['bln']) ?>" class="btn btn-warning btn-sm" onclick="return confirm('Bayar Sekarang ? ')">Bayar</a>
                        <?php } ?>
                        <a href="<?= base_url('panel_admin/deleteIuran/'.$i->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin dihapus ? ')" >Delete</a>
                    </td>
                </tr>
                <?php $no++; endforeach ?>
          </tbody>
        <?php } ?>
        </table>
        </div>
      </div>
      <!-- /basic datatable -->
      <?= $this->load->view('admin/denah') ?>
    </div>
    <!-- /dashboard content -->
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
