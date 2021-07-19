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
                    <h5 class="panel-title">DATA USER AKUN
                    </h5>
                    <hr style="margin:0px;">
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    DATA USER AKUN
                                </h5>
                                <hr style="margin:5px 0px;">
                                <button class="btn btn-primary btn-sm float-right" id="btnTambah">Tambah Data User</button>
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
                                            <th>Nama Lengkap</th>
                                            <th>Username</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($users as $u) : ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $u->nama_lengkap ?></td>
                                                <td><?= $u->username ?></td>
                                                <td><?= date('d F Y', strtotime($u->tgl_daftar)) ?></td>
                                                <td><?= $u->level ?></td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm edit" id="<?= $u->id_user ?>" title="Edit Users">Edit</button>
                                                    <a href="<?= base_url('panel_admin/deleteUsers') ?>/<?= $u->id_user ?>" class="btn btn-danger btn-sm delete" title="Delete Users" onclick="return confirm('Yakin Menghapus Data ?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class=" modal" id="modalUsers" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="title-modal"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formUsers" method="post">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Nama Lengkap</label>
                                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Level</label>
                                            <select name="level" id="level" class="form-control" required>
                                                <option value="petugas Pasar">Petugas Pasar</option>
                                                <option value="kecamatan">kecamatan</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="text" name="operation" id="operation" hidden>
                                    <input type="text" name="id_users" id="id_users" hidden>
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
                            $('#formUsers').submit(function(e) {
                                e.preventDefault();
                                $.ajax({
                                    method: 'POST',
                                    dataType: 'JSON',
                                    data: new FormData(this),
                                    processData: false,
                                    contentType: false,
                                    url: '<?= base_url('panel_admin/doUser') ?>',
                                    success: function(result) {
                                        if (result.cond == '1') {
                                            alert('Berhasil Mendambah Data');
                                            location.reload();
                                        } else {
                                            alert('Gagal Menambah Data');
                                            location.reload();
                                        }
                                    }
                                })
                            })
                            $('#btnTambah').click(function() {
                                $('#modalUsers').modal('show');
                                $("#title-modal").html('Tambah Users');
                                $('#operation').val('tambah');
                                $('#id_users').val('id_users');
                                $('#nama_lengkap').removeAttr('disabled', 'disabled');
                                $('#nama_lengkap').val();
                                $('#username').removeAttr('disabled', 'disabled');
                                $('#username').val();
                                $('#level').selectedIndex = "0";
                            })
                            $('.edit').click(function() {
                                var id = $(this).attr('id');
                                $('#modalUsers').modal('show');
                                $("#title-modal").html('Edit Users Akun');
                                $('#operation').val('edit');
                                $.ajax({
                                    method: 'POST',
                                    dataType: 'JSON',
                                    data: {
                                        id: id
                                    },
                                    url: '<?= base_url('panel_admin/userById') ?>',
                                    success: function(result) {
                                        $('#id_users').val('id_users');
                                        $('#nama_lengkap').attr('disabled', 'disabled');
                                        $('#nama_lengkap').val(result.nama_lengkap);
                                        $('#username').attr('disabled', 'disabled');
                                        $('#username').val(result.username);
                                        $('#level').val(result.level);
                                    }
                                })
                            })
                        })

                        $('[name="thn"]').select2({
                            placeholder: "- Tahun -"
                        });
                    </script>