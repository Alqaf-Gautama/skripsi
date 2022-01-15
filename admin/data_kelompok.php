    <?php
require('template/header.php');

// Tambah Data
if (isset($_POST['tambah_data'])) {
    $nama_kelompok = $_POST['nama_kelompok'];
    $jumlah_anggota = $_POST['jumlah_anggota'];
    $ket = $_POST['ket'];


    $res = mysqli_query($conn, "INSERT INTO kelompok VALUES(NULL, '$nama_kelompok', '$jumlah_anggota', '$ket')");

    if ($res) $response = 'success_add';
    else $response = 'error';
}

// Update Data
if (isset($_POST['edit_data'])) {
    $id = $_POST['id'];
    $nama_kelompok = $_POST['nama_kelompok'];
    $jumlah_anggota = $_POST['jumlah_anggota'];
    $ket = $_POST['ket'];


    $res = mysqli_query($conn, "UPDATE Kelompok SET nama_kelompok='$nama_kelompok', jumlah_anggota='$jumlah_anggota', ket='$ket' WHERE id='$id'");
    if ($res) $response = 'success_edit';
    else $response = 'error';
}

// Hapus Data
if (isset($_GET['hapus_data'])) {
    $id = $_GET['id'];
    $res = mysqli_query($conn, "DELETE FROM kelompok WHERE id='$id'");
    if ($res) $response = 'success_delete';
    else $response = 'error';
}


$get_data = mysqli_query($conn, "SELECT * FROM Kelompok");
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Data Kelompok</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Master Data</li>
                    <li class="breadcrumb-item active">Data Kelompok</li>
                </ol>


                <div class="clearfix"></div>

            </div>
        </div>
    </div> <!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>DATA KELOMPOK</b></h4>
                <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md mb-2" data-toggle="modal" data-target="#modaltambah"><i class="fa fa-plus"></i> Tambah Data</button>
                <div class="table-responsive">
                    <table id="mainTable" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelompok</th>
                                <th>Jumlah Anggota</th>
                                <th>Keterangan</th>
                                <th>Detail Anggota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($get_data as $no => $dta) { ?>
                                <tr>
                                    <td><?= $no + 1 ?></td>
                                    <td><?= $dta['nama_kelompok'] ?></td>
                                    <td><?= $dta['jumlah_anggota'] ?></td>
                                    <td><?= $dta['ket'] ?></td>
                                    <td width="180">
                                        <button type="button" class="btn btn-success btn-sm btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#modallist<?= $dta['id'] ?>"><i class="fa fa-list"></i> lihat anggota</button>
                                    </td>
                                    <td width="180">
                                        <button type="button" class="btn btn-success btn-sm btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#modaledit<?= $dta['id'] ?>"><i class="fa fa-edit"></i> Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#modalhapus<?= $dta['id'] ?>"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<!-- tambah data -->
<div id="modaltambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myModalLabel">Tambah Data</h5>
            </div>
            <form method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Kelompok</label>
                        <input type="text" name="nama_kelompok" class="form-control" required="" placeholder="Nama Kelompok..">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Anggota</label>
                        <input type="number" name="jumlah_anggota" class="form-control" required="" placeholder="Jumlah Anggota..">
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="ket" class="form-control" required="" placeholder="Keterangan..">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah_data" class="btn btn-success waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php
foreach ($get_data as $no => $dta) { ?>
    <!-- modal edit -->

    <div id="modaledit<?= $dta['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">Edit Data</h5>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kelompok</label>
                            <input type="text" name="nama_kelompok" class="form-control" required="" placeholder="Nama Kelompok.." value="<?= $dta['nama_kelompok'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Anggota</label>
                            <input type="number" name="jumlah_anggota" class="form-control" required="" placeholder="Jumlah Anggota.." value="<?= $dta['jumlah_anggota'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="ket" class="form-control" required="" placeholder="Keterangan.." value="<?= $dta['ket'] ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="<?= $dta['id'] ?>">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
                        <button name="edit_data" type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- modal hapus -->
    <div id="modalhapus<?= $dta['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">Hapus Data</h5>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <p>Yakin Ingin Menghapus Data Ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                        <a href="?hapus_data=true&id=<?= $dta['id'] ?>" role="button" class="btn btn-danger">Hapus</a>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!-- list -->
    <div id="modallist<?= $dta['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">List Data Anggota</h5>
                </div>
                <div class="modal-body">
                    <table id="mainTable" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $klp_id = $dta['id'];
                            $petani = mysqli_query($conn, "SELECT * FROM petani WHERE kelompok_id='$klp_id'");

                            $no = 1;
                            foreach ($petani as $ptn) { ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $ptn['nik'] ?></td>
                                    <td><?= $ptn['nama'] ?></td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

<?php } ?>
<?php
require('template/footer.php');
?>

<script>
    $(document).ready(function() {
        <?php if ($response == 'success_add') { ?>
            swal({
                icon: 'success',
                title: 'Berhasil Tambah Data',
                text: 'Data baru berhasil ditambahkan',
                preConfirm: () => {
                    window.location.href = window.location.href;
                }
            });
        <?php } else if ($response == 'success_edit') { ?>
            swal({
                icon: 'success',
                title: 'Berhasil Mengupdate Data',
                text: 'Data telah berhasil di update',
                preConfirm: () => {
                    window.location.href = window.location.href;
                }
            });
        <?php } else if ($response == 'success_delete') { ?>
            swal({
                icon: 'success',
                title: 'Berhasil Menghapus Data',
                text: 'Data telah berhasil di hapus',
                preConfirm: () => {
                    window.location.href = window.location.href.split('?')[0];
                }
            });
        <?php } else if ($response == 'error') { ?>
            swal({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Terjadi kesalahan. Gagal memproses data',
                preConfirm: () => {
                    window.location.href = window.location.href;
                }
            });
        <?php } ?>
    });
</script>