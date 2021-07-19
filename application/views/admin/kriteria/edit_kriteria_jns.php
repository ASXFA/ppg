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
          <form role="form" class="wizard wizard-validation" action="panel_admin/update_jns" data-style="sea" role="form"  enctype="multipart/form-data"  method="post">

          <?php
          if (isset($data_kriteria)) {
              foreach ($data_kriteria->result() as $row) { ?>

                <div class="form-group">
                  <label>Jenis Dagangan</label>
                  <input type="text" name="nama_jns" value="<?php echo $row->nama_jns; ?>" class="form-control"/>
                </div>
                <div class="form-group">
                  <label>Id Jenis</label>
                  <input type="text" readonly="readonly" name="id_jns" value="<?php echo $row->id_jns; ?>" class="form-control"/>
                </div>
                <div class="form-group">
                  <input type="submit" name="update_data_p" value="Update" class="btn btn-info">
                </div>
                <?php } }?>

      </form>
      </div>

<script type="text/javascript">
  function thn()
  {
    var thn = $('[name="thn"]').val();
      window.location = "panel_admin/verifikasi/thn/"+thn;
  }

  $('[name="thn"]').select2({
      placeholder: "- Tahun -"
  });

</script>
