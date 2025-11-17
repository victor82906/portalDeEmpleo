<?php

namespace PortalDeEmpleo2;

use PortalDeEmpleo2\Router\Router;

require_once 'autoLoad.php';
require_once 'vendor/autoload.php';

$router = new Router();
$router->arranca();

?>