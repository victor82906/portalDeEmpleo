<?php $this->layout('layoutLogins')?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/login.css">
<?php $this->stop() ?>

<?php $this->start('main')?>
    
    <section>
        <form action="?menu=registrarEmpresa" method="POST" enctype="multipart/form-data"> <!-- el enctype es para poder mandar fotos  -->
            <div>
                <a href="/portalDeEmpleo2/?menu=home"><img src="/portalDeEmpleo2/Public/img/logoPequeno.png" alt="logo" class="logoChico"></a>
            </div>
            <h2>Registro Empresa</h2>
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?= $data["nombre"] ?? "" ?>">
                <span class="error"><?= $errores['nombre'] ?? "" ?></span>
            </div>
            <div>
                <label for="telefono">Telefono:</label>
                <input type="tel" name="telefono" id="telefono" value="<?= $data["telefono"] ?? "" ?>">
                <span class="error"><?= $errores['telefono'] ?? "" ?></span>
            </div>
            <div>
                <label for="direccion">Direccion:</label>
                <input type="text" name="direccion" id="direccion" value="<?= $data["direccion"] ?? "" ?>">
                <span class="error"><?= $errores['direccion'] ?? "" ?></span>
            </div>
            <div>
                <label for="personaContacto">Persona Contacto:</label>
                <input type="text" name="personaContacto" id="personaContacto" value="<?= $data["personaContacto"] ?? "" ?>">
                <span class="error"><?= $errores['personaContacto'] ?? "" ?></span>
            </div>
            <div>
                <label for="numeroContacto">Numero Contacto:</label>
                <input type="tel" name="numeroContacto" id="numeroContacto" value="<?= $data["numeroContacto"] ?? "" ?>">
                <span class="error"><?= $errores['numeroContacto'] ?? "" ?></span>
            </div>
            <div>
                <label for="descripcion">Descripcion:</label>
                <textarea name="descripcion" id="descripcion"><?= $data["descripcion"] ?? "" ?></textarea>
                <span class="error"><?= $errores['descripcion'] ?? "" ?></span>
            </div>
            <div>
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" value="<?= $data["correo"] ?? "" ?>">
                <span class="error"><?= $errores['correo'] ?? "" ?></span>
            </div>
            <div>
                <label for="passw">Contraseña:</label>
                <input type="password" name="passw" id="passw" value="<?= $data["passw"] ?? "" ?>">
                <span class="error"><?= $errores['passw'] ?? "" ?><?= $mensaje ?? "" ?></span>
            </div>
            <div class="archivo">
                <label for="foto">Foto Perfil:</label>
                <input type="file" name="foto" id="foto">
                <span class="error"><?= $errores['foto'] ?? "" ?></span>
            </div>
            <div id="boton">
                <button type="submit" class="boton">Crear Empresa</button>
            </div>
        </form>
    </section>

<?php $this->stop()?>