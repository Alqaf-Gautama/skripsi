<?php

require '../config.php';

if (isset($_POST['req'])) {
    header('Content-type: application/json');

    if ($_POST['req'] == 'getPetani') {
        $petani_id = $_POST['petani_id'];

        $permintaan = mysqli_query($conn, "SELECT * FROM permintaan WHERE petani_id='$petani_id' ORDER BY id DESC");
        $req = mysqli_fetch_assoc($permintaan);
        if ($req) {
            $tggl_req = strtotime('+3 month', strtotime($req['tgl_permintaan']));
            $tggl_now = strtotime(date('Y-m-d'));

            if ($tggl_req >= $tggl_now) {
                echo json_encode(null);
                exit();
            }
        }

        $petani = mysqli_query($conn, "SELECT * FROM petani WHERE id='$petani_id'");
        $ptn = mysqli_fetch_assoc($petani);

        $data = null;
        if ($ptn) {
            $klp_id = $ptn['kelompok_id'];
            $kelompok = mysqli_query($conn, "SELECT * FROM kelompok WHERE id='$klp_id'");
            $klp = mysqli_fetch_assoc($kelompok);
            $get_jatah = mysqli_query($conn, "SELECT * FROM jatah WHERE petani_id='$petani_id'");

            $harga = 0;
            $cek_jatah = 0;
            $cek_stok = 0;
            $jatah = '<div class="ml-5 pl-5" style="margin-top: -22px">';
            foreach ($get_jatah as $jta) {
                $pupuk_id = $jta['pupuk_id'];
                $pupuk = mysqli_query($conn, "SELECT * FROM pupuk WHERE id='$pupuk_id'");
                $ppk = mysqli_fetch_assoc($pupuk);
                $jatah .= '- ' . $ppk['nama_pupuk'] . ' (' . $jta['jumlah'] . 'Kg/Liter)<br>';

                if ($ppk['stock'] < $jta['jumlah']) $cek_stok = 1;
                $harga = $harga + $ppk['harga'];
                $cek_jatah++;
            }
            $jatah .= '</div>';
            $data = [
                'nama' => $ptn['nama'],
                'nama_kelompok' => $klp['nama_kelompok'],
                'jatah' => $jatah,
                'cek_jatah' => $cek_jatah,
                'cek_stok' => $cek_stok,
                'total_bayar' => 'Rp' . number_format($harga)
            ];
        }
        echo json_encode($data);
    }

    if ($_POST['req'] == 'getPetaniFront') {
        $nik = $_POST['nik'];

        $petani = mysqli_query($conn, "SELECT * FROM petani WHERE nik='$nik'");
        $ptn = mysqli_fetch_assoc($petani);

        $data = null;
        if ($ptn) {
            $petani_id = $ptn['id'];
            $klp_id = $ptn['kelompok_id'];
            $kelompok = mysqli_query($conn, "SELECT * FROM kelompok WHERE id='$klp_id'");
            $klp = mysqli_fetch_assoc($kelompok);
            $get_jatah = mysqli_query($conn, "SELECT * FROM jatah WHERE petani_id='$petani_id'");

            $harga = 0;
            $jatah = '<div class="ml-5 pl-5" style="margin-top: -22px">';
            foreach ($get_jatah as $jta) {
                $pupuk_id = $jta['pupuk_id'];
                $pupuk = mysqli_query($conn, "SELECT * FROM pupuk WHERE id='$pupuk_id'");
                $ppk = mysqli_fetch_assoc($pupuk);
                $jatah .= '- ' . $ppk['nama_pupuk'] . ' (' . $jta['jumlah'] . 'Kg/Liter)<br>';

                $harga = $harga + $ppk['harga'];
            }
            $jatah .= '</div>';
            $data = [
                'nama' => $ptn['nama'],
                'nama_kelompok' => $klp['nama_kelompok'],
                'jatah' => $jatah,
                'total_bayar' => 'Rp' . number_format($harga)
            ];
        }
        echo json_encode($data);
    }
}
