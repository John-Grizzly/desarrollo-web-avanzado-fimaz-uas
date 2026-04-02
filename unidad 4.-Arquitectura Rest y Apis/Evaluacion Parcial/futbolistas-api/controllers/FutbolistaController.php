<?php
// Nombre del alumno: Jonathan García

require_once __DIR__ . '/../models/Futbolista.php';

class FutbolistaController {
    private Futbolista $futbolista;

    public function __construct(PDO $db) {
        $this->futbolista = new Futbolista($db);
    }

    private function sendResponse(int $code, array $data): void {
        http_response_code($code);
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    private function getJsonInput(): array {
        $input = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->sendResponse(400, [
                'status' => false,
                'message' => 'JSON inválido.'
            ]);
        }
        return $input ?? [];
    }

    private function validate(array $data): array {
        $errors = [];

        if (empty(trim($data['nombre'] ?? ''))) {
            $errors[] = 'El nombre es obligatorio.';
        }
        if (empty(trim($data['posicion'] ?? ''))) {
            $errors[] = 'La posición es obligatoria.';
        }
        if (!isset($data['numero']) || !filter_var($data['numero'], FILTER_VALIDATE_INT)) {
            $errors[] = 'El número debe ser entero.';
        } elseif ((int)$data['numero'] <= 0 || (int)$data['numero'] > 99) {
            $errors[] = 'El número debe estar entre 1 y 99.';
        }
        if (!isset($data['edad']) || !filter_var($data['edad'], FILTER_VALIDATE_INT)) {
            $errors[] = 'La edad debe ser entera.';
        } elseif ((int)$data['edad'] < 0 || (int)$data['edad'] > 60) {
            $errors[] = 'La edad debe estar entre 0 y 60.';
        }
        if (empty(trim($data['equipo'] ?? ''))) {
            $errors[] = 'El equipo es obligatorio.';
        }

        return $errors;
    }

    public function index(): void {
        $items = $this->futbolista->readAll();
        $this->sendResponse(200, [
            'status' => true,
            'message' => 'Lista de futbolistas obtenida correctamente.',
            'data' => $items
        ]);
    }

    public function show(int $id): void {
        $item = $this->futbolista->readOne($id);
        if (!$item) {
            $this->sendResponse(404, [
                'status' => false,
                'message' => 'Futbolista no encontrado.'
            ]);
        }

        $this->sendResponse(200, [
            'status' => true,
            'data' => $item
        ]);
    }

    public function store(): void {
        $data = $this->getJsonInput();
        $errors = $this->validate($data);

        if (!empty($errors)) {
            $this->sendResponse(422, [
                'status' => false,
                'message' => 'Errores de validación.',
                'errors' => $errors
            ]);
        }

        $this->futbolista->nombre = $data['nombre'];
        $this->futbolista->posicion = $data['posicion'];
        $this->futbolista->numero = (int)$data['numero'];
        $this->futbolista->edad = (int)$data['edad'];
        $this->futbolista->equipo = $data['equipo'];

        if ($this->futbolista->create()) {
            $this->sendResponse(201, [
                'status' => true,
                'message' => 'Futbolista creado correctamente.'
            ]);
        }

        $this->sendResponse(500, [
            'status' => false,
            'message' => 'No se pudo crear el futbolista.'
        ]);
    }

    public function update(int $id): void {
        if (!$this->futbolista->readOne($id)) {
            $this->sendResponse(404, [
                'status' => false,
                'message' => 'Futbolista no encontrado.'
            ]);
        }

        $data = $this->getJsonInput();
        $errors = $this->validate($data);

        if (!empty($errors)) {
            $this->sendResponse(422, [
                'status' => false,
                'message' => 'Errores de validación.',
                'errors' => $errors
            ]);
        }

        $this->futbolista->nombre = $data['nombre'];
        $this->futbolista->posicion = $data['posicion'];
        $this->futbolista->numero = (int)$data['numero'];
        $this->futbolista->edad = (int)$data['edad'];
        $this->futbolista->equipo = $data['equipo'];

        if ($this->futbolista->update($id)) {
            $this->sendResponse(200, [
                'status' => true,
                'message' => 'Futbolista actualizado correctamente.'
            ]);
        }

        $this->sendResponse(500, [
            'status' => false,
            'message' => 'No se pudo actualizar el futbolista.'
        ]);
    }

    public function destroy(int $id): void {
        if (!$this->futbolista->readOne($id)) {
            $this->sendResponse(404, [
                'status' => false,
                'message' => 'Futbolista no encontrado.'
            ]);
        }

        if ($this->futbolista->delete($id)) {
            $this->sendResponse(200, [
                'status' => true,
                'message' => 'Futbolista eliminado correctamente.'
            ]);
        }

        $this->sendResponse(500, [
            'status' => false,
            'message' => 'No se pudo eliminar el futbolista.'
        ]);
    }
}
