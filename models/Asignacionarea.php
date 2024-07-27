<?php
require_once 'Conexion.php';

class Asigarea extends Conexion
{
    public $asignacionarea_id;
    public $empleado_id;
    public $area_id;

    public function __construct($args = [])
    {
        $this->asignacionarea_id = $args['asignacionarea_id'] ?? null;
        $this->empleado_id = $args['empleado_id'] ?? null;
        $this->area_id = $args['area_id'] ?? null;
    }

    public function asignar()
    {
        $sql = "INSERT INTO asignacionarea (empleado_id, area_id) VALUES (:empleado_id, :area_id)";
        $params = [
            ':empleado_id' => $this->empleado_id,
            ':area_id' => $this->area_id
        ];
        return $this->ejecutar($sql, $params);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM asignacionarea WHERE asignacionarea_id = :asignacionarea_id";
        $params = [
            ':asignacionarea_id' => $this->asignacionarea_id
        ];
        return $this->ejecutar($sql, $params);
    }

    public function obtenerAsigarea()
    {
        $sql = "SELECT a.*, e.empleado_nombre, p.area_nombre 
                FROM asignacionarea a
                JOIN empleado e ON a.empleado_id = e.empleado_id
                JOIN areas p ON a.area_id = p.area_id
                WHERE a.asignacionarea_situacion = 1";
        return self::servir($sql);
    }
}
