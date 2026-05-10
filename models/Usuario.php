<?php

class Usuario {
    private $id;
    private $email;
    private $password;
    private $colorFondo;

    public function __construct($email, $password, $id = 0, $colorFondo = '#ffffff') {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->colorFondo = $colorFondo;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email): self {
        $this->email = $email;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password): self {
        $this->password = $password;
        return $this;
    }

    public function getColorFondo() {
        return $this->colorFondo;
    }

    public function setColorFondo($colorFondo): self {
        $this->colorFondo = $colorFondo;
        return $this;
    }
}