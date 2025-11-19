<?php $this->layout('layout')?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/headerFooter.css">
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/vistaUsers.css">
<?php $this->stop() ?>

<?php $this->start('js') ?>
    <script src="/portalDeEmpleo2/Public/js/vistaAlumno.js" defer></script>
<?php $this->stop() ?>

<?php $this->start('main')?>
    
    <main>
        <input type="text" id="id" value="<?= $id ?>" hidden>
        <div>
            <img src="" alt="" class="foto">
            <h1 class="nombreApellidos"></h1>
        </div>
        <div class="divDatos">
            <div>
                <p class="correo"></p>
            </div>
            <div>
                <p class="rol"></p>
            </div>
            <div>
                <p class="direccion"></p>
            </div>
        </div>
        <div class="divContacto">
            <div class="ciclos">
                <p class="pNormal">Ciclos:</p>
            </div>
            <div class="divCV">
                <a href="" class="cv">Curriculum</a>
            </div>
        </div>
        <div>
            <a href="?menu=logout" class="logout">LogOut</a>
        </div>

    </main>

<?php $this->stop()?>