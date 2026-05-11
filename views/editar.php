<?php include 'header.php'; ?>

<main>
    <h2>Editar Componente</h2>

    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $componente->getNombre() ?>" required>

        <label>Fabricante:</label>
        <input type="text" name="fabricante" value="<?= $componente->getFabricante() ?>" required>

        <label>Precio (€):</label>
        <input type="number" step="0.01" name="precio" value="<?= $componente->getPrecio() ?>" required>

        <label>Consumo (W):</label>
        <input type="number" name="consumo" value="<?= $componente->getConsumo() ?>" required>

        <label>Año de lanzamiento:</label>
        <input type="number" name="anioLanzamiento" value="<?= $componente->getAnioLanzamiento() ?>" required>

        <label>Fecha de registro:</label>
        <input type="date" name="fechaRegistro" value="<?= $componente->getFechaRegistro() ?>">

        <?php if ($componente instanceof Procesador): ?>
            <label>Núcleos:</label>
            <input type="number" name="nucleos" value="<?= $componente->getNucleos() ?>" required>

            <label>Frecuencia (GHz):</label>
            <input type="number" step="0.01" name="frecuencia" value="<?= $componente->getFrecuencia() ?>" required>

            <label>Socket:</label>
            <input type="text" name="socket" value="<?= $componente->getSocket() ?>" required>

        <?php elseif ($componente instanceof TarjetaGrafica): ?>
            <label>Memoria VRAM (GB):</label>
            <input type="number" name="memoriaVRAM" value="<?= $componente->getMemoriaVRAM() ?>" required>

            <label>Velocidad Memoria (MHz):</label>
            <input type="number" name="velocidadMemoria" value="<?= $componente->getVelocidadMemoria() ?>" required>

            <label>Ensamblador:</label>
            <input type="text" name="ensamblador" value="<?= $componente->getEnsamblador() ?>" required>

        <?php else: ?>
            <label>Capacidad (GB):</label>
            <input type="number" name="capacidad" value="<?= $componente->getCapacidad() ?>" required>

            <label>Frecuencia (MHz):</label>
            <input type="number" name="frecuenciaRam" value="<?= $componente->getFrecuencia() ?>" required>

            <label>Tipo (DDR4/DDR5):</label>
            <input type="text" name="tipoRam" value="<?= $componente->getTipo() ?>" required>

            <label>Latencia (CL):</label>
            <input type="number" name="latencia" value="<?= $componente->getLatencia() ?>" required>
        <?php endif; ?>

        <button type="submit">Guardar cambios</button>
    </form>

    <br>
    <a href="/ProyectoPcPartPickerComparador/index.php">← Volver al listado</a>
</main>

<?php include 'footer.php'; ?>
