<?php $this->layout('layout')?>

<?php $this->start('js') ?>
    <script src="/portalDeEmpleo2/Public/js/modificarAlumno.js" defer></script>
    <script src="/portalDeEmpleo2/Public/js/validator.js" defer></script>
<?php $this->stop() ?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/crudEmpresa.css">
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/editarEmpresa.css">
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/headerFooter.css">
<?php $this->stop() ?>

<?php $this->start('main')?>
    <main>
        <div id="divControles">
            <input type="file" id="cargarMasiva">
            <span id="btnCargarMasiva"></span>
            <span id="añadir"></span>
        </div>
        <div class="divTabla">
            <table id="tablaAlumnos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="velo hidden"></div>
        <div class="modal hidden" id="modal">
            <div class="divBotones divGrande">
                <button id="cancelarEdit">Cancelar</button>
                <button id="guardarEdit">Guardar</button>
            </div>
        </div>
    </main>

<?php $this->stop()?>