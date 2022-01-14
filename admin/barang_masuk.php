<?php 
require('template/header.php');

$response = null;
// Tambah Data
if (isset($_POST['tambah_data'])) {
    $pupuk_id = $_POST['pupuk_id'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $jumlah_masuk = $_POST['jumlah_masuk'];
    
    $res = mysqli_query($conn, "INSERT INTO barang_masuk VALUES(NULL, '$pupuk_id', '$tanggal_masuk', '$jumlah_masuk')");

    if ($res) $response = 'success_add';
    else $response = 'error';
}

// Update Data
if (isset($_POST['edit_data'])) {
    $id = $_POST['id'];
    $pupuk_id = $_POST['pupuk_id'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $jumlah_masuk = $_POST['jumlah_masuk'];


    $res = mysqli_query($conn, "UPDATE barang_masuk SET pupuk_id='$pupuk_id', tanggal_masuk='$tanggal_masuk', jumlah_masuk='$jumlah_masuk' WHERE id='$id'");
    if ($res) $response = 'success_edit';
    else $response = 'error';
}

// Hapus Data
if (isset($_GET['hapus_data'])) {
    $id = $_GET['id'];
    $res = mysqli_query($conn, "DELETE FROM barang_masuk WHERE id='$id'");
    if ($res) $response = 'success_delete';
    else $response = 'error';
}

$get_data = mysqli_query($conn, "SELECT * FROM barang_masuk");
?> 


<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Barang Masuk</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Barang Masuk</li>
                </ol>
                <div class="clearfix"></div>

            </div>
        </div>
    </div> <!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Barang Masuk</b></h4>
                <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md mb-2" data-toggle="modal" data-target="#modaltambah"><i class="fa fa-plus"></i> Tambah Data</button>
                <div class="table-responsive">
                    <table id="mainTable" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pupuk</th>
                                <th>Tanggal Masuk</th>
                                <th>Jumlah Masuk(Kg/Liter)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php 
                         foreach ($get_data as $no => $dta) {
                            $pupuk_id = $dta['pupuk_id'];
                            $pupuk = mysqli_query($conn, "SELECT * FROM pupuk WHERE id='$pupuk_id'");
                            $ppk = mysqli_fetch_assoc($pupuk)
                            ?>
                            <tr>
                              <td><?= $no+1 ?></td>
                              <td><?= $ppk['nama_pupuk'] ?></td>
                              <td><?= $dta['tanggal_masuk'] ?></td>
                              <td><?= $dta['jumlah_masuk'] ?></td>

                              <td width="180"> 
                                <button type="button" class="btn btn-success btn-sm btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#modaledit<?= $dta['id'] ?>"><i class="fa fa-edit"></i> Edit</button>
                                <button type="button" class="btn btn-danger btn-sm btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#modalhapus<?= $dta['id'] ?>"><i class="fa fa-trash" ></i> Hapus</button>

                            </td>
                        </tr>
                    <?php } ?>  
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
<!-- end row -->               
</div> 
<!-- modal tambah data -->
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
                        <select name="pupuk_id" class="form-control" required="">
                            <option value="">.::Pilih Pupuk::.</option>
                            <?php $pupuk = mysqli_query($conn, "SELECT * FROM pupuk");
                            foreach ($pupuk as $ppk) { ?>
                                <option value="<?= $ppk['id'] ?>"><?= $ppk['nama_pupuk'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control" required="" placeholder="Tanggal Masuk..">
                    </div> 
                    <div class="form-group">
                        <label>Jumlah Masuk(Kg/Liter)</label>
                        <input type="number" name="jumlah_masuk" class="form-control" required="" placeholder="Jumlah Masuk..">
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

<!-- modal edit data -->
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
                        <label>Nama Pupuk</label>
                        <select name="pupuk_id" id="pupuk_id<?= $dta['id'] ?>"  class="form-control" required="">
                            <option value="">.::Pilih Pupuk::.</option>
                            <?php $pupuk = mysqli_query($conn, "SELECT * FROM pupuk");
                            foreach ($pupuk as $ppk) { ?>
                                <option value="<?= $ppk['id'] ?>"><?= $ppk['nama_pupuk'] ?></option>
                            <?php } ?>
                        </select>
                        <script>
                            document.getElementById('pupuk_id<?= $dta['id'] ?>').value="<?= $dta['pupuk_id'] ?>"
                        </script>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control" required="" placeholder="Tanggal Masuk.." value="<?= $dta['tanggal_masuk'] ?>">
                    </div> 
                    <div class="form-group">
                        <label>Jumlah Masuk(Kg/Liter)</label>
                        <input type="number" name="jumlah_masuk" class="form-control" required="" placeholder="Jumlah Masuk.." value="<?= $dta['jumlah_masuk'] ?>">
                    </div>                
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?= $dta['id'] ?>">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="edit_data" class="btn btn-success waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- modal hapus data -->
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
                    window.location.href=window.location.href;
                }
            });
        <?php } else if ($response == 'success_edit') { ?>
            swal({
                icon: 'success',
                title: 'Berhasil Mengupdate Data',
                text: 'Data telah berhasil di update',
                preConfirm: () => {
                    window.location.href=window.location.href;
                }
            });
        <?php } else if ($response == 'success_delete') { ?>
            swal({
                icon: 'success',
                title: 'Berhasil Menghapus Data',
                text: 'Data telah berhasil di hapus',
                preConfirm: () => {
                    window.location.href=window.location.href.split('?')[0];
                }
            });
        <?php } else if ($response == 'error') { ?>
            swal({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Terjadi kesalahan. Gagal memproses data',
                preConfirm: () => {
                    window.location.href=window.location.href;
                }
            });
        <?php } ?>
    });
</script>