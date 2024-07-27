<?php
require_once 'Conexion.php';

class Asignacion extends Conexion
{
    public $asignacionpuesto_id;
    public $empleado_id;
    public $puesto_id;

    public function __construct($args = [])
    {
        $this->asignacionpuesto_id = $args['asignacionpuesto_id'] ?? null;
        $this->empleado_id = $args['empleado_id'] ?? null;
        $this->puesto_id = $args['puesto_id'] ?? null;
    }

    public function asignar()
    {
        $sql = "INSERT INTO asignacionespuestos (empleado_id, puesto_id) VALUES (:empleado_id, :puesto_id)";
        $params = [
            ':empleado_id' => $this->empleado_id,
            ':puesto_id' => $this->puesto_id
        ];
        return $this->ejecutar($sql, $params);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM asignacionespuestos WHERE asignacionpuesto_id = :asignacionpuesto_id";
        $params = [
            ':asignacionpuesto_id' => $this->asignacionpuesto_id
        ];
        return $this->ejecutar($sql, $params);
    }

    public function obtenerAsignaciones()
    {
        $sql = "SELECT a.*, e.empleado_nombre, p.puesto_nombre 
                FROM asignacionespuestos a
                JOIN empleado e ON a.empleado_id = e.empleado_id
                JOIN puestos p ON a.puesto_id = p.puesto_id
                WHERE a.asignacionpuesto_situacion = 1";
        return self::servir($sql);
    }
}
