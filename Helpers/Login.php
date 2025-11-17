<?php

namespace PortalDeEmpleo2\Helpers;

class Login{
    
    public static function login($user){
        Session::openSession();
        $_SESSION['user']=$user;
        
    }

    public static function logout(){
        Session::openSession();
        unset($_SESSION);
        Session::closeSession();
    }

    public static function isLogin(){
        //Session::openSession();
        return (isset($_SESSION['user']));
    }

    public static function getUser(){
        //Session::openSession();
        return $_SESSION['user'] ?? null;
    }

}

?>