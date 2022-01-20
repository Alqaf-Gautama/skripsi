<?php 
require('template/header.php');
?> 
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Laporan</h4>

                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> <!-- end row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Laporan</b></h4>
               
                <div class="table-responsive">
                    <table id="mainTableButton" class="table table-bordered m-b-0">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama</th>
                                <th rowspan="2">NIK</th>
                                <th rowspan="2">Tanggal Penebusan</th>
                                <th colspan="6" class="text-center">Jenis Pupuk(Kg/Liter)</th>
                            </tr>
                            <tr>
                                <th>UREA</th>
                                <th>ZA</th>
                                <th>SP-36</th>
                                <th>NPK</th>
                                <th>ORGANIK GRANUL</th>
                                <th>ORGANIK CAIR</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                          <tr>
                              <td colspan="4" class="text-center"><b>JUMLAH</b></td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
                              <td>0</td>
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