<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<?php $colorFondo = $_COOKIE['color_fondo'] ?? '#ffffff'; ?>
<body style="background-color: <?= $colorFondo ?>">
    <h1>Iniciar Sesión</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><b><?= $error ?></b></p>
    <?php endif; ?>

    <form method="POST">
        Email:<br>
        <input type="email" name="email" required><br><br>

        Contraseña:<br>
        <input type="password" name="password" required minlength="6"><br><br>

        <input type="checkbox" name="recordarme"> Recordarme en este equipo<br><br>

        <button type="submit">Entrar</button>
    </form>

    <br>
    <p>¿No tienes cuenta? <a href="index.php?accion=alta">Regístrate aquí</a></p>
    <a href="index.php">Volver al inicio</a>
</body>
</html>