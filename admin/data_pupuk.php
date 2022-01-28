<?php
require('template/header.php');

$response = null;
// Tambah Data
if (isset($_POST['tambah_data'])) {
    $nama_pupuk = $_POST['nama_pupuk'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];


    $res = mysqli_query($conn, "INSERT INTO pupuk VALUES(NULL, '$nama_pupuk', '$stock', '$harga')");

    if ($res) $response = 'success_add';
    else $response = 'error';
}

// Update Data
if (isset($_POST['edit_data'])) {
    $id = $_POST['id'];
    $nama_pupuk = $_POST['nama_pupuk'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];

    $res = mysqli_query($conn, "UPDATE pupuk SET nama_pupuk='$nama_pupuk', stock='$stock', harga='$harga' WHERE id='$id'");
    if ($res) $response = 'success_edit';
    else $response = 'error';
}

// Hapus Data
if (isset($_GET['hapus_data'])) {
    $id = $_GET['id'];
    $res = mysqli_query($conn, "DELETE FROM pupuk WHERE id='$id'");
    if ($res) $response = 'success_delete';
    else $response = 'error';
}

$get_data = mysqli_query($conn, "SELECT * FROM pupuk");
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Data Pupuk</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Master Data</li>
                    <li class="breadcrumb-item active">Data Pupuk</li>
                </ol>
                <div class="clearfix"></div>

            </div>
        </div>
    </div> <!-- end row -->
    <!-- tambah data -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>DATA PUPUK</b></h4>
                <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md mb-2" data-toggle="modal" data-target="#modaltambah"><i class="fa fa-plus"></i> Tambah Data</button>
                <div class="table-responsive">
                    <table id="mainTable" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pupuk</th>
                                <th>Stock</th>
                                <th>Harga/Kg</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($get_data as $no => $dta) { ?>
                                <tr>
                                    <td><?= $no + 1 ?></td>
                                    <td><?= $dta['nama_pupuk'] ?></td>
                                    <td><?= $dta['stock'] ?> (kg)</td>
                                    <td>Rp.<?= number_format($dta['harga']) ?>/Kg</td>
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

<!-- modal tambah -->
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
                        <label>Nama Pupuk</label>
                        <input type="text" name="nama_pupuk" class="form-control" required="" placeholder="Nama Pupuk..">
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" required="" placeholder="Stock..">
                    </div>

                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" required="" placeholder="Harga..">
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

<?php foreach ($get_data as $dta) { ?>
    <!-- modal edit data -->
    <div id="modaledit<?= $dta['id'] ?>" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">Edit Data</h5>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Pupuk</label>
                            <input type="text" name="nama_pupuk" class="form-control" required="" placeholder="Nama Pupuk.." value="<?= $dta['nama_pupuk'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control" required="" placeholder="Stock.." value="<?= $dta['stock'] ?>">
                        </div>

                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" required="" placeholder="Harga.." value="<?= $dta['harga'] ?>">

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" value="<?= $dta['id'] ?>">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="edit_data" class="btn btn-success waves-effect waves-light">Simpan</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!-- modal hapus data -->
    <div id="modalhapus<?= $dta['id'] ?>" class="modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">Hapus Data</h5>
                </div>
                <div class="modal-body">
                    <p>Yakin Ingin Menghapus Data Ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Batal</button>
                    <a href="?hapus_data=true&id=<?= $dta['id'] ?>" role="button" class="btn btn-danger">Hapus</a>
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