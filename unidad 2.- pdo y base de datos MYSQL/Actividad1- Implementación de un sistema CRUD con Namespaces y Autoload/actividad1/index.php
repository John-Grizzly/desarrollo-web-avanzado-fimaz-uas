<?php
require_once 'autoload.php';

use controllers\ProductoController;
use models\Producto;

$controller = new ProductoController();
$productoEditar = null;

if (isset($_GET['eliminar'])) {
    $controller->eliminar($_GET['eliminar']);
}

if (isset($_GET['editar'])) {
    $productoEditar = $controller->obtenerPorId($_GET['editar']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = new Producto();

    $producto->setNombre($_POST['nombre']);
    $producto->setDescripcion($_POST['descripcion']);
    $producto->setExistencia($_POST['existencia']);
    $producto->setPrecio($_POST['precio']);

    if (!empty($_POST['id'])) {
        $producto->setId($_POST['id']);
        $controller->actualizar($producto);
    } else {
        $controller->crear($producto);
    }
}

$productos = $controller->listar();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>CRUD de Productos</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $productoEditar['id'] ?? ''; ?>">

    <input class="form-control mb-2" type="text" name="nombre" placeholder="Nombre"
        value="<?php echo $productoEditar['nombre'] ?? ''; ?>" required>

    <input class="form-control mb-2" type="text" name="descripcion" placeholder="Descripción"
        value="<?php echo $productoEditar['descripcion'] ?? ''; ?>" required>

    <input class="form-control mb-2" type="number" name="existencia" placeholder="Existencia"
        value="<?php echo $productoEditar['existencia'] ?? ''; ?>" required>

    <input class="form-control mb-2" type="number" step="0.01" name="precio" placeholder="Precio"
        value="<?php echo $productoEditar['precio'] ?? ''; ?>" required>

    <button class="btn btn-success">
        <?php echo $productoEditar ? 'Actualizar' : 'Guardar'; ?>
    </button>
</form>

<hr>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Existencia</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($productos as $p): ?>
    <tr>
        <td><?php echo $p['id']; ?></td>
        <td><?php echo $p['nombre']; ?></td>
        <td><?php echo $p['descripcion']; ?></td>
        <td><?php echo $p['existencia']; ?></td>
        <td><?php echo $p['precio']; ?></td>
        <td>
            <a class="btn btn-warning btn-sm" href="?editar=<?php echo $p['id']; ?>">Editar</a>
            <a class="btn btn-danger btn-sm"
               onclick="return confirm('¿Eliminar este producto?')"
               href="?eliminar=<?php echo $p['id']; ?>">
               Eliminar
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>