<?php $this->layout('layout')?>

<?php $this->start('css') ?>
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/crearOferta.css">
    <link rel="stylesheet" href= "/portalDeEmpleo2/Public/css/headerFooter.css">
<?php $this->stop() ?>

<?php $this->start('main')?>
    
    <section>
        <form action="?menu=crearOferta" method="POST">
            <h2>Crear oferta</h2>
            <div class="divMediano">
                <div class="divGrande">
                    <label for="descripcion">Descripcion:</label>
                    <textarea name="descripcion" id="descripcion"><?= $_POST['descripcion'] ?? '' ?></textarea>
                    <span class="error"><?= $errores["descripcion"] ?? "" ?></span>
                </div>
                <div class="divGrande">
                    <label for="fin">Fin Inscripcion:</label>
                    <input type="date" name="fin" id="fin" value="<?= $_POST['fin'] ?? '' ?>">
                    <span class="error"><?= $errores["fin"] ?? "" ?></span>
                </div>
            </div>
            
            <!-- Selección de Familia -->
            <div class="divMediano">
                <div class="divGrande">
                    <label for="familia">Familia Profesional:</label>
                    <select name="familia" id="familia">
                        <option value="">--Selecciona--</option>
                        <?php foreach($familias as $f): ?>
                            <option value="<?= $f->getId() ?>" <?= ($familiaId == $f->getId()) ? 'selected' : '' ?>>
                                <?= $f->getNombre() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="accion" value="seleccionarFamilia">Ver Ciclos</button>
                </div>
                <span class="error"><?= isset($mensaje) ? $mensaje : "" ?></span>

                <!-- Selección de Ciclos -->
                <?php if(!empty($ciclos)): ?>
                <div class="divGrande">
                    <div class="divGrande">
                        <label for="ciclos">Ciclos:</label>
                        <select name="ciclos[]" id="ciclos">
                            <option value="">--Selecciona--</option>
                            <?php foreach($ciclos as $c): ?>
                                <option value="<?= $c->getId() ?>">
                                    <?= $c->getNombre() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="soloCiclo">Agregar solo Ciclo:</label>
                        <input type="checkbox" name="soloCiclo" id="soloCiclo">
                    </div>
                </div>
                <?php endif; ?>

                <?php if(!empty($ciclosSeleccionados)): ?>
                    <div>
                        <p id="seleccionados">Ciclos Seleccionados:</p>
                        <ul>
                            <?php foreach($nombresCiclos as $nombre): ?>
                                <li><?= $nombre ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <?php foreach($ciclosSeleccionados as $id): ?>
                <input type="hidden" name="ciclosSeleccionados[]" value="<?= $id ?>">
            <?php endforeach; ?>

            <div class="divGrande">
                <button type="submit" class="boton">Crear</button>
            </div>
        </form>
    </section>

<?php $this->stop()?>