<?php
$mensaje = "";

try {
    $conexion = new PDO("mysql:host=localhost;dbname=escuela", "root", "");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_POST) {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $error = isset($_POST['error']);

        // Iniciar transacción
        $conexion->beginTransaction();

        // Insertar alumno
        $sql1 = "INSERT INTO alumnos(nombre, correo) VALUES (?, ?)";
        $stmt1 = $conexion->prepare($sql1);
        $stmt1->execute([$nombre, $correo]);

        // Simular error
        if ($error) {
            throw new Exception("Error simulado");
        }

        // Insertar log
        $sql2 = "INSERT INTO logs(mensaje) VALUES (?)";
        $stmt2 = $conexion->prepare($sql2);
        $stmt2->execute(["Se registró un alumno"]);

        // Confirmar cambios
        $conexion->commit();
        $mensaje = "✅ COMMIT: Todo se guardó correctamente";

    }

} catch (Exception $e) {
    if ($conexion->inTransaction()) {
        $conexion->rollBack();
    }
    $mensaje = "❌ ROLLBACK: Error -> " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transacciones</title>
</head>
<body>

<h2>Registro de Alumno</h2>

<form method="POST">
    Nombre: <input type="text" name="nombre" required><br><br>
    Correo: <input type="email" name="correo" required><br><br>

    Simular error: <input type="checkbox" name="error"><br><br>

    <button type="submit">Registrar</button>
</form>

<p><?php echo $mensaje; ?></p>

</body>
</html>