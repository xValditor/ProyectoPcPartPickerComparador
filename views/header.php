<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PriceTracker</title>
    <link rel="stylesheet" href="/ProyectoPcPartPickerComparador/css/estilos.css">
</head>
<?php $colorFondo = $_COOKIE['color_fondo'] ?? '#f5f5f5'; ?>
<body style="background-color: <?= $colorFondo ?>">

<header>
    <h1>PriceTracker</h1>

    <nav>
        <a href="/ProyectoPcPartPickerComparador/index.php">Inicio</a>
        <a href="/ProyectoPcPartPickerComparador/index.php?accion=comparar">Comparar precios</a>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="/ProyectoPcPartPickerComparador/index.php?accion=crear">Añadir componente</a>
            <span><?= $_SESSION['usuario_email'] ?></span>
            <a href="/ProyectoPcPartPickerComparador/index.php?accion=logout">Cerrar sesión</a>
        <?php else: ?>
            <a href="/ProyectoPcPartPickerComparador/index.php?accion=login">Iniciar sesión</a>
            <a href="/ProyectoPcPartPickerComparador/index.php?accion=alta">Registrarse</a>
        <?php endif; ?>
    </nav>

    <!-- selector de color de fondo -->
    <form method="POST" action="/ProyectoPcPartPickerComparador/index.php?accion=cambiarColor" class="selector-color">
        <label for="color">Fondo:</label>
        <select name="color" id="color" onchange="this.form.submit()">
            <option value="#f5f5f5" <?= ($colorFondo === '#f5f5f5') ? 'selected' : '' ?>>Claro</option>
            <option value="#e8ede8" <?= ($colorFondo === '#e8ede8') ? 'selected' : '' ?>>Neutro</option>
            <option value="#d0d8d0" <?= ($colorFondo === '#d0d8d0') ? 'selected' : '' ?>>Oscuro</option>
            <option value="#b8c4b8" <?= ($colorFondo === '#b8c4b8') ? 'selected' : '' ?>>Muy oscuro</option>
        </select>
    </form>
</header>
