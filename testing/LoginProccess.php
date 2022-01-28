<?php
require('../config.php');

class LoginProccess
{
    public function login($username, $password)
    {
        global $conn;
    
        $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
        $get = mysqli_fetch_assoc($result);
    
        if ($get) {
            $get_password = $get['password'];
    
            if (password_verify($password, $get_password)) {
                $login = true;
            } else $login = false;
        } else $login = false;

        return $login;
    }
}