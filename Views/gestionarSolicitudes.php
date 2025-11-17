<?php $this->layout('layout')?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/headerFooter.css">
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/solicitarOferta.css">
<?php $this->stop() ?>

<?php $this->start('main')?>
    
    <main>
        <?php foreach($solicitudes as $solicitud): ?>
        <section>
            <div>
                <p class="nombre"><?= $solicitud["nombre"] ?></p>
                <img src="<?= $solicitud["foto"] ?>" alt="imgAlumno" class="foto">
            </div>
            <div>
                <div>
                    <p>Direccion Alumno:</p>
                    <p class="direccion"><?= $solicitud["direccion"] ?></p>
                </div>
                <div>
                    <p>Correo Alumno:</p>
                    <p class="correo"><?= $solicitud["correo"] ?></p>
                </div>
                <div>
                    <p>Curriculum:</p>
                    <a href="<?= $solicitud["curriculum"]?>" class="curriculum" <?= !empty($solicitud["curriculum"]) ? "download" : ""?> ><?= empty($solicitud["curriculum"]) ? "No tiene CV"  : "Descargar" ?></a>
                </div>
            </div>
            <div>
                <div>
                    <p>Descripcion Oferta:</p>
                    <p class="descripcion"><?= $solicitud["descripcion"] ?></p>
                </div>
                <div>
                    <p>Estudios Alumno:</p>
                    <?php foreach($solicitud["estudios"] as $estudio): ?>
                        <p class="estudios"><?= $estudio["nombre"] ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div>
                <a href="?menu=gestionarSolicitudes&accion=aceptar&id=<?= $solicitud["id"] ?>" class="boton btnVerde">Aceptar</a>
                <a href="?menu=gestionarSolicitudes&accion=rechazar&id=<?= $solicitud["id"] ?>" class="boton btnRojo">Rechazar</a>
            </div>
        </section>
        <?php endforeach; ?>
    </main>

<?php $this->stop()?>