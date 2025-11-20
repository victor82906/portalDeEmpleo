<?php $this->layout('layoutLogins')?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/login.css">
<?php $this->stop() ?>

<?php $this->start('main')?>
    
    <section>
        <form action="?menu=login" method="POST">
            <div>
                <a href="/portalDeEmpleo2/?menu=home"><img src="/portalDeEmpleo2/Public/img/logoPequeno.png" alt="logo" class="logoChico"></a>
            </div>
            <h2>Login</h2>
            <div>
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo">
            </div>
            <div>
                <label for="passw">Contraseña:</label>
                <input type="password" name="passw" id="passw">
                <span class="error"></span>
                <span class="error"> <?= $mensaje ?? "" ?> </span>
            </div>
            <div>
                <button type="submit" class="boton">Entrar</button>
            </div>
            <div>¿¿TODAVIA NO ESTAS REGISTRADO??</div>
            <div>REGISTRETE COMO:</div>
            <div>
                <a href="/portalDeEmpleo2/?menu=registrarAlumno" class="boton">Alumno</a>
                <a href="/portalDeEmpleo2/?menu=registrarEmpresa" class="boton">Empresa</a>
            </div>
        </form>
    </section>

<?php $this->stop()?>