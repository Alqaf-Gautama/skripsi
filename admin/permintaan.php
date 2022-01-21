<?php
require('template/header.php');

$get_petani = mysqli_query($conn, "SELECT * FROM petani");
$response = null;
if (isset($_POST['proses'])) {
    $petani_id = $_POST['petani_id'];
    $tanggal = date('Y-m-d');

    $res = mysqli_query($conn, "INSERT INTO permintaan VALUES(NULL, '$tanggal', '$petani_id')");

    if ($res) $response = 'success_add';
    else $response = 'error';
}

?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Permintaan</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Permintaan</li>

                </ol>


                <div class="clearfix"></div>

            </div>
        </div>
    </div> <!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row justify-content-center">
                    <div class="col-md-6 pt-2">
                        <h2 class="text-center m-t-0"><b>Permintaan</b></h2>
                        <div class="x_panel">
                            <form method="POST">
                                <div class="x_content">
                                    <div class=" row py-2">
                                        <div class="col-md-12">
                                            <select class="input-sm form-control select2" id="petani_id" name="petani_id" required="">
                                                <option value=""></option>
                                                <?php foreach ($get_petani as $ptn) { ?>
                                                    <option value="<?= $ptn['id'] ?>"><?= $ptn['nik'] . '/' . $ptn['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div style="margin-top: -10px;">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item row">
                                                <b class="col-sm-5 p-0">Tanggal Penebusan</b>
                                                <span class="col-sm-7 p-0">
                                                    : <?= date("d/m/Y") ?>
                                                </span>
                                            </li>
                                            <li class="list-group-item row">
                                                <b class="col-sm-5 p-0">Nama : </b>
                                                <span class="col-sm-7 p-0 dtl nama">--</span>
                                            </li>
                                            <li class="list-group-item row">
                                                <b class="col-sm-5 p-0">Nama kelompok : </b>
                                                <span class="col-sm-7 p-0 dtl nama_kelompok">--</span>
                                            </li>
                                            <li class="list-group-item row">
                                                <b class="col-sm-5 p-0">Jatah Pupuk : </b>
                                                <span class="col-sm-7 p-0 dtl jatah">--</span>
                                            </li>
                                            <li class="list-group-item row">
                                                <b class="col-sm-5 p-0">Tatal Bayar : </b>
                                                <span class="col-sm-7 p-0 dtl total_bayar">--</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="text-center row">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-primary btn-lg btn-block reset-form"><i class="fa fa-undo"></i> Restar</button>

                                        </div>
                                        <div class="col-6">
                                            <button type="submit" name="proses" class="btn btn-info btn-lg btn-block"><i class="fa fa-check"></i> Proses</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<?php
require('template/footer.php');
?>

<script src="plugins/select2/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Temukan NIK Petani',
        });

        $('#petani_id').change(function(e) {
            e.preventDefault();

            var petani_id = $('#petani_id').val();
            $.ajax({
                url: 'controller.php',
                method: "POST",
                data: {
                    req: 'getPetani',
                    petani_id: petani_id,
                },
                success: function(data) {
                    if (data == null) {
                        alert('Petani ini telah mengambil jatah pupuk pada periode ini');
                        $('.select2').val('');
                        $('.select2').select2({
                            placeholder: 'Temukan NIK Petani',
                        });
                        $('.dtl').html('--');
                    }
                    $.each(data, function(key, val) {
                        $('.' + key).html(val);
                    });
                }
            });
        });

        $('.reset-form').click(function(e) {
            e.preventDefault();

            $('.select2').val('');
            $('.select2').select2({
                placeholder: 'Temukan NIK Petani',
            });
            $('.dtl').html('--');
        });

        <?php if ($response == 'success_add') { ?>
            swal({
                icon: 'success',
                title: 'Berhasil Diproses',
                text: 'Permintaan berhasil ditambah',
                preConfirm: () => {
                    window.location.href = 'barang_keluar.php';
                }
            });
        <?php } ?>
    });
</script>