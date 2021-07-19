<div class="panel panel-primary">
  <div class="panel-heading">
    <h2><strong class="text-success" style="color:#eee;">Data Lokasi</strong></h2>
  </div>
  <div class="panel-body">

    <div class="form-group">
      <label class="col-sm-3 control-label" style="text-align:right; margin-top:6px">Blok Dagangan<span class="text-danger">*</span></label>
      <div class="col-sm-9" style="margin-top:3px;">
        <select class="form-control bg-blue class" data-placeholder="Blok Dagangan" name="blokdagangan" data-parsley-group="block3" data-parsley-errors-container='div[id="error-pdd_ayah"]' required>
          <option value="">Pilih Blok</option>
          <?php foreach ($blok as $baris) : ?>
            <option value="<?php echo $baris->id_blok; ?>"><?php echo $baris->nama_blok; ?></option>
          <?php endforeach; ?>
        </select>
        <div id="error-status_sekolah" style=" background:#FFBABA;color: #D8000C; width:auto;border-radius:5px;padding-left:10px;"></div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label" style="text-align:right; margin-top:6px">Blok Nomor Dagangan<span class="text-danger">*</span></label>
      <div class="col-sm-9" style="margin-top:3px;">
        <select class="form-control bg-blue class" data-placeholder="Blok Nomor Dagangan" name="bloknomor" data-parsley-group="block3" data-parsley-errors-container='div[id="error-pdd_ayah"]' required>
          <option value="">Pilih Blok</option>
          <?php
          foreach ($bloknumbers as $bn) : ?>
            <option value="<?php echo $bn->id; ?>"><?php echo $bn->nomor; ?></option>
          <?php endforeach; ?>
        </select>
        <div id="error-status_sekolah" style=" background:#FFBABA;color: #D8000C; width:auto;border-radius:5px;padding-left:10px;"></div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label" style="text-align:right; margin-top:6px">Detail Lokasi <span class="text-danger">*</span></label>
      <div class="col-sm-9 prepend-icon" style="margin-top:3px;">
        <input type="text" name="detail_lokasi_dagangan" class="form-control bg-blue class" placeholder="Detail Lokasi Dagangan" data-parsley-group="block3" data-parsley-errors-container='div[id="error-alamat_sekolah"]' required>
        <i class="fa fa-map-marker" style="margin-left:15px;"></i>
        <div id="error-alamat_sekolah" style=" background:#FFBABA;color: #D8000C; width:auto;border-radius:5px;padding-left:10px;"></div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label" style="text-align:right; margin-top:6px">Wilayah yang dipilih <span class="text-danger">*</span></label>
      <div class="col-sm-9 prepend-icon" style="margin-top:3px;">
        <input type="text" name="kelurahan_dagangan" class="form-control bg-blue class" placeholder="Wilayah yang dipilih" data-parsley-group="block3" data-parsley-errors-container='div[id="error-alamat_sekolah"]' value="Kelurahan <?= $kel->nama_kelurahan ?>" readonly required>
        <input type="text" name="id_kelurahan_dagangan" value="<?= $kel->id_kelurahan ?>" hidden>
        <i class="fa fa-map-marker" style="margin-left:15px;"></i>
        <div id="error-alamat_sekolah" style=" background:#FFBABA;color: #D8000C; width:auto;border-radius:5px;padding-left:10px;"></div>
      </div>
    </div>
  </div>
</div>


<div class="col-md-12">
  <hr>
  <blockquote>
    <p><b>CATATAN:</b> Field isian dengan tanda <span class="text-danger ">*</span><b class="text-danger">wajib diisi</b>.</p>
  </blockquote>
  <div>