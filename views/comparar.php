<?php include 'header.php'; ?>

<main>
    <h2>Comparador de precios</h2>
    <p>Selecciona un componente y elige dos registros para comparar su evolución de precio.</p>
    <br>

    <!-- paso 1: elegir nombre -->
    <form method="GET" action="/ProyectoPcPartPickerComparador/index.php">
        <input type="hidden" name="accion" value="comparar">
        <label>Componente:</label>
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

    <!-- paso 2: elegir dos registros -->
    <?php if ($nombre && count($registros) >= 2): ?>
        <form method="GET" action="/ProyectoPcPartPickerComparador/index.php">
            <input type="hidden" name="accion" value="comparar">
            <input type="hidden" name="nombre" value="<?= htmlspecialchars($nombre) ?>">

            <label>Registro A:</label>
            <select name="id1" required>
                <option value="">-- Selecciona --</option>
                <?php foreach ($registros as $r): ?>
                    <option value="<?= $r->getId() ?>" <?= ((string)$id1 === (string)$r->getId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($r->getFechaRegistro() ?? 'Sin fecha') ?> — <?= $r->getPrecio() ?>€
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Registro B:</label>
            <select name="id2" required>
                <option value="">-- Selecciona --</option>
                <?php foreach ($registros as $r): ?>
                    <option value="<?= $r->getId() ?>" <?= ((string)$id2 === (string)$r->getId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($r->getFechaRegistro() ?? 'Sin fecha') ?> — <?= $r->getPrecio() ?>€
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Comparar</button>
        </form>

    <?php elseif ($nombre && count($registros) < 2): ?>
        <p class="error">Solo hay un registro para este componente. Añade más para poder comparar.</p>
    <?php endif; ?>

    <br>

    <!-- paso 3: resultado -->
    <?php if (isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <?php
            $c1   = $resultado['c1'];
            $c2   = $resultado['c2'];
            $diff = $resultado['diff'];
            $pct  = $resultado['pct'];
            $subida = $diff >= 0;
        ?>
        <div class="resultado-comparacion">
            <h2><?= htmlspecialchars($c1->getNombre()) ?></h2>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Registro A</th>
                        <th>Registro B</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Fecha de registro</strong></td>
                        <td><?= $c1->getFechaRegistro() ?? '—' ?></td>
                        <td><?= $c2->getFechaRegistro() ?? '—' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Precio</strong></td>
                        <td><?= number_format($c1->getPrecio(), 2) ?>€</td>
                        <td><?= number_format($c2->getPrecio(), 2) ?>€</td>
                    </tr>
                    <tr>
                        <td><strong>Diferencia</strong></td>
                        <td colspan="2" class="<?= $subida ? 'subida' : 'bajada' ?>">
                            <?= $subida ? '+' : '' ?><?= number_format($diff, 2) ?>€
                            (<?= $subida ? '+' : '' ?><?= number_format($pct, 2) ?>%)
                            <?= $subida ? '▲ Subida de precio' : '▼ Bajada de precio' ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <br>
    <a href="/ProyectoPcPartPickerComparador/index.php">← Volver al listado</a>
</main>

<?php include 'footer.php'; ?>
