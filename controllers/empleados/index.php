<?php
require '../../models/Empleado.php';
header('Content-Type: application/json; charset=UTF-8');

$metodo = $_SERVER['REQUEST_METHOD'];
$tipo = $_REQUEST['tipo'];

try {
    switch ($metodo) {
        case 'POST':
            $empleado = new Empleado($_POST);
            switch ($tipo) {
                case '1':

                    $ejecucion = $empleado->guardar();
                    $mensaje = "Guardado correctamente";
                    break;

                case '2':
                    $ejecucion = $empleado->modificar();
                    $mensaje = "Modificado correctamente";
                    break;

                case '3':
                    $ejecucion = $empleado->eliminar();
                    $mensaje = "Eliminado correctamente";
                    break;

                default:

                    break;
            }
            http_response_code(200);
            echo json_encode([
                "mensaje" => $mensaje,
                "codigo" => 1,
            ]);
            break;

        case 'GET':
            http_response_code(200);
            $empleado = new Empleado($_GET);
            $empleados = $empleado->buscar();
            echo json_encode($empleados);
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
}

exit;
