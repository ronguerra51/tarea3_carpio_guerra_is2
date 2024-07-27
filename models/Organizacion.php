<?php
require_once 'Conexion.php';

class Organizacion extends Conexion
{
    public function MostrarPorOrganizacion()
    {
        $sql = "SELECT emp.empleado_nombre, emp.empleado_dpi, area.area_nombre, pue.puesto_nombre, emp.empleado_edad,
                emp.empleado_sexo, pue.puesto_sueldo
                FROM asignacionarea asignacionarea_id
                INNER JOIN areas area ON asignacionarea_id.area_id = area.area_id 
                INNER JOIN empleado emp ON emp.empleado_id = asignacionarea_id.empleado_id
                INNER JOIN asignacionespuestos asignacionpuesto_id ON emp.empleado_id = asignacionpuesto_id.empleado_id
                INNER JOIN puestos pue ON asignacionpuesto_id.puesto_id = pue.puesto_id
                WHERE emp.empleado_situacion = 1";

        return self::servir($sql);
    }
}
?>
