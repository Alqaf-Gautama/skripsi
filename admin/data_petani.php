<?php 
require('template/header.php');

$response = null;
// Tambah Data
if (isset($_POST['tambah_data'])) {
    $kelompok_id = $_POST['kelompok_id'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];

    $res = mysqli_query($conn, "INSERT INTO petani VALUES(NULL, '$kelompok_id', '$nik', '$nama')");

    if ($res) $response = 'success_add';
    else $response = 'error';
}

// Update Data
if (isset($_POST['edit_data'])) {
    $id = $_POST['id'];
    $kelompok_id = $_POST['kelompok_id'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];

    $res = mysqli_query($conn, "UPDATE petani SET kelompok_id='$kelompok_id', nik='$nik', nama='$nama' WHERE id='$id'");
    if ($res) $response = 'success_edit';
    else $response = 'error';
}

// Set Jatah
if (isset($_POST['set_jatah'])) {
    $petani_id = $_POST['petani_id'];
    mysqli_query($conn, "DELETE FROM jatah WHERE petani_id ='$petani_id'");
    foreach ($_POST['pupuk_id'] as $i => $jta) {
        $jumlah = $_POST['jumlah'][$i];
        $res = mysqli_query($conn, "INSERT INTO jatah VALUES(NULL, '$petani_id', '$jta', '$jumlah')");
        if ($res) $response = 'success_set';
        else $response = 'error';

    }
}

// Hapus Data
if (isset($_GET['hapus_data'])) {
    $id = $_GET['id'];
    $res = mysqli_query($conn, "DELETE FROM petani WHERE id='$id'");
    if ($res) $response = 'success_delete';
    else $response = 'error';
}

