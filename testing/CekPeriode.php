<?php

class CekPeriode
{
    public function cek_periode($tanggal)
    {
        global $conn;
  
        $tggl_req = strtotime('+3 month', strtotime($tanggal));
        $tggl_now = strtotime(date('Y-m-d'));

        if ($tggl_req >= $tggl_now) $status = false;
        else $status = true;

        return $status;
    }
}