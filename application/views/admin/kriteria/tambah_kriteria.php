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
                    <form role="form" class="wizard wizard-validation" action="panel_admin/tambah_blok" data-style="sea" role="form" enctype="multipart/form-data" method="post">

                        <div class="form-group">
                            <label>Wilayah </label>
                            <select name="id_kelurahan" id="id_kelurahan" class="form-control" required>
                                <?php foreach ($kelurahan->result() as $k) : ?>
                                    <option value="<?= $k->id_kelurahan ?>">Kelurahan <?= $k->nama_kelurahan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Blok</label>
                            <input type="text" name="nama_blok" value="<?php echo $row->nama_blok; ?>" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label>Penanggung Jawab</label>
                            <input type="float" name="pj_blok" value="<?php echo $row->pj_blok; ?>" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="float" name="no_hp_pj" value="<?php echo $row->no_hp_pj; ?>" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btn_tambah_blok" value="Update" class="btn btn-info">
                        </div>
                    </form>
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