<?php
// Nombre del alumno: Jonathan García

class Database {
    private string $host = 'localhost';
    private string $db_name = 'futbolistas';
    private string $username = 'root';
    private string $password = '';
    public ?PDO $conn = null;

    public function getConnection(): ?PDO {
        $this->conn = null;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode([
                'status' => false,
                'message' => 'Error de conexión a la base de datos.',
                'error' => $exception->getMessage()
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        return $this->conn;
    }
}
