<?php
require_once 'Conexion.php';


class Empleado extends Conexion
{
    public $empleado_id;
    public $empleado_nombre;
    public $empleado_dpi;
    public $empleado_edad;
    public $empleado_sexo;
    public $empleado_situacion;


    public function __construct($args = [])
    {
        $this->empleado_id = $args['empleado_id'] ?? null;
        $this->empleado_nombre = $args['empleado_nombre'] ?? '';
        $this->empleado_dpi = $args['empleado_dpi'] ?? '';
        $this->empleado_edad = $args['empleado_edad'] ?? '';
        $this->empleado_sexo = $args['empleado_sexo'] ?? '';
        $this->empleado_situacion = $args['empleado_situacion'] ?? 1;
    }

    // METODO PARA INSERTAR
    public function guardar()
    {
        $sql = "INSERT into empleado (empleado_nombre, empleado_dpi, empleado_edad, empleado_sexo) values ('$this->empleado_nombre','$this->empleado_dpi','$this->empleado_edad','$this->empleado_sexo')";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    // METODO PARA CONSULTAR


    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM empleado where empleado_situacion = 1 ";

        if ($this->empleado_nombre != '') {
            $sql .= " AND empleado_nombre like '%$this->empleado_nombre%' ";
        }
        if ($this->empleado_dpi != '') {
            $sql .= " AND empleado_dpi like'%$this->empleado_dpi%' ";
        }
        if ($this->empleado_dpi != '') {
            $sql .= " AND empleado_edad like'%$this->empleado_edad%' ";
        }
        if ($this->empleado_dpi != '') {
            $sql .= " AND empleado_sexo like'%$this->empleado_sexo%' ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscarPorId($id){
     
        $sql = "SELECT * FROM empleado where empleado_situacion = 1 and empleado_id = $id ";
        $resultado = array_shift( self::servir($sql));
        // $resultado = self::servir($sql)[0];
        return $resultado;
    }

    // METODO PARA MODIFICAR
    public function modificar()
    {
        $sql = "UPDATE empleado SET empleado_nombre = '$this->empleado_nombre', empleado_dpi = '$this->empleado_dpi', empleado_edad = '$this->empleado_edad', empleado_sexo = '$this->empleado_sexo' WHERE empleado_id = $this->empleado_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function eliminar(){
        // $sql = "DELETE FROM productos WHERE prod_id = $this->prod_id ";

        // echo $sql;
        $sql = "UPDATE empleado SET empleado_situacion = 0 WHERE empleado_id = $this->empleado_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
}