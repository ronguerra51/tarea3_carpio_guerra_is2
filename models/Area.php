<?php
require_once 'Conexion.php';


class Area extends Conexion
{
    public $area_id;
    public $area_nombre;
    public $area_situacion;


    public function __construct($args = [])
    {
        $this->area_id = $args['area_id'] ?? null;
        $this->area_nombre = $args['area_nombre'] ?? '';
        $this->area_situacion = $args['area_situacion'] ?? 1;
    }

    // METODO PARA INSERTAR
    public function guardar()
    {
        $sql = "INSERT into areas (area_nombre) values ('$this->area_nombre')";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    // METODO PARA CONSULTAR


    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM areas where area_situacion = 1 ";

        if ($this->area_nombre != '') {
            $sql .= " AND area_nombre like '%$this->area_nombre%' ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscarPorId($id){
     
        $sql = "SELECT * FROM areas where area_situacion = 1 and area_id = $id ";
        $resultado = array_shift( self::servir($sql));
        // $resultado = self::servir($sql)[0];
        return $resultado;
    }

    // METODO PARA MODIFICAR
    public function modificar()
    {
        $sql = "UPDATE areas SET area_nombre = '$this->area_nombre' WHERE area_id = $this->area_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function eliminar(){
        // $sql = "DELETE FROM productos WHERE prod_id = $this->prod_id ";

        // echo $sql;
        $sql = "UPDATE areas SET area_situacion = 0 WHERE area_id = $this->area_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
}