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

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    Perhitungan K-means
                                    <div class="heading-elements">
                                        <form id="form-hitung" action="" method="post">
                                            <input type="text" name="hitung" value="hitung" hidden>
                                            <button class="btn btn-primary" type="submit" onclick="return confirm('Hitung Kembali ? ')">Hitung Kembali </button>
                                        </form>
                                    </div>
                                </h5>
                                <!-- <button class="btn btn-primary btn-sm float-right" id="btnTambah">Tambah Data Kelurahan</button> -->
                                <hr style="margin:15px 0px;">
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    Data Hasil Perhitungan
                                                </h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table datatable-basic table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Kelurahan</th>
                                                                <th>Kasus Positif Covid</th>
                                                                <th>Kasus Negatif Covid</th>
                                                                <th>Zona Wilayah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 1;
                                                            foreach ($kelurahan as $k) : ?>
                                                                <tr>
                                                                    <td><?= $no ?></td>
                                                                    <td><?= $k->nama_kelurahan ?></td>
                                                                    <td><?= $k->positif_kelurahan ?> Orang</td>
                                                                    <td><?= $k->negatif_kelurahan ?> Orang</td>
                                                                    <?php
                                                                    if ($k->nilai_kmeans_kelurahan == 1) {
                                                                        echo "<td class='bg-success text-white'>Zona Hijau</td>";
                                                                    } else if ($k->nilai_kmeans_kelurahan == 2) {
                                                                        echo "<td class='bg-danger text-white'>Zona Merah</td>";
                                                                    } else if ($k->nilai_kmeans_kelurahan == NULL || $k->nilai_kmeans_kelurahan == 0) {
                                                                        echo "<td class=''>Belum dihitung</td>";
                                                                    }
                                                                    ?>
                                                                </tr>
                                                            <?php $no++;
                                                            endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- <div class="table-responsive">
                                                    <table class="table datatable-basic table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Kelurahan</th>
                                                                <th>Kasus Positif Covid</th>
                                                                <th>Kasus Negatif Covid</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $no = 1;
                                                            foreach ($kelurahan as $k) : ?>
                                                                <tr>
                                                                    <td><?= $no ?></td>
                                                                    <td><?= $k->nama_kelurahan ?></td>
                                                                    <td><?= $k->positif_kelurahan ?> Orang</td>
                                                                    <td><?= $k->negatif_kelurahan ?> Orang</td>
                                                                </tr>
                                                            <?php $no++;
                                                            endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    Cluster yang digunakan
                                                </h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table datatable-basic table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Cluster</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td class="bg-success text-white">Zona Hijau (Aman)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td class="bg-danger text-white">Zona Merah (Tidak Aman)</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    Centroid yang digunakan
                                                </h5>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table datatable-basic table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Centroid x</th>
                                                                <th>Centroid y</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><?php if (isset($centroid1x)) {
                                                                        echo $centroid1x;
                                                                    } ?></td>
                                                                <td><?php if (isset($centroid1y)) {
                                                                        echo $centroid1y;
                                                                    } ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td><?php if (isset($centroid2x)) {
                                                                        echo $centroid2x;
                                                                    } ?></td>
                                                                <td><?php if (isset($centroid2y)) {
                                                                        echo $centroid2y;
                                                                    } ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    Hasil
                                </h5>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-8">
                                    
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class=" modal" id="modalKelurahan" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="title-modal"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formKelurahan" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Nama Kelurahan</label>
                                            <input type="text" name="nama_kelurahan" id="nama_kelurahan" class="form-control" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="form-control-label">Kasus Positif Covid</label>
                                                    <input type="text" name="positif_kelurahan" id="positif_kelurahan" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="form-control-label">Kasus Negatif Covid</label>
                                                    <input type="text" name="negatif_kelurahan" id="negatif_kelurahan" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">File GeoJson</label>
                                            <input type="text" name="old_file_geo_kelurahan" id="old_file_geo_kelurahan" hidden>
                                            <input type="file" name="file_geo_kelurahan" id="file_geo_kelurahan" class="form-control">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="text" name="operation" id="operation" hidden>
                                    <input type="text" name="id_kelurahan" id="id_kelurahan" hidden>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(function() {
                            // $('#form-hitung').submit(function(e){
                            //     e.preventDefault();

                            // })
                        })
                    </script>