<?php

namespace PortalDeEmpleo2\Helpers;

class Paginator{

    public static function getOffset($paginaActual, $porPagina){
        $paginaActual = max(1, $paginaActual);
        return ($paginaActual - 1) * $porPagina;
    }

    public static function getTotalPaginas($totalRegistros, $porPagina){
        return (int) ceil($totalRegistros / max(1, $porPagina));
    }

    public static function hasPrev($paginaActual){
        return $paginaActual > 1;
    }

    public static function hasNext($paginaActual, $totalPaginas){
        return $paginaActual < $totalPaginas;
    }

    public static function build(int $totalRegistros, int $paginaActual, int $porPagina){
        $totalPaginas = self::getTotalPaginas($totalRegistros, $porPagina);
        $offset = self::getOffset($paginaActual, $porPagina);

        return [
            'paginaActual' => $paginaActual,
            'porPagina'    => $porPagina,
            'totalPaginas' => $totalPaginas,
            'offset'       => $offset,
            'hasPrev'      => self::hasPrev($paginaActual),
            'hasNext'      => self::hasNext($paginaActual, $totalPaginas)
        ];
    }

}

?>