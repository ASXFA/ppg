<div class="panel panel-primary">
  <div class="panel-heading">
    <h2><strong class="text-success" style="color:#eee;">Data Dagangan</strong></h2>
  </div>
  <div class="panel-body">

        <div class="form-group" style="padding-bottom:30px;">
            <label class="col-sm-3 control-label" style="text-align:right; margin-top:6px">Nama Dagangan <span class="text-danger">*</span></label>
            <div class="col-sm-9 prepend-icon">
              <input type="text" name="nama_dagangan" class="form-control bg-blue" placeholder="Nama Lengkap Dagangan"  maxlength="100" data-parsley-group="block2" data-radio="iradio_square-blue" data-parsley-errors-container='div[id="error-nama_ayah"]' required>
              <i class="fa fa-user" style="margin-left:15px;"></i>
              <div id="error-nama_ayah" style=" background:#FFBABA;color: #D8000C; width:auto;border-radius:5px;padding-left:10px;"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label" style="text-align:right; margin-top:6px">Jenis Dagangan <span class="text-danger">*</span></label>
            <div class="col-sm-9" style="margin-top:3px;">
              <select class="form-control bg-blue class" data-placeholder="Jenis Dagangan" name="jns_dagangan" data-parsley-group="block2" data-parsley-errors-container='div[id="error-pdd_ayah"]' required>
                  <option value="">Pilih Jenis Dagangan</option>
                  <?php foreach ($v_jns as $baris): ?>
                    <option value="<?php echo $baris->nama_jns; ?>"><?php echo $baris->nama_jns; ?></option>
                  <?php endforeach; ?>
              </select>
              <div id="error-pdd_ayah" style=" background:#FFBABA;color: #D8000C; width:auto;border-radius:5px;padding-left:10px;"></div>
            </div>
        </div>
        
        <div class="form-group" >
            <label class="col-sm-3 control-label" style="text-align:right; margin-top:6px">No. Handphone <span class="text-danger">*</span></label>
            <div class="col-sm-9 prepend-icon" style="margin-top:3px;">
              <input type="text" name="no_hp_dagangan" class="form-control bg-blue class" onkeypress="return hanyaAngka(this);" maxlength="14" placeholder="No. Handphone Ayah" data-parsley-group="block2" data-parsley-errors-container='div[id="error-no_hp_ayah"]' required>
              <i class="fa fa-phone" style="margin-left:15px;"></i>
              <div id="error-no_hp_ayah" style=" background:#FFBABA;color: #D8000C; width:auto;border-radius:5px;padding-left:10px;"></div>
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
