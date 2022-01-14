<?php 
require('template/header.php');
?> 
  <div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Data Petani</h4>

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
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Pupuk</th>
                            <th>Jatah Pupuk(Kg/Liter)</th>
                           
                        </tr>
                        </thead>
                        <tbody> 
                        <tr>
                            <td>1</td>
                            <td>7324060307810001</td>
                            <td>Rahmat</td>
                            <td>urea</td>
                            <td>7</td>
                                                  
                        </tr>                                               
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