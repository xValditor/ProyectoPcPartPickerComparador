<?php
require_once "autoload.php";
session_start();

$gestor = new GestorPDO();
$controller = new ComponenteController($gestor);
$usuarioController = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';

if (!isset($_SESSION['usuario_id']) && isset($_COOKIE['usuario_login'])) {
    $emailRecuperado = base64_decode($_COOKIE['usuario_login']);
    $usuario = $gestor->buscarUsuarioPorEmail($emailRecuperado);
    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario->getId();
        $_SESSION['usuario_email'] = $usuario->getEmail();
    } else {
        setcookie('usuario_login', '', time() - 3600000, '/');
    }
}

switch ($accion) {
    case 'login':
        $usuarioController->login();
        break;
    case 'alta':
        $usuarioController->alta();
        break;
    case 'logout':
        $usuarioController->logout();
        break;
    case 'cambiarColor':
    $color = $_POST['color'];
    setcookie('color_fondo', $color, time() + (30 * 24 * 60 * 60), '/');
    if (isset($_SESSION['usuario_id'])) {
        $gestor->actualizarColorUsuario($_SESSION['usuario_id'], $color);
    }
    header("Location: index.php");
    exit;
    case 'crear':
    case 'editar':
    case 'eliminar':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?accion=login");
            exit;
        }
        if ($accion == 'crear') {
            $controller->crear();
        } elseif ($accion == 'editar') {
            $controller->editar();
        } else {
            $controller->eliminar();
        }
        break;
    default:
        $controller->index();
}