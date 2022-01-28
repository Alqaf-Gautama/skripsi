<?php
require('template/header.php');
$permintaan = mysqli_query($conn, "SELECT * FROM permintaan");
$cnt_permintaan = mysqli_num_rows($permintaan);

$barang_masuk = mysqli_query($conn, "SELECT * FROM barang_masuk");
$cnt_barang_masuk = mysqli_num_rows($barang_masuk);

$petani_ = mysqli_query($conn, "SELECT * FROM petani");
$cnt_petani = mysqli_num_rows($petani_);

$pupuk_ = mysqli_query($conn, "SELECT * FROM pupuk");
$cnt_pupuk = mysqli_num_rows($pupuk_);
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Dashboard</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>

                </ol>


                <div class="clearfix"></div>

            </div>
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fi-download float-right"></i>
                <h6 class="text-muted text-uppercase mb-3">Barang Masuk</h6>
                <h4 class="mb-3"><?= $cnt_barang_masuk ?> Pesanan</h4>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fi-upload float-right"></i>
                <h6 class="text-muted text-uppercase mb-3">Barang Keluar</h6>
                <h4 class="mb-3"><?= $cnt_permintaan ?> Penebusan</h4>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fi-head float-right"></i>
                <h6 class="text-muted text-uppercase mb-3">Data Petani</h6>
                <h4 class="mb-3"><?= $cnt_petani ?> Orang</h4>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fi-box float-right"></i>
                <h6 class="text-muted text-uppercase mb-3">Data Pupuk</h6>
                <h4 class="mb-3"><?= $cnt_pupuk ?> Jenis</h4>
            </div>
        </div>
    </div>

</div>
<?php
require('template/footer.php');
?>