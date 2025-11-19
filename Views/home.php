<?php $this->layout('layout')?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/home.css">
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/headerFooter.css">
<?php $this->stop() ?>

<?php $this->start('main')?>
    
    <main>
        <section>
            <h1>Introducete al mundo laboral</h1>
            <p>PortalZuelas es una plataforma diseñada para conectar a empresas y alumnos en busca de oportunidades laborales y de prácticas.
                <br>A través de un entorno intuitivo y seguro, las empresas pueden registrarse, publicar ofertas de empleo o prácticas y gestionar las solicitudes recibidas.
                <br>Por su parte, los alumnos pueden crear su perfil profesional, subir su currículum y postularse fácilmente a las ofertas que se ajusten a sus intereses y formación.
                <br>Nuestro objetivo es facilitar la inserción laboral y crear un punto de encuentro eficaz entre el talento joven y el tejido empresarial.</p>
            <img src="/portalDeEmpleo2/Public/img/logo.png" alt="logotipo">
        </section>
        <?php if(isset($empresas) && count($empresas) >= 3): ?>
        <section id="sectEmpresas">
            <h1>Ultimas Empresas</h1>
            <?php for($i = count($empresas)-1; $i >= count($empresas)-3; $i--){ ?>
            
                <div class="empresas">
                    <img src="<?=$empresas[$i]->getFoto()?>" alt="<?=$empresas[$i]->getNombre()?>" class="empresaImg">
                    <p><strong><?=$empresas[$i]->getNombre()?></strong></p>
                    <p><?=$empresas[$i]->getDescripcion()?></p>
                    <p><?=$empresas[$i]->getDireccion()?></p>
                </div>
            
            <?php } ?>

        </section>
        <?php endif; ?>
        <section id="sectLogin">
            <h1>Empieza</h1>
            <p>¿Todavia no eres usuario de PortalZuelas? Registrate facilmente.</p>
            <a href="/portalDeEmpleo2/?menu=registrarAlumno" class="login botoncitos">Alumno</a>
            <a href="/portalDeEmpleo2/?menu=registrarEmpresa" class="login botoncitos">Empresa</a>
        </section>
        <section id="sectContacta">
            <form action="?menu=enviaEmail" method="POST">
                <h1>Contacta Con Nosotros</h1>
                <textarea name="cuerpo" id="cuerpo" placeholder="Escribe su sugerencia"></textarea>
                <div>
                    <button type="submit" class="login botoncitos">Enviar</button>
                </div>
                <p><?= isset($mensaje) ? $mensaje : "" ?></p>
            </form>
        </section>
    </main>

<?php $this->stop()?>