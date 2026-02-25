<?php

require_once "clases/Admin.php";
require_once "clases/Alumno.php";

  echo "<h2>Pruebas del sistema</h2>";

   try {
    $admin = new Admin("Carlos Pérez", "carlos@empresa.com");
    echo "Usuario creado: " . $admin->getNombre() . " - Rol: " . $admin->getRol() . "<br>";

    $alumno = new Alumno("Ana López", "ana@correo.com", "20231234");
    echo "Usuario creado: " . $alumno->getNombre() . " - Rol: " . $alumno->getRol() . "<br>";

    // Usuario con correo inválido
    $usuarioInvalido = new Admin("Pedro", "correo-invalido");
    echo "Este mensaje no debería mostrarse.";

} catch (Exception $e) {
    echo "<strong>Error:</strong> " . $e->getMessage();
}
