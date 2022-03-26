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
            <h4 class="m-t-0 header-title"><b>Laporan Stok</b></h4>
            <hr>
            <div class="card-box">
                <div class="table-responsive">
                    <table id="mainTableButton" class="table table-striped m-b-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pupuk</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($get_data as $no => $dta) { ?>
                                <tr>
                                    <td><?= $no + 1 ?></td>
                                    <td><?= $dta['nama_pupuk'] ?></td>
                                    <td><?= $dta['stock'] ?> (kg)</td>
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

<?php
require('template/footer.php');
?>

<script>
    $(document).ready(function() {

    });
</script>