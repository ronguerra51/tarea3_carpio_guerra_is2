<?php
require '../../models/Asignacionarea.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_POST['tipo'] ?? null;

try {
    switch ($metodo) {
        case 'POST':
            $asigarea = new AsigArea($_POST);
            switch ($tipo) {
                case '1': // Asignar
                    $ejecucion = $asigarea->asignar();
                    $mensaje = "Asignación realizada correctamente";
                    break;

                case '3': // Eliminar
                    $asigarea->asignacionarea_id = $_POST['asignacionarea_id'];
                    $ejecucion = $asiarea->eliminar();
                    $mensaje = "Asignación eliminada correctamente";
                    break;

                default:
                    throw new Exception('Tipo de operación no soportado');
            }
            http_response_code(200);
            echo json_encode([
                "mensaje" => $mensaje,
                "codigo" => 1,
            ]);
            break;

        case 'GET':
            $asigarea = new Asigarea();
            $asigareas= $asigarea->obtenerAsigarea();
            http_response_code(200);
            echo json_encode($asigareas);
            break;

        default:
            http_response_code(405);
            echo json_encode([
                "mensaje" => "Método no permitido",
                "codigo" => 9,
            ]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "detalle" => $e->getMessage(),
        "mensaje" => "Error de ejecución",
        "codigo" => 0,
    ]);
    error_log($e->getMessage());
}

exit;
