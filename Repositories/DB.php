<?php

namespace PortalDeEmpleo2\Repositories;
use PDO;

class DB{

    private static string $host = 'localhost';
    private static string $bd = 'portalzuelas';
    private static string $user = 'root';
    private static string $passw = 'root'; 


    public static function getConection(){
        return new PDO('mysql:host='.self::$host.';dbname='.self::$bd , self::$user, self::$passw);
    }

}

?>