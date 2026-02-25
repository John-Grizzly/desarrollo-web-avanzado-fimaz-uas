# Práctica 2 – Herencia y Reutilización de Código en PHP

## Explicación de la herencia aplicada

La herencia se utilizo mediante la palabra clave `extends`.  
La clase `Admin` extiende de la clase `Usuario`, heredando sus atributos y métodos.

## Diferencias entre Usuario y Admin

- Usuario:
  - Tiene nombre y correo.
  - Su método getRol() retorna "Usuario".

- Admin:
  - Hereda nombre y correo.
  - Sobrescribe el método getRol() para retornar "Administrador".

## Evidencia de ejecución

Al ejecutar index.php se muestra:

Datos del Administrador  
Nombre: Jonathan Garcia  
Correo: admin@hotmail.com  
Rol: Administrador
