<?php
use PHPUnit\Framework\TestCase;

require_once "LoginProccess.php";

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
}