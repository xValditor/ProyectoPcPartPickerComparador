<?php include 'header.php'; ?>

<main>
    <h2>Componentes</h2>

    <?php if (isset($_SESSION['usuario_id'])): ?>
        <p><a href="/ProyectoPcPartPickerComparador/index.php?accion=crear" class="btn">+ Añadir componente</a></p>
        <br>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Fabricante</th>
                <th>Precio</th>
                <th>Consumo</th>
                <th>Año</th>
                <th>Fecha registro</th>
                <th>Especificaciones</th>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($componentes as $c): ?>
            <tr>
                <td data-label="ID"><?= $c->getId() ?></td>
                <td data-label="Tipo"><?= get_class($c) ?></td>
                <td data-label="Nombre"><?= $c->getNombre() ?></td>
                <td data-label="Fabricante"><?= $c->getFabricante() ?></td>
                <td data-label="Precio"><?= $c->getPrecio() ?>€</td>
                <td data-label="Consumo"><?= $c->getConsumo() ?>W</td>
                <td data-label="Año"><?= $c->getAnioLanzamiento() ?></td>
                <td data-label="Fecha registro"><?= $c->getFechaRegistro() ?? '—' ?></td>
                <td data-label="Especificaciones">
                    <?php if ($c instanceof Procesador): ?>
                        <?= $c->getNucleos() ?> núcleos |
                        <?= $c->getFrecuencia() ?> GHz |
                        <?= $c->getSocket() ?>
                    <?php elseif ($c instanceof TarjetaGrafica): ?>
                        <?= $c->getMemoriaVRAM() ?>GB VRAM |
                        <?= $c->getVelocidadMemoria() ?> MHz |
                        <?= $c->getEnsamblador() ?>
                    <?php else: ?>
                        <?= $c->getCapacidad() ?>GB |
                        <?= $c->getFrecuencia() ?> MHz |
                        <?= $c->getTipo() ?> |
                        CL<?= $c->getLatencia() ?>
                    <?php endif; ?>
                </td>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <td data-label="Acciones">
                        <a href="/ProyectoPcPartPickerComparador/index.php?accion=editar&id=<?= $c->getId() ?>" class="btn">Editar</a>
                        <a href="/ProyectoPcPartPickerComparador/index.php?accion=eliminar&id=<?= $c->getId() ?>" class="btn danger">Eliminar</a>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php include 'footer.php'; ?>
