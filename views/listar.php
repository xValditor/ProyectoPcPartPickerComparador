<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PcPartPicker</title>
</head>
<?php $colorFondo = $_COOKIE['color_fondo'] ?? '#ffffff'; ?>
<body style="background-color: <?= $colorFondo ?>">

    <h1>PcPartPicker</h1>

    <div style="padding: 10px; margin-bottom: 20px;">
        <?php if (isset($_SESSION['usuario_id'])): ?>
            Bienvenido, <b><?= $_SESSION['usuario_email'] ?></b>
            <a href="index.php?accion=logout">Cerrar Sesión</a>
        <?php else: ?>
            <a href="index.php?accion=login">Iniciar Sesión</a>
            <a href="index.php?accion=alta">Registrarse</a>
        <?php endif; ?>
    </div>

    <form method="POST" action="index.php?accion=cambiarColor">
        <select name="color">
            <option value="#ffffff" <?= ($colorFondo === '#ffffff') ? 'selected' : '' ?>>Blanco</option>
            <option value="#cce5ff" <?= ($colorFondo === '#cce5ff') ? 'selected' : '' ?>>Azul</option>
            <option value="#b3ffb3" <?= ($colorFondo === '#b3ffb3') ? 'selected' : '' ?>>Verde</option>
            <option value="#ffb3b3" <?= ($colorFondo === '#ffb3b3') ? 'selected' : '' ?>>Rojo</option>
            <option value="#ffecb3" <?= ($colorFondo === '#ffecb3') ? 'selected' : '' ?>>Amarillo</option>
        </select>
        <button type="submit">Cambiar color</button>
    </form>

    <br>
    <?php if (isset($_SESSION['usuario_id'])): ?>
        <a href="index.php?accion=crear">Agregar Componente</a> |
    <?php endif; ?>
    <a href="index.php?accion=comparar">Comparar precios</a>
    <br><br>

    <table border="1" cellpadding="10">
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

        <?php foreach ($componentes as $c): ?>
        <tr>
            <td><?= $c->getId() ?></td>
            <td><?= get_class($c) ?></td>
            <td><?= $c->getNombre() ?></td>
            <td><?= $c->getFabricante() ?></td>
            <td><?= $c->getPrecio() ?>€</td>
            <td><?= $c->getConsumo() ?>W</td>
            <td><?= $c->getAnioLanzamiento() ?></td>
            <td><?= $c->getFechaRegistro() ?? '—' ?></td>
            <td>
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
                <td>
                    <a href="index.php?accion=editar&id=<?= $c->getId() ?>">Editar</a>
                    |
                    <a href="index.php?accion=eliminar&id=<?= $c->getId() ?>">Eliminar</a>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
