# Práctica 3 - Sistema de Usuarios con Validaciones y Excepciones

## Descripción del sistema
Este sistema simula la gestión de usuarios utilizando Programación Orientada a Objetos en PHP.

Se implementa una clase base `Usuario` y dos clases derivadas:
- Admin
- Alumno

El sistema valida el formato del correo electrónico y lanza excepciones cuando los datos son incorrectos.

## Flujo de clases

1. Usuario es la clase base.
2. Admin y Alumno heredan de Usuario.
3. Alumno agrega el atributo matricula.
4. En index.php se prueban instancias válidas e inválidas.
5. Se utiliza manejo de excepciones con try/catch.

## Evidencia del manejo de errores

Cuando se intenta crear un usuario con correo inválido, el sistema lanza una excepción y muestra un mensaje controlado en pantalla.

Ejemplo:
Error: El correo electrónico no tiene un formato válido.
## Video demostrativo
](https://youtu.be/JI3R1KaVVXI)
