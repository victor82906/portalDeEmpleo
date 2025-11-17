<?php $this->layout('layout')?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/crudEmpresa.css">
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/headerFooter.css">
<?php $this->stop() ?>

<?php $this->start('main')?>

    <main>
        <div id="divControles">
            <a href="?menu=editarEmpresa" id="añadir"></a>
        </div>
        <div>

        <form method="GET" action="" id="numEmpresas">

            <!-- filtro -->
            <div id="divFiltro">
                <label for="filtro">Filtrar por:</label>
                <select name="filtro" id="filtro">
                    <option value="">(Sin filtro)</option>
                    <option value="id"        <?= (isset($_GET['filtro']) && $_GET['filtro'] === "id")        ? 'selected' : '' ?>>ID</option>
                    <option value="nombre"    <?= (isset($_GET['filtro']) && $_GET['filtro'] === "nombre")    ? 'selected' : '' ?>>Nombre</option>
                    <option value="correo"    <?= (isset($_GET['filtro']) && $_GET['filtro'] === "correo")    ? 'selected' : '' ?>>Correo</option>
                    <option value="telefono"  <?= (isset($_GET['filtro']) && $_GET['filtro'] === "telefono")  ? 'selected' : '' ?>>Teléfono</option>
                </select>
                <input type="text" name="valor" placeholder="Valor..." value="<?= $_GET['valor'] ?? '' ?>"/>
            </div>

            <div>
                <input type="hidden" name="menu" value="crudEmpresa">
                <label for="limit">Empresas por pagina:</label>
                <select name="limit" id="limit">
                <?php foreach ([5, 10, 15, 20, 30, 50] as $opcion): ?>
                    <option value="<?= $opcion ?>" <?= $paginador['porPagina'] == $opcion ? 'selected' : '' ?>>
                        <?= $opcion ?>
                    </option>
                <?php endforeach; ?>
                </select>
                <button type="submit" class="botonesPag">Aceptar</button>
            </div>

        </form>

        </div>
        <div class="divTabla">
            <table id="tablaEmpresas">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>EDICION</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($empresas as $empresa){ ?>
        
                    <tr>
                        <td><?=$empresa->getId()?></td>
                        <td><?=$empresa->getNombre()?></td>
                        <td><?=$empresa->getCorreo()?></td>
                        <td><a class="boton editar" href="?menu=editarEmpresa&id=<?= $empresa->getId() ?>"></a><a class="boton borrar" href="?menu=borrarEmpresa&id=<?= $empresa->getId() ?>" onclick="return confirm('¿Seguro que deseas eliminar esta empresa?');"></a></td>
                    </tr>
        
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div>

            <?php if ($paginador['hasPrev']): ?>
                <a href="?menu=crudEmpresa&page=<?= $paginador['paginaActual'] - 1 ?>&limit=<?= $paginador['porPagina'] ?>" class="botonesPag"><=</a>
            <?php else: ?>
                <span class="botonesPag"><=</span>
            <?php endif; ?>

            <span>Página <?= $paginador['paginaActual'] ?> de <?= $paginador['totalPaginas'] ?></span>

            <?php if ($paginador['hasNext']): ?>
                <a href="?menu=crudEmpresa&page=<?= $paginador['paginaActual'] + 1 ?>&limit=<?= $paginador['porPagina'] ?>" class="botonesPag">=></a>
            <?php else: ?>
                <span class="botonesPag">=></span>
            <?php endif; ?>

        </div>

        <?php if(count($empresasNoActivas) > 0){ ?>

        <div class="divTabla">
            <h1>Empresas No Activas</h1>
            <table id="tablaEmpresasNoActivas">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>EDICION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($empresasNoActivas as $empresa){ ?>
            
                    <tr>
                        <td><?=$empresa->getId()?></td>
                        <td><?=$empresa->getNombre()?></td>
                        <td><?=$empresa->getCorreo()?></td>
                        <td><a class="boton editar" href="?menu=editarEmpresa&id=<?= $empresa->getId() ?>"></a><a class="boton borrar" href="?menu=borrarEmpresa&id=<?= $empresa->getId() ?>" onclick="return confirm('¿Seguro que deseas eliminar esta empresa?');"></a></td>
                    </tr>
            
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php } ?>
        </div>
    </main>

<?php $this->stop()?>