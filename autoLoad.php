<?php

spl_autoload_register('autoLoader');

function autoLoader($clase) {

    $clase = str_replace('PortalDeEmpleo2\\', '', $clase);

    $ruta =  __DIR__ . "/" . str_replace('\\', '/', $clase) . '.php';

    if (file_exists($ruta)) {
        require_once $ruta;
    }

};

?>