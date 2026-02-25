<?php

class Usuario {
    protected string $nombre;
    protected string $correo;

    public function __construct(string $nombre, string $correo) {
        $this->nombre = $nombre;
        $this->setCorreo($correo);
    }

    public function setCorreo(string $correo): void {
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El correo electrónico no tiene un formato válido.");
        }
        $this->correo = $correo;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getCorreo(): string {
        return $this->correo;
    }

    public function getRol(): string {
        return "Usuario";
    }
}
