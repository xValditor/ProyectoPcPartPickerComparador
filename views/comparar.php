<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comparar precios - PcPartPicker</title>
</head>
<?php $colorFondo = $_COOKIE['color_fondo'] ?? '#ffffff'; ?>
<body style="background-color: <?= $colorFondo ?>">

    <h1>Comparador de precios</h1>
    <p>Selecciona un componente y elige dos registros para comparar su evolución de precio.</p>

    <!-- PASO 1: elegir nombre -->
    <form method="GET" action="index.php">
        <input type="hidden" name="accion" value="comparar">
        Componente:<br>
        <select name="nombre" required>
            <option value="">-- Selecciona --</option>
            <?php foreach ($nombres as $n): ?>
                <option value="<?= htmlspecialchars($n) ?>" <?= ($nombre === $n) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($n) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Buscar registros</button>
    </form>

    <br>

    <!-- PASO 2: elegir dos registros del componente seleccionado -->
    <?php if ($nombre && count($registros) >= 2): ?>
        <form method="GET" action="index.php">
            <input type="hidden" name="accion" value="comparar">
            <input type="hidden" name="nombre" value="<?= htmlspecialchars($nombre) ?>">

            Registro A:<br>
            <select name="id1" required>
                <option value="">-- Selecciona --</option>
                <?php foreach ($registros as $r): ?>
                    <option value="<?= $r->getId() ?>" <?= ((string)$id1 === (string)$r->getId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($r->getFechaRegistro() ?? 'Sin fecha') ?> — <?= $r->getPrecio() ?>€
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            Registro B:<br>
            <select name="id2" required>
                <option value="">-- Selecciona --</option>
                <?php foreach ($registros as $r): ?>
                    <option value="<?= $r->getId() ?>" <?= ((string)$id2 === (string)$r->getId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($r->getFechaRegistro() ?? 'Sin fecha') ?> — <?= $r->getPrecio() ?>€
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <button type="submit">Comparar</button>
        </form>

    <?php elseif ($nombre && count($registros) < 2): ?>
        <p><b>Solo hay un registro para este componente. Añade más registros para poder comparar.</b></p>
    <?php endif; ?>

    <br>

    <!-- PASO 3: resultado -->
    <?php if (isset($error)): ?>
        <p style="color: red;"><b><?= $error ?></b></p>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <?php
            $c1  = $resultado['c1'];
            $c2  = $resultado['c2'];
            $diff = $resultado['diff'];
            $pct  = $resultado['pct'];
            $subida = $diff >= 0;
        ?>
        <hr>
        <h2>Resultado de la comparación: <?= htmlspecialchars($c1->getNombre()) ?></h2>

        <table border="1" cellpadding="10">
            <tr>
                <th></th>
                <th>Registro A</th>
                <th>Registro B</th>
            </tr>
            <tr>
                <td><b>Fecha de registro</b></td>
                <td><?= $c1->getFechaRegistro() ?? '—' ?></td>
                <td><?= $c2->getFechaRegistro() ?? '—' ?></td>
            </tr>
            <tr>
                <td><b>Precio</b></td>
                <td><?= number_format($c1->getPrecio(), 2) ?>€</td>
                <td><?= number_format($c2->getPrecio(), 2) ?>€</td>
            </tr>
            <tr>
                <td><b>Diferencia</b></td>
                <td colspan="2" style="color: <?= $subida ? 'red' : 'green' ?>; font-weight: bold;">
                    <?= $subida ? '+' : '' ?><?= number_format($diff, 2) ?>€
                    (<?= $subida ? '+' : '' ?><?= number_format($pct, 2) ?>%)
                    <?= $subida ? '▲ Subida de precio' : '▼ Bajada de precio' ?>
                </td>
            </tr>
        </table>
    <?php endif; ?>

    <br>
    <a href="index.php">Volver al listado</a>

</body>
</html>
