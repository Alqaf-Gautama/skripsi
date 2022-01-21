<?php
require('config.php');
$get_pupuk = mysqli_query($conn, "SELECT * FROM pupuk");
$get_kelompok = mysqli_query($conn, "SELECT * FROM kelompok");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Informasi Distribusi Pupuk Mega Karya Buana Tani</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target scrolled awake" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand">Megakarya<span>Tani</span></a>
      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav nav ml-auto">
          <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
          <li class="nav-item"><a href="#services-section" class="nav-link"><span>Informasi</span></a></li>
          <li class="nav-item"><a href="#about-section" class="nav-link"><span>Tentang</span></a></li>
          <li class="nav-item"><a href="#contact-section" class="nav-link"><span>Kontak </span></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <section id="home-section" class="hero">
    <h3 class="vr">Selamat Datang</h3>
    <div class="home-slider js-fullheight owl-carousel">
      <div class="slider-item js-fullheight">
        <div class="overlay"></div>
        <div class="container-fluid p-0">
          <div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
            <div class="one-third order-md-last img js-fullheight" style="background-image:url(images/pupuk.jpg);">
              <div class="overlay"></div>
            </div>
            <div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
              <div class="text">
                <span class="subheading">Selamat Datang Di</span>
                <h1 class="mb-4 mt-3">Web Informasi Distribusi Pupuk <span>PT. Mega Karya Buana Tani</span></h1>
                <p>Website ini berisi informasi data petani dan pupuk pada PT. mega Karya buana tani</p>

                <p><a href="#services-section" class="btn btn-primary px-5 py-3 mt-3">Cek Jatah Pupuk</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="slider-item js-fullheight">
        <div class="overlay"></div>
        <div class="container-fluid p-0">
          <div class="row d-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
            <div class="one-third order-md-last img js-fullheight" style="background-image:url(images/pupuk_kaltim.jpg);">
              <div class="overlay"></div>
            </div>
            <div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
              <div class="text">
                <span class="subheading">Selamat Datang Di</span>
                <h1 class="mb-4 mt-3">Web Informasi Distribusi Pupuk <span>PT. Mega Karya Buana Tani</span></h1>
                <p>Website ini berisi informasi data petani dan pupuk pada PT. mega Karya buana tani</p>

                <p><a href="#services-section" class="btn btn-primary px-5 py-3 mt-3">Cek Jatah Pupuk
                  </a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="ftco-section ftco-no-pb ftco-no-pt ftco-services bg-light" id="services-section">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-4 ftco-animate py-5 nav-link-wrap">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link px-4 active" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false"><span class="mr-3 flaticon-analysis"></span> Lihat Jatah Pupuk</a>

            <a class="nav-link px-4" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false"><span class="mr-3 flaticon-flasks"></span> Data pupuk</a>

            <a class="nav-link px-4" id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-4" aria-selected="false"><span class="mr-3 flaticon-ux-design"></span> Data Kelompok</a>

          </div>
        </div>
        <div class="col-md-8 ftco-animate p-4 p-md-5 d-flex align-items-center">

          <div class="tab-content pl-md-5" id="v-pills-tabContent">

            <div class="tab-pane fade py-5 active show" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
              <h2 class="mb-4">Jatah Pupuk</h2>
              <div class="P-2">
                <form method="GET">
                  <div class=" row">
                    <div class="col-md-8">
                      <input type="text" class="form-control" placeholder="Masukkan NIK" name="" id="nik">
                    </div>
                    <div class="col-md-3">
                      <button type="button" id="cari" class="btn btn-primary"><i class="fa fa-search"></i> &nbsp;Temukan</button>
                    </div>
                  </div>
                </form>
                <hr>
                <div>
                  <ul class="list-group list-group-flush">
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
              </div>
            </div>

            <div class="tab-pane fade py-5" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab" style="width: 700px">

              <h2 class="mb-4">DATA PUPUK</h2>
              <div class="card">
                <div class="table-responsive">
                  <table id="mainTable" class="table table-striped m-b-0">
                    <thead>
                      <tr>

                        <th>No</th>
                        <th>Nama Pupuk</th>
                        <th>Stock</th>
                        <th>Harga</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($get_pupuk as $no => $dta) { ?>
                        <tr>
                          <td><?= $no + 1 ?></td>
                          <td><?= $dta['nama_pupuk'] ?></td>
                          <td><?= $dta['stock'] ?></td>
                          <td><?= $dta['harga'] ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>

            <div class="tab-pane fade py-5" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-4-tab" style="width: 700px">

              <h2 class="mb-4">Data Kelompok</h2>
              <div class="card">
                <div class="table-responsive">
                  <table id="mainTable" class="table table-striped m-b-0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Kelompok</th>
                        <th>Jumlah Anggota</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($get_kelompok as $no => $dta) { ?>
                        <tr>
                          <td><?= $no + 1 ?></td>
                          <td><?= $dta['nama_kelompok'] ?></td>
                          <td><?= $dta['jumlah_anggota'] ?></td>
                          <td><?= $dta['ket'] ?></td>
                        </tr>
                      <?php } ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-counter img ftco-section ftco-no-pt ftco-no-pb" id="about-section">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-6 col-lg-5 d-flex">
          <div class="img d-flex align-self-stretch align-items-center" style="background-image:url(images/harga-pupuk.jpg);">
          </div>
        </div>
        <div class="col-md-6 col-lg-7 pl-lg-5 py-5">
          <div class="py-md-5">
            <div class="row justify-content-start pb-3">
              <div class="col-md-12 heading-section ftco-animate">
                <h2 class="mb-4" style="font-size: 34px; text-transform: capitalize;">PT. MEGA KARYA BUANA TANI</h2>
                <p class="text-justify">PT Mega Karya Buana Tani merupakan salah satu perusahaan yang bergerak dalam bidang Distribusi berbagai jenis pupuk. PT Mega Karya Buana Tani yang beralamat di jalan trans sulawesi kelurahan tomoni, kecamtan tomoni kab luwu timur. Dalam sistem pengumpulan data transaksi distribusi penyaluran pupuk yang selama ini digunakan oleh PT Mega Karya Buana Tani adalah masih dengan cara manual yaitu dalam penginputan transaksi penjualan dan pembelian masih mengandalkan sebuah buku yang berisi RDKK (Rencana Definitif Kebutuhan Kelompok Tani) untuk di isi data transaksi distribusi pupuk.</p>
                <p class="text-justify">RDKK merupakan merupakan rencana kebutuhan pupuk bersubsidi untuk satu tahun yang disusun berdasarkan musyawarah anggota kelompok tani yang merupakan alat pesanan pupuk bersubsidi kepada gabungan kelompok tani atau penyalur sarana produksi pertanian. </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <span class="subheading">Kontak</span>
          <h2 class="mb-4">Kontak Kami</h2>
          <p>Untuk info lebih lanjut silahkan hubungi kami di:</p>
        </div>
      </div>
      <div class="row d-flex contact-info mb-5">
        <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          <div class="align-self-stretch box p-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="icon-map-signs"></span>
            </div>
            <h3 class="mb-4">Alamat</h3>
            <p>Jl. Trans Sulawesi, Kelurahan Tomoni, Kecamtan Tomoni, Kabupaten Luwu Timur.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          <div class="align-self-stretch box p-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="icon-phone2"></span>
            </div>
            <h3 class="mb-4">Telepon</h3>
            <p><a href="tel://1234567920">+6285 5937 6518</a></p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          <div class="align-self-stretch box p-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="icon-paper-plane"></span>
            </div>
            <h3 class="mb-4">Email </h3>
            <p><a href="mailto:info@yoursite.com">megakarya-tani@gmail.com</a></p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          <div class="align-self-stretch box p-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="icon-globe"></span>
            </div>
            <h3 class="mb-4">Website</h3>
            <p><a href="#">www.megakarya-tani.com</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <footer class="ftco-footer ftco-section">
    <div class="container">

      <div class="row">
        <div class="col-md-12 text-center">

          <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved | PT. Mega Karya Buana Tani by <a href="https://colorlib.com" target="_blank">Borpal Studio</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>
        </div>
      </div>
    </div>
  </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>

  <script src="js/main.js"></script>
  <script>
    $(document).ready(function() {
      $('#cari').click(function(e) {
        e.preventDefault();

        var nik = $('#nik').val();
        $.ajax({
          url: 'admin/controller.php',
          method: "POST",
          data: {
            req: 'getPetaniFront',
            nik: nik,
          },
          success: function(data) {
            if (data == null) {
              alert('NIK Petani tidak ditemukan');
              $('#nik').val('');
              $('.dtl').html('--');
            }

            $.each(data, function(key, val) {
              $('.' + key).html(val);
            });
          }
        });
      });
    });
  </script>

</body>

</html>