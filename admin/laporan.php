<?php
require('template/header.php');

function get_data($bulan)
{
    global $conn;
    $get_permintaan = mysqli_query($conn, "SELECT * FROM permintaan");
    $result = [];
    foreach ($get_permintaan as $res) {
        $get_bulan = date('Y-m', strtotime($res['tgl_permintaan']));
        if ($get_bulan == $bulan) {
            $result[] = $res;
        }
    }

    return $result;
}

$get_data = get_data(date('Y-m'));

if (isset($_GET['bulan'])) {
    $bln = $_GET['bulan'];
    $get_data = get_data($bln);
}

$pupuk = mysqli_query($conn, "SELECT * FROM pupuk");
$jum_pupuk = mysqli_num_rows($pupuk);
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Laporan Penebusan</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item">Laporan</li>
                    <li class="breadcrumb-item active">Laporan Penebusan</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> <!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Laporan Penebusan</b></h4>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <label for="">Pilih Priode Laporan:</label>
                        <input type="month" id="priode" class="form-control" value="<?= date('Y-m') ?>">
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="mainTableButton" class="table table-bordered m-b-0" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">NIK</th>
                                <th rowspan="2">Nama</th>
                                <th rowspan="2">Tanggal Penebusan</th>
                                <th colspan="<?= $jum_pupuk ?>" class="text-center">Jenis Pupuk(Kg)</th>
                            </tr>
                            <tr>
                                <?php foreach ($pupuk as $ppk) { ?>
                                    <th><?= $ppk['nama_pupuk'] ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($pupuk as $j => $ppk) {
                                $jumlah[$j] = 0;
                            }
                            foreach ($get_data as $i => $dta) {
                                $petani_id = $dta['petani_id'];
                                $petani = mysqli_query($conn, "SELECT * FROM petani WHERE id='$petani_id'");
                                $ptn = mysqli_fetch_assoc($petani);
                                $jatah = mysqli_query($conn, "SELECT * FROM jatah WHERE petani_id='$petani_id'"); ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= $ptn['nik'] ?></td>
                                    <td><?= $ptn['nama'] ?></td>
                                    <td><?= date('d/m/Y', strtotime($dta['tgl_permintaan'])) ?></td>
                                    <?php
                                    foreach ($pupuk as $k => $ppk) {
                                        $cek = false;
                                        foreach ($jatah as $jta) {
                                            if ($ppk['id'] == $jta['pupuk_id']) {
                                                echo "<td><b>" . $jta['jumlah'] . " (kg)" . "</b></td>";
                                                $jumlah[$k] = $jumlah[$k] + $jta['jumlah'];
                                                $cek = true;
                                            }
                                        }

                                        if (!$cek)  echo "<td>0 (kg)</td>";
                                    }
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-center"><b>JUMLAH</b></th>
                                <?php foreach ($jumlah as $jum) { ?>
                                    <th><b><?= $jum ?> (kg)</b></th>
                                <?php } ?>
                            </tr>
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

<script>
    $(document).ready(function() {
        $('#priode').change(function(e) {
            e.preventDefault();

            var bulan = $(this).val();
            window.location.href = "laporan.php?bulan=" + bulan;
        });

        <?php if (isset($_GET['bulan'])) {
            $bln = $_GET['bulan']; ?>
            $('#priode').val("<?= $bln ?>");
        <?php } ?>
    });
</script>