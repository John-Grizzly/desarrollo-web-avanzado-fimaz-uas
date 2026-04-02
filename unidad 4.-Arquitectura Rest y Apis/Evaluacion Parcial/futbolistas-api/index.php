<?php
// Nombre del alumno: Jonathan García

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/FutbolistaController.php';

$database = new Database();
$db = $database->getConnection();
$controller = new FutbolistaController($db);

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$path = preg_replace('#^' . preg_quote($basePath, '#') . '#', '', $requestUri);
$path = trim($path, '/');
$segments = $path === '' ? [] : explode('/', $path);
$method = $_SERVER['REQUEST_METHOD'];

if (count($segments) === 0) {
    echo json_encode([
        'status' => true,
        'message' => 'API REST de futbolistas funcionando correctamente.',
        'endpoints' => [
            'GET /futbolistas',
            'GET /futbolistas/{id}',
            'POST /futbolistas',
            'PUT /futbolistas/{id}',
            'DELETE /futbolistas/{id}'
        ]
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

if ($segments[0] !== 'futbolistas') {
    http_response_code(404);
    echo json_encode([
        'status' => false,
        'message' => 'Ruta no encontrada.'
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

$id = $segments[1] ?? null;

try {
    switch ($method) {
        case 'GET':
            if ($id === null) {
                $controller->index();
            }
            if (!ctype_digit($id)) {
                throw new Exception('El ID debe ser numérico.', 400);
            }
            $controller->show((int)$id);
            break;

        case 'POST':
            if ($id !== null) {
                throw new Exception('Ruta no válida para POST.', 400);
            }
            $controller->store();
            break;

        case 'PUT':
            if ($id === null || !ctype_digit($id)) {
                throw new Exception('Debes proporcionar un ID válido.', 400);
            }
            $controller->update((int)$id);
            break;

        case 'DELETE':
            if ($id === null || !ctype_digit($id)) {
                throw new Exception('Debes proporcionar un ID válido.', 400);
            }
            $controller->destroy((int)$id);
            break;

        default:
            throw new Exception('Método no permitido.', 405);
    }
} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'status' => false,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
