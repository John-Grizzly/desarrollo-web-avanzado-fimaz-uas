<?php

class Usuario {
    // Atributos privados
    private $nombre;
    private $correo;

    // Constructor
    public function __construct($nombre, $correo) {
        $this->nombre = $nombre;
        $this->correo = $correo;
    }

    // GET nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Set Nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // GET de correo
    public function getCorreo() {
        return $this->correo;
    }

    // SET de correo
    public function setCorreo($correo) {
        $this->correo = $correo;
    }
}

?>
