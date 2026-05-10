<?php

class UsuarioController {
    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passwordPlana = $_POST['password'];
            $passwordHashed = password_hash($passwordPlana, PASSWORD_DEFAULT);
            $nuevoUsuario = new Usuario($email, $passwordHashed);
            $this->gestor->registrarUsuario($nuevoUsuario);
            header("Location: index.php?accion=login");
            exit;
        }
        include "views/alta.php";
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passwordPlana = $_POST['password'];
            $recordar = isset($_POST['recordarme']);

            $usuario = $this->gestor->buscarUsuarioPorEmail($email);

            if ($usuario && password_verify($passwordPlana, $usuario->getPassword())) {
                $_SESSION['usuario_id'] = $usuario->getId();
                $_SESSION['usuario_email'] = $usuario->getEmail();
                $_SESSION['color_fondo'] = $usuario->getColorFondo();
                    setcookie('color_fondo', $usuario->getColorFondo(), time() + (30 * 24 * 60 * 60), '/');
                    
                if ($recordar) {
                    $token = base64_encode($usuario->getEmail());
                    setcookie(
                        "usuario_login",
                        $token,
                        [
                            'expires' => time() + (86400 * 30),
                            'path' => '/',
                            'httponly' => true,
                            'samesite' => 'Strict'
                        ]
                    );
                }

                header("Location: index.php");
                exit;
            } else {
                $error = "Email o contrasena incorrectos";
            }
        }

        include "views/login.php";
    }

    public function logout() {
    $_SESSION = [];
    session_destroy();
    if (isset($_COOKIE['usuario_login'])) {
        setcookie('usuario_login', '', time() - 3600000, '/');
    }
    // Eliminar también el color de fondo
    setcookie('color_fondo', '', time() - 3600000, '/');
    header("Location: index.php?accion=login");
    exit;
    }
}