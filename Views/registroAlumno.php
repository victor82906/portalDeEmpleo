<?php $this->layout('layoutLogins')?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/login.css">
<?php $this->stop() ?>

<?php $this->start('js') ?>
    <script src="/portalDeEmpleo2/Public/js/registrarAlumno.js" defer></script>
    <script src="/portalDeEmpleo2/Public/js/validator.js" defer></script>
<?php $this->stop() ?>

<?php $this->start('main')?>
    
    <section>
        <div id="form">
        <!-- <form action="#"> -->
            <div id="links">
                <a href="/portalDeEmpleo2/?menu=home"><img src="/portalDeEmpleo2/Public/img/logoPequeno.png" alt="logo" class="logoChico"></a>
                <img src="/portalDeEmpleo2/Public/img/camara.png" alt="camara" class="logoChico" id="abrirCamara">
            </div>
            <h2>Registro Alumno</h2>
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre">
                <span class="error"></span>
            </div>
            <div>
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo">
                <span class="error"></span>
            </div>
            <div>
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos">
                <span class="error"></span>
            </div>
            <div>
                <label for="passw">Contraseña:</label>
                <input type="password" name="passw" id="passw">
                <span class="error"></span>
            </div>
            <div>
                <label for="direccion">Direccion:</label>
                <input type="text" name="direccion" id="direccion">
                <span class="error"></span>
            </div>
            <div class="archivo">
                <label for="foto">Foto Perfil:</label>
                <input type="file" name="foto" id="foto">
                <img id="preview" style="width:150px;height:150px;object-fit:cover;display:none;border-radius:8px;">
                <span class="error"></span>
            </div>
            <div class="archivo">
                <label for="cv">Curriculum:</label>
                <input type="file" name="cv" id="cv">
                <span class="error"></span>
            </div>
            <div id="boton">
                <button class="boton">Crear Cuenta</button>
            </div>
        </div>
        <div class="velo hidden"></div>
        <div class="modal hidden" id="modal">
            <div id="camaraContainer">
                <h3>Capturar Foto de Perfil</h3>
                <video id="videoCamara" width="300" height="300" autoplay></video>
                <canvas id="canvasFoto" width="300" height="300" style="display:none;"></canvas>
            </div>
            <div class="divBotones divGrande">
                <button id="cancelarEdit" class="boton">Cancelar</button>
                <button id="capturarYGuardar" class="boton">Capturar</button>
            </div>
        </div>
    </section>

<?php $this->stop()?>