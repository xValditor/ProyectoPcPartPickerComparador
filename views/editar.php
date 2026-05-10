<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Componente</title>
</head>
<?php $colorFondo = $_COOKIE['color_fondo'] ?? '#ffffff'; ?>
<body style="background-color: <?= $colorFondo ?>">
    <h1>Editar Componente</h1>

    <form method="POST">

        Nombre:<br>
        <input type="text" name="nombre" value="<?= $componente->getNombre() ?>" required><br><br>

        Fabricante:<br>
        <input type="text" name="fabricante" value="<?= $componente->getFabricante() ?>" required><br><br>

        Precio (€):<br>
        <input type="number" step="0.01" name="precio" value="<?= $componente->getPrecio() ?>" required><br><br>

        Consumo (W):<br>
        <input type="number" name="consumo" value="<?= $componente->getConsumo() ?>" required><br><br>

        Año de lanzamiento:<br>
        <input type="number" name="anioLanzamiento" value="<?= $componente->getAnioLanzamiento() ?>" required><br><br>

        Fecha de registro:<br>
        <input type="date" name="fechaRegistro" value="<?= $componente->getFechaRegistro() ?>"><br><br>

        <?php if ($componente instanceof Procesador): ?>
            Núcleos:<br>
            <input type="number" name="nucleos" value="<?= $componente->getNucleos() ?>" required><br><br>

            Frecuencia (GHz):<br>
            <input type="number" step="0.01" name="frecuencia" value="<?= $componente->getFrecuencia() ?>" required><br><br>

            Socket:<br>
            <input type="text" name="socket" value="<?= $componente->getSocket() ?>" required><br><br>

        <?php elseif ($componente instanceof TarjetaGrafica): ?>
            Memoria VRAM (GB):<br>
            <input type="number" name="memoriaVRAM" value="<?= $componente->getMemoriaVRAM() ?>" required><br><br>

            Velocidad Memoria (MHz):<br>
            <input type="number" name="velocidadMemoria" value="<?= $componente->getVelocidadMemoria() ?>" required><br><br>

            Ensamblador:<br>
            <input type="text" name="ensamblador" value="<?= $componente->getEnsamblador() ?>" required><br><br>

        <?php else: ?>
            Capacidad (GB):<br>
            <input type="number" name="capacidad" value="<?= $componente->getCapacidad() ?>" required><br><br>

            Frecuencia (MHz):<br>
            <input type="number" name="frecuenciaRam" value="<?= $componente->getFrecuencia() ?>" required><br><br>

            Tipo (DDR4/DDR5):<br>
            <input type="text" name="tipoRam" value="<?= $componente->getTipo() ?>" required><br><br>

            Latencia (CL):<br>
            <input type="number" name="latencia" value="<?= $componente->getLatencia() ?>" required><br><br>

        <?php endif; ?>

        <button type="submit">Guardar cambios</button>
    </form>

    <br>
    <a href="index.php">Volver al listado</a>
</body>
</html>
