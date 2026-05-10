<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<?php $colorFondo = $_COOKIE['color_fondo'] ?? '#ffffff'; ?>
<body style="background-color: <?= $colorFondo ?>">
    <h1>Crear nueva cuenta</h1>

    <form method="POST">
        Email:<br>
        <input type="email" name="email" required><br><br>

        Contraseña:<br>
        <input type="password" name="password" required minlength="6"><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <br>
    <p>¿Ya tienes cuenta? <a href="index.php?accion=login">Inicia sesión aquí</a></p>
    <a href="index.php">Volver al inicio</a>
</body>
</html>