<?php
require '../../models/Asignacion.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_POST['tipo'] ?? null;

try {
    switch ($metodo) {
        case 'POST':
            $asignacion = new Asignacion($_POST);
            switch ($tipo) {
                case '1': // Asignar
                    $ejecucion = $asignacion->asignar();
                    $mensaje = "Asignación realizada correctamente";
                    break;

                case '2': // Modificar
                    $asignacion->asignacionpuesto_id = $_POST['asignacionpuesto_id'];
                    $ejecucion = $asignacion->modificar();
                    $mensaje = "Asignación modificada correctamente";
                    break;

                case '3': // Eliminar
                    $asignacion->asignacionpuesto_id = $_POST['asignacionpuesto_id'];
                    $ejecucion = $asignacion->eliminar();
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
            $asignacion = new Asignacion();
            $asignaciones = $asignacion->obtenerAsignaciones();
            http_response_code(200);
            echo json_encode($asignaciones);
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
    error_log($e->getMessage()); // Guarda el error en el log del servidor
}

exit;
