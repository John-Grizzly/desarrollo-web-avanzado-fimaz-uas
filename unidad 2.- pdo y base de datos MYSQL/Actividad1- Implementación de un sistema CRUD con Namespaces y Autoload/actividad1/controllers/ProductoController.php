<?php
namespace controllers;

use config\Database;
use models\Producto;

class ProductoController {
    private $connection;

    public function __construct() {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function crear(Producto $producto) {
        $sql = "INSERT INTO productos (nombre, descripcion, existencia, precio)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            $producto->getNombre(),
            $producto->getDescripcion(),
            $producto->getExistencia(),
            $producto->getPrecio()
        ]);
    }

    public function listar() {
        return $this->connection->query("SELECT * FROM productos ORDER BY id DESC")->fetchAll();
    }

    public function obtenerPorId($id) {
        $stmt = $this->connection->prepare("SELECT * FROM productos WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function actualizar(Producto $producto) {
        $sql = "UPDATE productos SET nombre=?, descripcion=?, existencia=?, precio=? WHERE id=?";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([
            $producto->getNombre(),
            $producto->getDescripcion(),
            $producto->getExistencia(),
            $producto->getPrecio(),
            $producto->getId()
        ]);
    }

    public function eliminar($id) {
        $stmt = $this->connection->prepare("DELETE FROM productos WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>