$get_data = mysqli_query($conn, "SELECT * FROM petani");
?> 
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Data Petani</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Master Data</li>
                    <li class="breadcrumb-item active">Data Petani</li>
                </ol>


                <div class="clearfix"></div>

            </div>
        </div>
    </div> <!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Data Petani</b></h4>
                <button type="button" class="btn btn-gradient btn-rounded waves-light waves-effect w-md mb-2" data-toggle="modal" data-target="#modaltambah"><i class="fa fa-plus"></i> Tambah Data</button>
                <div class="table-responsive">
                    <table id="mainTable" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Pupuk</th>
                                <th>Jatah (Kg/Liter)</th>
                                <th>Nama Kelompok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php 
                            foreach ($get_data as $no => $dta) {
                                $kelompok_id = $dta['kelompok_id'];
                                $kelompok = mysqli_query($conn, "SELECT * FROM kelompok WHERE id='$kelompok_id'");
                                $kel = mysqli_fetch_assoc($kelompok);

                                $petani_id = $dta['id'];
                                $jatah = mysqli_query($conn, "SELECT * FROM jatah WHERE petani_id='$petani_id'");
                                ?> 
                                <tr>
                                    <td><?= $no+1 ?></td>
                                    <td><?= $dta['nik'] ?></td>
                                    <td><?= $dta['nama'] ?></td>
                                    <td>
                                        <?php
                                        $in = 1;
                                        foreach ($jatah as $jta) { 
                                            $ppk_id = $jta['pupuk_id'];
                                            $getppk = mysqli_query($conn, "SELECT * FROM pupuk WHERE id='$ppk_id'");
                                            $itm_ppk = mysqli_fetch_assoc($getppk);
                                            echo $in.". ".$itm_ppk['nama_pupuk']."<br><br>";
                                            $in++;
                                        } 
                                        if ($in == 1) echo "-"; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $in = 1;
                                        foreach ($jatah as $jta) { 
                                            echo $in.". ".$jta['jumlah']." Kg/Liter<br><br>";
                                            $in++;
                                        }
                                        if ($in == 1) echo "-"; ?>
                                    </td>
                                    <td><?= $kel['nama_kelompok'] ?></td>
                                    <td width="250">
                                        <button type="button" class="btn btn-primary btn-sm btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#modalset<?= $dta['id'] ?>"><i class="fa fa-gear"></i> Set Jatah</button>
                                        <button type="button" class="btn btn-success btn-sm btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#modaledit<?= $dta['id'] ?>"><i class="fa fa-edit"></i> Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#modalhapus<?= $dta['id'] ?>"><i class="fa fa-trash"></i> Hapus</button>
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
                        <label>NIK</label>
                        <input type="number" name="nik" class="form-control" required="" placeholder="NIK..">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required="" placeholder="Nama..">
                    </div> 

                    <div class="form-group">
                        <label>Nama Kelompok</label>
                        <select name="kelompok_id" class="form-control" required="">
                            <option value="">.::Pilih Kelompok::.</option>
                            <?php $kelompok = mysqli_query($conn, "SELECT * FROM kelompok");
                            foreach ($kelompok as $kel) { ?>
                                <option value="<?= $kel['id'] ?>"><?= $kel['nama_kelompok'] ?></option>
                            <?php } ?>
                        </select>
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

    <!-- modal set jatah -->
    <div id="modalset<?= $dta['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">Set Jatah Pupuk</h5>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Jenis Pupuk</th>
                                    <th width="150">Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="item-jatah">
                                <?php 
                                $petani_id = $dta['id'];
                                $cek = 0;
                                $jatah = mysqli_query($conn, "SELECT * FROM jatah WHERE petani_id='$petani_id'");
                                foreach ($jatah as $jta) { ?>
                                    <tr class="tr-item">
                                        <td>
                                            <select name="pupuk_id[]" id="pupuk_id<?= $jta['id'] ?>" class="form-control " required="">
                                                <option value="">.::Pilih Pupuk::.</option>
                                                <?php $pupuk = mysqli_query($conn, "SELECT * FROM pupuk");
                                                foreach ($pupuk as $ppk) { ?>
                                                    <option value="<?= $ppk['id'] ?>"><?= $ppk['nama_pupuk'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <script>
                                                document.getElementById('pupuk_id<?= $jta['id'] ?>').value="<?= $jta['pupuk_id'] ?>"
                                            </script>
                                        </td>
                                        <td>
                                            <input type="number" name="jumlah[]" class="form-control " required="" placeholder="Jumlah.." value="<?= $jta['jumlah'] ?>">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm del-item-jatah"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    <?php 
                                    $cek++;
                                }

                                if ($cek == 0) { ?>
                                    <tr class="tr-item">
                                        <td>
                                            <select name="pupuk_id[]" class="form-control " required="">
                                                <option value="">.::Pilih Pupuk::.</option>
                                                <?php $pupuk = mysqli_query($conn, "SELECT * FROM pupuk");
                                                foreach ($pupuk as $ppk) { ?>
                                                    <option value="<?= $ppk['id'] ?>"><?= $ppk['nama_pupuk'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="jumlah[]" class="form-control " required="" placeholder="Jumlah..">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm del-item-jatah"><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary btn-sm add-item-jatah"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="petani_id" value="<?= $dta['id'] ?>">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Tutup</button>
                        <button name="set_jatah" type="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

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
                            <label>NIK</label>
                            <input type="number" name="nik" class="form-control" required="" placeholder="NIK.." value="<?= $dta['nik'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" required="" placeholder="Nama.." value="<?= $dta['nama'] ?>">
                        </div> 

                        <div class="form-group">
                            <label>Nama Kelompok</label>
                            <select name="kelompok_id" class="form-control" id="kelompok_id<?= $dta['id'] ?>" required="">
                             <?php $kelompok = mysqli_query($conn, "SELECT * FROM kelompok");
                             foreach ($kelompok as $kel) { ?>
                                <option value="<?= $kel['id'] ?>"><?= $kel['nama_kelompok'] ?></option>
                            <?php } ?>
                        </select>
                        <script>
                            document.getElementById('kelompok_id<?= $dta['id'] ?>').value="<?= $dta['kelompok_id'] ?>"
                        </script>
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

<?php } ?>
<?php 
require('template/footer.php');
?>

<script>
    $(document).ready(function() {
        $('.add-item-jatah').click(function() {
            $(this).parents('.modal-body').find('.item-jatah').append(`
                <tr class="tr-item">
                <td>
                <select name="pupuk_id[]" class="form-control " required="">
                <option value="">.::Pilih Pupuk::.</option>
                <?php $pupuk = mysqli_query($conn, "SELECT * FROM pupuk");
                foreach ($pupuk as $ppk) { ?>
                    <option value="<?= $ppk['id'] ?>"><?= $ppk['nama_pupuk'] ?></option>
                <?php } ?>
                </select>
                </td>
                <td>
                <input type="number" name="jumlah[]" class="form-control " required="" placeholder="Jumlah..">
                </td>
                <td>
                <button type="button" class="btn btn-danger btn-sm del-item-jatah"><i class="fa fa-trash"></i> </button>
                </td>
                </tr>
                `);
        });

        $(document).on('click', '.del-item-jatah', function() {
            $(this).parents('.tr-item').remove();
        });

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
        <?php } else if ($response == 'success_set') { ?>
            swal({
                icon: 'success',
                title: 'Berhasil Diproses',
                text: 'Jatah Pupuk telah berhasil di update',
                preConfirm: () => {
                    window.location.href=window.location.href;
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