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

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    DENAH LOKASI PASAR
                                </h5>
                                <hr style="margin:5px 0px;">
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="p-3" style="padding: 20px;">
                                    <h3 class="text-center">Denah Lokasi Pasar Tumpah di <b>Kelurahan <?= $kel->nama_kelurahan ?></b></h3>
                                    <table class="table table-borderless" style="border:0px !important; margin-bottom:10px;">
                                        <tr>
                                            <td width="2%">
                                                <div style="width:20px; height:20px;; border:1px solid black; background-color:red;">
                                                    <p style="color:red;">clr</p>
                                                </div>
                                            </td>
                                            <td class="p-5" width="13%">
                                                <h5>BLOK SUDAH TERISI</h5>
                                            </td>
                                            <td width="2%">
                                                <div style="width:20px; height:20px;; border:1px solid black; background-color:white;">
                                                    <p style="color:white;">clr</p>
                                                </div>
                                            </td>
                                            <td class="p-5">
                                                <h5>BLOK BELUM TERISI</h5>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php $blokterisi = 0;
                                    $jumlahblok = 0;
                                    if (!empty($blok)) { ?>
                                        <div class="row">
                                            <?php
                                            $no = 1;
                                            foreach ($blok as $b) :
                                                $this->db->where('id_kelurahan_dagangan', $kel->id_kelurahan);
                                                $this->db->where('blokdagangan', $b->id_blok);
                                                $ambilBlokPedagang = $this->db->get('tbl_pedagang')->result();
                                                if ($no == 1) {
                                            ?>
                                                    <div class="col-md-3">
                                                        <div style="width: auto; height: auto; border: 1px solid black;">
                                                            <p class="text-center"><?= "Blok" . $b->nama_blok ?></p>
                                                            <?php foreach ($bloknumber as $bn) : ?>
                                                                <div style="<?php foreach ($ambilBlokPedagang as $abp) {
                                                                                if ($abp->bloknomor == $bn->nomor) {
                                                                                    echo 'background-color:#f44336; ';
                                                                                    $blokterisi += 1;
                                                                                }
                                                                            } ?>width: auto; height: auto; border: 1px solid black; margin:5px;">
                                                                    <p class="text-center" style="margin-top: 30px; margin-bottom:30px;"><?= $b->nama_blok . " " . $bn->nomor ?></p>
                                                                </div>
                                                            <?php $jumlahblok += 1;
                                                            endforeach ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div style="width: auto; height: 2225px; border: 1px solid black;">
                                                            <h6 class="text-center" style="margin-top:1100px; font-weight:bolder; font-size: 16px;">Jalan Raya</h6>
                                                        </div>
                                                    </div>
                                                <?php } else if ($no == 2) { ?>
                                                    <div class="col-md-3">
                                                        <div style="width: auto; height: auto; border: 1px solid black;">
                                                            <p class="text-center"><?= "Blok" . $b->nama_blok ?></p>
                                                            <?php foreach ($bloknumber as $bn) : ?>
                                                                <div class="<?php foreach ($ambilBlokPedagang as $abp) {
                                                                                if ($abp->bloknomor == $bn->nomor) {
                                                                                    echo 'bg-danger';
                                                                                    $blokterisi += 1;
                                                                                }
                                                                            } ?>" style="width: auto; height: auto; border: 1px solid black; margin:5px;">
                                                                    <p class="text-center" style="margin-top: 30px; margin-bottom:30px;"><?= $b->nama_blok . " " . $bn->nomor ?></p>
                                                                </div>
                                                            <?php $jumlahblok += 1;
                                                            endforeach ?>
                                                        </div>
                                                    </div>
                                            <?php $no = 0;
                                                }
                                                $no++;
                                            endforeach; ?>
                                        </div>
                                    <?php } else {
                                        echo "<h3 class='text-center'> Blok Pada kecamatan" . $kel->nama_kelurahan . " belum diisi </h3>";
                                    } ?>
                                    <br>
                                    <p><b>Jumlah Tempat Dagangan :</b> <?= $jumlahblok ?> Tempat</p>
                                    <p><b>Tempat Dagangan yang terisi :</b> <?= $blokterisi ?> Tempat</p>
                                    <p><b>Tempat Dagangan yang kosong :</b> <?php $blokkosong = $jumlahblok - $blokterisi;
                                                                            echo $blokkosong; ?> Tempat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>