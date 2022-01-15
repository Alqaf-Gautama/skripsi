<?php

require '../config.php';

if (isset($_POST['req'])) {
    header('Content-type: application/json');

    if ($_POST['req'] == 'getPetani') {
        $petani_id = $_POST['petani_id'];
        $petani = mysqli_query($conn, "SELECT * FROM petani WHERE id='$petani_id'");
        $ptn = mysqli_fetch_assoc($petani);

        $data = null;
        if ($ptn) {
            $klp_id = $ptn['kelompok_id'];
            $kelompok = mysqli_query($conn, "SELECT * FROM kelompok WHERE id='$klp_id'");
            $klp = mysqli_fetch_assoc($kelompok);
            $get_jatah = mysqli_query($conn, "SELECT * FROM jatah WHERE petani_id='$petani_id'");

            $harga = 0;
            $jatah = '<div>';
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
