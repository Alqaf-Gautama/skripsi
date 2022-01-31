<?php
use PHPUnit\Framework\TestCase;

require_once "LoginProccess.php";
require_once "CekPetani.php";

class SimpleTest extends TestCase
{
    public function testLogin()
    {
        $lg = new LoginProccess();

        $username = "admin";
        $password = "admin";
        $login = $lg->login($username, $password);

        $this->assertEquals(true, $login); 
    }

    public function cekStatus()
    {
        $cek = new CekPetani();

        $nik = "7315034411790001";
        $status = $cek->cek_status($nik);

        $this->assertEquals('Terdaftar', $status); 
    }
}