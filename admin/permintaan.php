<?php
require('template/header.php');

$get_petani = mysqli_query($conn, "SELECT * FROM petani");

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
                            <div class="x_content">
                                <form method="GET">
                                    <div class=" row py-2">
                                        <div class="col-md-8">
                                            <select class="input-sm form-control select2" id="petani_id">
                                                <option value="">Temukan NIK</option>
                                                <?php foreach ($get_petani as $ptn) { ?>
                                                    <option value="<?= $ptn['id'] ?>"><?= $ptn['nik'] . '/' . $ptn['nama'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" id="temukan-nik" class="btn btn-primary"><i class="fa fa-search"></i> &nbsp;Temukan</button>
                                        </div>
                                    </div>
                                </form>
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
                                            <span class="col-sm-7 p-0 nama">--</span>
                                        </li>
                                        <li class="list-group-item row">
                                            <b class="col-sm-5 p-0">Nama kelompok : </b>
                                            <span class="col-sm-7 p-0 nama_kelompok">--</span>
                                        </li>
                                        <li class="list-group-item row">
                                            <b class="col-sm-5 p-0">Jatah Pupuk : </b>
                                            <span class="col-sm-7 p-0 jatah">--</span>
                                        </li>
                                        <li class="list-group-item row">
                                            <b class="col-sm-5 p-0">Tatal Bayar : </b>
                                            <span class="col-sm-7 p-0 total_bayar">--</span>
                                        </li>
                                    </ul>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <button type="button" class="btn btn-info btn-lg btn-block" disabled=""><i class="fa fa-check"></i> Proses</button>
                                </div>
                            </div>
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

<script>
    $(document).ready(function() {
        $('#temukan-nik').click(function(e) {
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
                    $.each(data, function(key, val) {
                        $('.' + key).html(val);
                    });
                }
            });
        });
    });
</script>