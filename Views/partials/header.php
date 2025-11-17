<?php
    use PortalDeEmpleo2\Helpers\Login;
    use PortalDeEmpleo2\Helpers\Authorization;
?>

<header>
    <div>
        <a href="/portalDeEmpleo2/?menu=home">
            <img src="/portalDeEmpleo2/Public/img/logoPequeno.png" alt="logo" class="logoChico">
        </a>
    </div> <!-- logo -->
    <div>
    <?php if(Login::isLogin()): ?> 
        <?php if(Authorization::checkRole("alumno")): ?>

        <a href="?menu=mostrarSolicitudes" class="botonHeader">Solicitudes</a>
        <a href="?menu=solicitarOferta" class="botonHeader">Ofertas</a>
        <a href="" class="botonHeader">Notificaciones</a>
            
        <?php elseif(Authorization::checkRole("empresa")): ?>

        <a href="?menu=gestionarSolicitudes" class="botonHeader">Solicitudes</a>
        <a href="?menu=crearOferta" class="botonHeader">Ofertas</a>
        <a href="" class="botonHeader">Notificaciones</a>

        <?php elseif(Authorization::checkRole("admin")): ?>

        <a href="?menu=crudAlumno" class="botonHeader">Alumnos</a>
        <a href="?menu=crudEmpresa" class="botonHeader">Empresas</a>
        <a href="" class="botonHeader">Notificaciones</a>

        <?php endif; ?>
    </div>
    <div>

        <a href="?menu=logout"><img src="<?= Login::getUser()["foto"] ?>" alt="FotoUser" class="logoChico"></a>  

    <?php else: ?>

        <a href="/portalDeEmpleo2/?menu=login" class="login botoncitos">Login</a>
        
    <?php endif; ?>
    </div> <!-- menu -->
</header>