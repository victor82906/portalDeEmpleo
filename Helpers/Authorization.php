<?php

namespace PortalDeEmpleo2\Helpers;

class Authorization {

    public static function checkRole($rolRequerido) {

        if (!isset($_SESSION['user'])) {
            return false;
        }

        return $_SESSION['user']['rol'] === $rolRequerido;
    }

    public static function requireRole($rolRequerido) {
        Session::openSession();

        if (!isset($_SESSION['user'])) {
            header("Location: /portalDeEmpleo2/?menu=login");
            exit;
        }

        if ($_SESSION['user']['rol'] !== $rolRequerido) {
            header("Location: /portalDeEmpleo2/?menu=home");
            exit;
        }
    }

}

?>