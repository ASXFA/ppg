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
                                        <th>Lokasi Dagangan</th>
                                        <th>:</th>
                                        <td><?php echo $ngambilblok->detail_lokasi_dagangan; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Wilayah yang dipilih </th>
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
            <?php
            if ($permohonan->num_rows() > 0) {
                $p = $permohonan->row();
                if ($p->status != 0) {
            ?>
                    <div class="col-md-6">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                <fieldset class="content-group">
                                    <legend class="text-bold"><i class="icon-file-text"></i> Ajukan Permohonan</legend>
                                    <form action="<?= base_url('panel_pedagang/tambahpermohonan/' . $user->id_pedagang) ?>" method="post">
                                        <div class="form group">
                                            <label for="" class="form-control-label">Tipe Permohonan</label>
                                            <select name="tipe" id="" class="form-control">
                                                <option hidden>PILIH</option>
                                                <option value="Pindah Lokas">Pindah Lokasi</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="form-control-label">Pilih Blok</label>
                                                    <select name="blokdagangan" id="" class="form-control">
                                                        <?php foreach ($blok as $b) : ?>
                                                            <option value="<?= $b->id_blok ?>"><?= $b->nama_blok ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="form-control-label">Pilih Blok Nomor</label>
                                                    <select name="bloknomor" id="" class="form-control">
                                                        <?php foreach ($bloknumber as $bn) : ?>
                                                            <option value="<?= $bn->id ?>"><?= $bn->nomor ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form group">
                                                <input type="submit" class="btn btn-primary float-right" value="Ajukan">
                                            </div>
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    echo "<h4> Anda sudah melakukan pengajuan, ajuan anda sedang ditinjau admin, mohon tunggu ...  </h4>";
                }
            } else {

                ?>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <fieldset class="content-group">
                                <legend class="text-bold"><i class="icon-file-text"></i> Ajukan Permohonan</legend>
                                <form action="<?= base_url('panel_pedagang/tambahpermohonan/' . $user->id_pedagang) ?>" method="post">
                                    <div class="form group">
                                        <label for="" class="form-control-label">Tipe Permohonan</label>
                                        <select name="tipe" id="" class="form-control" required>
                                            <option hidden>PILIH</option>
                                            <option value="Pindah Lokasi">Pindah Lokasi</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Pilih Blok</label>
                                                <select name="blokdagangan" id="" class="form-control" required>
                                                    <?php foreach ($blok as $b) : ?>
                                                        <option value="<?= $b->id_blok ?>"><?= $b->nama_blok ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="form-control-label">Pilih Blok Nomor</label>
                                                <select name="bloknomor" id="" class="form-control" required>
                                                    <?php foreach ($bloknumber as $bn) : ?>
                                                        <option value="<?= $bn->id ?>"><?= $bn->nomor ?></option>
                                                    <?php endforeach ?>
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
            <div class="row">
                <div class="panel panel-flat col-md-12">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold"><i class="icon-pin"></i> Informasi Blok yang tersedia</legend>
                            <?php $this->load->view('admin/denah'); ?>
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