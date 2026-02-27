<?php

require_once "clases/Admin.php";
require_once "clases/Alumno.php";
require_once "clases/Invitado.php";

$usuarios = [];
$error = "";

try {

    $admin = new Admin("Carlos López", "admin@uas.edu.mx");
    $usuarios[] = $admin;

    $alumno = new Alumno("Ana Torres", "ana@uas.edu.mx", "20230045");
    $usuarios[] = $alumno;

    $invitado = new Invitado("Pedro Gómez", "pedro@gmail.com", "Microsoft");
    $usuarios[] = $invitado;

    $usuarioInvalido = new Admin("Error Usuario", "correo-mal-escrito");

} catch (Exception $e) {
    $error = "Error controlado: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Práctica 4 - POO</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .error { color: red; text-align: center; font-weight: bold; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Lista de Usuarios</h2>

<?php if ($error): ?>
    <p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<table>
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Rol</th>
        <th>Matrícula</th>
        <th>Empresa</th>
    </tr>

    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario->getNombre(); ?></td>
            <td><?php echo $usuario->getCorreo(); ?></td>
            <td><?php echo $usuario->getRol(); ?></td>
            <td>
                <?php echo method_exists($usuario, 'getMatricula') ? $usuario->getMatricula() : "—"; ?>
            </td>
            <td>
                <?php echo method_exists($usuario, 'getEmpresa') ? $usuario->getEmpresa() : "—"; ?>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
