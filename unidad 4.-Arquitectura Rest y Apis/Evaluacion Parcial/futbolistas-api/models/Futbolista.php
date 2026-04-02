<?php
// Nombre del alumno: Jonathan García

class Futbolista {
    private PDO $conn;
    private string $table_name = 'futbolistas';

    public ?int $id = null;
    public string $nombre = '';
    public string $posicion = '';
    public int $numero = 0;
    public int $edad = 0;
    public string $equipo = '';

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function readAll(): array {
        $query = "SELECT id, nombre, posicion, numero, edad, equipo, created_at, updated_at
                  FROM {$this->table_name}
                  ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function readOne(int $id): array|false {
        $query = "SELECT id, nombre, posicion, numero, edad, equipo, created_at, updated_at
                  FROM {$this->table_name}
                  WHERE id = :id
                  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create(): bool {
        $query = "INSERT INTO {$this->table_name}
                  (nombre, posicion, numero, edad, equipo)
                  VALUES (:nombre, :posicion, :numero, :edad, :equipo)";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':nombre' => htmlspecialchars(strip_tags($this->nombre)),
            ':posicion' => htmlspecialchars(strip_tags($this->posicion)),
            ':numero' => $this->numero,
            ':edad' => $this->edad,
            ':equipo' => htmlspecialchars(strip_tags($this->equipo)),
        ]);
    }

    public function update(int $id): bool {
        $query = "UPDATE {$this->table_name}
                  SET nombre = :nombre,
                      posicion = :posicion,
                      numero = :numero,
                      edad = :edad,
                      equipo = :equipo
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':nombre' => htmlspecialchars(strip_tags($this->nombre)),
            ':posicion' => htmlspecialchars(strip_tags($this->posicion)),
            ':numero' => $this->numero,
            ':edad' => $this->edad,
            ':equipo' => htmlspecialchars(strip_tags($this->equipo)),
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool {
        $query = "DELETE FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
