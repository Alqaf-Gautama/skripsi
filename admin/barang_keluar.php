<?php
require('template/header.php');

$get_permintaan = mysqli_query($conn, "SELECT * FROM permintaan");
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Barang Keluar</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Barang Keluar</li>

                </ol>


                <div class="clearfix"></div>

            </div>
        </div>
    </div> <!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Barang Keluar</b></h4>

                <div class="table-responsive">
                    <table id="mainTable" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tanggal Penebusan</th>
                                <th>Jenis Pupuk</th>
                                <th>Jatah Pupuk(Kg/Liter)</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($get_permintaan as $dta) {
                                $petani_id = $dta['petani_id'];
                                $petani = mysqli_query($conn, "SELECT * FROM petani WHERE id='$petani_id'");
                                $ptn = mysqli_fetch_assoc($petani);
                                $jatah = mysqli_query($conn, "SELECT * FROM jatah WHERE petani_id='$petani_id'"); ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $ptn['nik'] ?></td>
                                    <td><?= $ptn['nama'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($dta['tgl_permintaan'])) ?></td>
                                    <td>
                                        <?php
                                        $in = 1;
                                        foreach ($jatah as $jta) {
                                            $ppk_id = $jta['pupuk_id'];
                                            $getppk = mysqli_query($conn, "SELECT * FROM pupuk WHERE id='$ppk_id'");
                                            $itm_ppk = mysqli_fetch_assoc($getppk);
                                            echo $in . ". " . $itm_ppk['nama_pupuk'] . "<br><br>";
                                            $in++;
                                        }
                                        if ($in == 1) echo "-"; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $in = 1;
                                        foreach ($jatah as $jta) {
                                            echo $in . ". " . $jta['jumlah'] . " Kg/Liter<br><br>";
                                            $in++;
                                        }
                                        if ($in == 1) echo "-"; ?>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
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
<?php
require('template/footer.php');
?>