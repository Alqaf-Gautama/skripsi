<?php
require('template/header.php');

$get_data = mysqli_query($conn, "SELECT * FROM pupuk");
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Laporan Stok</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                    <li class="breadcrumb-item active">Laporan Stok</li>
                </ol>
                <div class="clearfix"></div>

            </div>
        </div>
    </div> <!-- end row -->
    <!-- tambah data -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Laporan Stok</b></h4>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <label for="">Pilih Priode Laporan:</label>
                        <input type="month" id="priode" class="form-control" value="<?= date('Y-m') ?>">
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="mainTableButton" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pupuk</th>
                                <th>Stok Awal (kg)</th>
                                <th>Jumlah Masuk (kg)</th>
                                <th>Jumlah Keluar (kg)</th>
                                <th>Total Petani</th>
                                <th>Sisa Stok (kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['bulan'])) {
                                $bln = $_GET['bulan'];
                            } else {
                                $bln = date('Y-m');
                            }

                            $total = 0;
                            foreach ($get_data as $no => $dta) {
                                $pupuk_id = $dta['id'];
                                $jatah = mysqli_query($conn, "SELECT * FROM permintaan JOIN jatah ON permintaan.petani_id = jatah.petani_id WHERE jatah.pupuk_id = '$pupuk_id'");

                                $petani = [];
                                $jumlah = [];
                                foreach ($jatah as $jta) {
                                    $priode = date('Y-m', strtotime($jta['tgl_permintaan']));
                                    if ($priode == $bln) {
                                        $petani[] = $jta['petani_id'];
                                        $jumlah[] = $jta['jumlah'];
                                    }
                                }

                                $set_ptn = array_unique($petani);
                                $total += array_sum($jumlah);

                                // stok awal
                                $stok_masuk_old = mysqli_query($conn, "SELECT * FROM riwayat_stok WHERE pupuk_id = '$pupuk_id' AND status='masuk'");
                                $stok_keluar_old = mysqli_query($conn, "SELECT * FROM riwayat_stok WHERE pupuk_id = '$pupuk_id' AND status='keluar'");

                                $masuk_old = 0;
                                foreach ($stok_masuk_old as $smo) {
                                    $get_bln = date('Y-m', strtotime($smo['tanggal']));
                                    if ($get_bln < $bln) {
                                        $masuk_old += $smo['jumlah'];
                                    }
                                }

                                $keluar_old = 0;
                                foreach ($stok_keluar_old as $sko) {
                                    $get_bln = date('Y-m', strtotime($sko['tanggal']));
                                    if ($get_bln < $bln) {
                                        $keluar_old += $sko['jumlah'];
                                    }
                                }

                                $stok_awal = $masuk_old - $keluar_old;

                                // stok sekarang
                                $stok_masuk_now = mysqli_query($conn, "SELECT * FROM riwayat_stok WHERE pupuk_id = '$pupuk_id' AND status='masuk'");
                                $stok_keluar_now = mysqli_query($conn, "SELECT * FROM riwayat_stok WHERE pupuk_id = '$pupuk_id' AND status='keluar'");

                                $masuk_now = 0;
                                foreach ($stok_masuk_now as $smn) {
                                    $get_bln = date('Y-m', strtotime($smn['tanggal']));
                                    if ($get_bln == $bln) {
                                        $masuk_now += $smn['jumlah'];
                                    }
                                }

                                $keluar_now = 0;
                                foreach ($stok_keluar_now as $skn) {
                                    $get_bln = date('Y-m', strtotime($skn['tanggal']));
                                    if ($get_bln == $bln) {
                                        $keluar_now += $skn['jumlah'];
                                    }
                                }



                                $stok_sisa = ($stok_awal + $masuk_now) - $keluar_now;

                            ?>
                                <tr>
                                    <td><?= $no + 1 ?></td>
                                    <td><?= $dta['nama_pupuk'] ?></td>
                                    <td><?= $stok_awal ?> (kg)</td>
                                    <td><?= $masuk_now ?> (kg)</td>
                                    <td><?= $keluar_now ?> (kg)</td>
                                    <td><?= count($set_ptn) ?></td>
                                    <td><?= $stok_sisa ?> (kg)</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                                <th colspan="3" class="text-center">Total Keseluruhan</th>
                                <th><?= $total ?> (kg)</th>
                                <th><?= $total ?> (kg)</th>
                            </tr>
                        </tfoot> -->
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

<script>
    $(document).ready(function() {
        $('#priode').change(function(e) {
            e.preventDefault();

            var bulan = $(this).val();
            window.location.href = "laporan_stok.php?bulan=" + bulan;
        });

        <?php if (isset($_GET['bulan'])) {
            $bln = $_GET['bulan']; ?>
            $('#priode').val("<?= $bln ?>");
        <?php } ?>
    });
</script>