<?php
use PHPUnit\Framework\TestCase;

require('../config.php');
require_once "CekPetani.php";
require_once "CekPeriode.php";
require_once "LoginProccess.php";

class SimpleTest extends TestCase
{
    
    public function test_cek_status_jika_terdaftar()
    {
        $cek = new CekPetani();

        $nik = "7324060101870004";
        $status = $cek->cek_status($nik);

        $this->assertEquals('Terdaftar', $status); 
    }

    public function test_jika_kridensial_benar()
    {
        $lg = new LoginProccess();

        $username = "admin";
        $password = "admin";
        $login = $lg->login($username, $password);

        $this->assertEquals(true, $login); 

    }
    
    public function test_jika_kridensial_salah()
    {
        $lg = new LoginProccess();

        $username = "admin";
        $password = "wrong";
        $login = $lg->login($username, $password);

        $this->assertEquals(false, $login); 

    }

    public function test_penebusan_pupuk_dalam_satu_periode()
    {
        $tes = new CekPeriode();

        $tanggal_ambil = "2021-11-15";
        $cek = $tes->cek_periode($tanggal_ambil);

        $this->assertEquals(false, $cek); 

    }

}