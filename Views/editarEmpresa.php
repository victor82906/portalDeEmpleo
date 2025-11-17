<?php $this->layout('layoutLogins')?>

<?php $this->start('css')?>
    <link rel="stylesheet" href="/portalDeEmpleo2/Public/css/editarEmpresa.css">
<?php $this->stop()?>

<?php $this->start('main')?>

    <form method="POST" class="formEditar" action="?menu=guardaEmpresa<?= $id ? "&id=" . $id : '' ?> " enctype="multipart/form-data">
        <?php if(!$edicion){ ?>
            <div class="divGrande">
                <label for="correo">Email:</label>
                <input type="email" name="correo" id="correo" value="<?= $data["correo"] ?? "" ?>">
                <span class="error"><?= $errores['correo'] ?? "" ?><?= $mensaje ?? "" ?></span>
            </div>
        <?php } ?>
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?= $data["nombre"] ?? (isset($empresa) ? $empresa->getNombre() : '') ?>">
            <span class="error"><?= $errores['nombre'] ?? "" ?></span>
        </div>
        <div>
            <label for="telefono">Telefono:</label>
            <input type="tel" name="telefono" id="telefono" value="<?= $data["telefono"] ?? (isset($empresa) ? $empresa->getTelefono() : '') ?>">
            <span class="error"><?= $errores['telefono'] ?? "" ?></span>
        </div>
        <div class="divGrande">
            <label for="direccion">Direccion:</label>
            <input type="text" name="direccion" id="direccion" value="<?= $data["direccion"] ?? (isset($empresa) ? $empresa->getDireccion() : '') ?>">
            <span class="error"><?= $errores['direccion'] ?? "" ?></span>
        </div>
        <div class="divGrande">
            <label for="descripcion">Descripcion:</label>
            <input type="text" name="descripcion" id="descripcion" value="<?= $data["descripcion"] ?? (isset($empresa) ? $empresa->getDescripcion() : '') ?>">
            <span class="error"><?= $errores['descripcion'] ?? "" ?></span>
        </div>
        <div>
            <label for="personaContacto">Persona Contacto:</label>
            <input type="text" name="personaContacto" id="personaContacto" value="<?= $data["personaContacto"] ?? (isset($empresa) ? $empresa->getPersonaContacto() : '') ?>">
            <span class="error"><?= $errores['personaContacto'] ?? "" ?></span>
        </div>
        <div>
            <label for="numeroContacto">Tlf Contacto:</label>
            <input type="tel" name="numeroContacto" id="numeroContacto" value="<?= $data["numeroContacto"] ?? (isset($empresa) ? $empresa->getNumPersonaContacto() : '') ?>">
            <span class="error"><?= $errores['numeroContacto'] ?? "" ?></span>
        </div>
        <div class="divGrande">
            <label for="foto">Foto Empresa:</label>
            <input type="file" name="foto" id="foto">
            <span class="error"><?= $errores['foto'] ?? "" ?></span>
        </div>
        <div id="activa">
            <label for="activa">Activa:</label>
            <input type="checkbox" name="activa" id="activa" value="1" <?= isset($empresa) && $empresa->isActiva() ? 'checked' : '' ?><?= isset($data) && isset($data["activa"]) ? "checked" : "" ?>>
        </div>
        <div class="divGrande divBotones">
            <a href="/portalDeEmpleo2/?menu=crudEmpresa">Cancelar</a>
            <button type="submit">Guardar</button>
        </div>
    </form>

<?php $this->stop()?>