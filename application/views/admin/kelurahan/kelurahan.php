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
                                    DATA KELURAHAN & PASIEN COVID
                                </h5>
                                <hr style="margin:5px 0px;">
                                <?php if ($level == "kecamatan") : ?>
                                    <button class="btn btn-primary btn-sm float-right" id="btnTambah">Tambah Data Kelurahan</button>
                                <?php endif; ?>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table datatable-basic table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="30px;">No.</th>
                                                <th>Nama Kelurahan</th>
                                                <th>Kasus Positif Covid</th>
                                                <th>Kasus Negatif Covid</th>
                                                <th>Nilai K-means</th>
                                                <th>File Geojson</th>
                                                <th>Aksi</th>
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
                                                    <td><?= $k->file_geo_kelurahan ?></td>
                                                    <td>
                                                        <a href="<?= base_url('panel_admin/denah') ?>/<?= $k->id_kelurahan ?>" class="btn btn-info btn-sm" title="Lihat Denah Lokasi">Lihat Denah</a>
                                                        <?php if ($level == "kecamatan") { ?>
                                                            <button class="btn btn-warning btn-sm edit" id="<?= $k->id_kelurahan ?>" title="Edit DAta Kelurahan">Edit</button>
                                                            <a href="<?= base_url('panel_admin/deleteKelurahan') ?>/<?= $k->id_kelurahan ?>" class="btn btn-danger btn-sm delete" title="Delete Data Kelurahan" onclick="return confirm('Yakin Menghapus Data ?')">Delete</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                        function thn() {
                            var thn = $('[name="thn"]').val();
                            window.location = "panel_admin/verifikasi/thn/" + thn;
                        }

                        $(function() {
                            $('#formKelurahan').submit(function(e) {
                                e.preventDefault();
                                $.ajax({
                                    method: 'POST',
                                    dataType: 'JSON',
                                    data: new FormData(this),
                                    processData: false,
                                    contentType: false,
                                    url: '<?= base_url('panel_admin/doKelurahan') ?>',
                                    success: function(result) {
                                        if (result.cond == '1') {
                                            alert('Berhasil Menambah Data');
                                            location.reload();
                                        } else {
                                            // console.log(result.msg);
                                            alert(result.msg);
                                            location.reload();
                                        }
                                    }
                                })
                            })
                            $('#btnTambah').click(function() {
                                $('#modalKelurahan').modal('show');
                                $("#title-modal").html('Tambah Users');
                                $('#operation').val('tambah');
                                $('#id_kelurahan').val('');
                                $('#nama_kelurahan').val('');
                                $('#positif_kelurahan').val('');
                                $('#negatif_kelurahan').val('');
                                $('#file_geo_kelurahan').val('');
                            })
                            $('.edit').click(function() {
                                var id = $(this).attr('id');
                                $('#modalKelurahan').modal('show');
                                $("#title-modal").html('Edit Data Kelurahan');
                                $('#operation').val('edit');
                                $.ajax({
                                    method: 'POST',
                                    dataType: 'JSON',
                                    data: {
                                        id: id
                                    },
                                    url: '<?= base_url('panel_admin/kelurahanById') ?>',
                                    success: function(result) {
                                        $('#id_kelurahan').val(id);
                                        $('#nama_kelurahan').val(result.nama_kelurahan);
                                        $('#positif_kelurahan').val(result.positif_kelurahan);
                                        $('#negatif_kelurahan').val(result.negatif_kelurahan);
                                        $('#old_file_geo_kelurahan').val(result.file_geo_kelurahan);
                                    }
                                })
                            })
                        })

                        $('[name="thn"]').select2({
                            placeholder: "- Tahun -"
                        });
                    </script>