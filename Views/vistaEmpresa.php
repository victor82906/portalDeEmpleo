<?php $this->layout('layout')?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/headerFooter.css">
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/vistaUsers.css">
<?php $this->stop() ?>

<?php $this->start('js') ?>
    <script src="/portalDeEmpleo2/Public/js/vistaEmpresa.js" defer></script>
<?php $this->stop() ?>

<?php $this->start('main')?>
    
    <main>
        <input type="text" id="id" value="<?= $id ?>" hidden>
        <div>
            <img src="" alt="" class="foto">
            <h1 class="nombre"></h1>
        </div>
        <div class="divDatos">
            <div>
                <p class="correo"></p>
            </div>
            <div>
                <p class="rol"></p>
            </div>
            <div>
                <p class="telefono"></p>
            </div>
        </div>
        <div>
            <p class="descripcion"></p>
        </div>
        <div class="divContacto">
            <div>
                <p class="pNormal">Persona De Contacto:</p>
                <p class="personaContacto"></p>
            </div>
            <div>
                <p class="pNormal">Telefono De Contacto:</p>
                <p class="telefonoContacto"></p>
            </div>
            <div>
                <p class="pNormal">Direccion:</p>
                <p class="direccion"></p>
            </div>
        </div>
        <div>
            <a href="?menu=logout" class="logout">LogOut</a>
        </div>
    </main>

<?php $this->stop()?>