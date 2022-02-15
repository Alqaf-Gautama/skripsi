<?php

class CekPetani
{
    public function cek_status($nik)
    {
        global $conn;
  
        $petani = mysqli_query($conn, "SELECT * FROM petani WHERE nik = '$nik'");
        $ptn = mysqli_fetch_assoc($petani);

        if ($ptn['id']) $status = 'Terdaftar';
        else $status = 'Tidak Terdaftar';

        return $status;
    }
}