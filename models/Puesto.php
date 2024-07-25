<?php
require_once 'Conexion.php';


class Puesto extends Conexion
{
    public $puesto_id;
    public $puesto_nombre;
    public $puesto_sueldo;
    public $puesto_situacion;


    public function __construct($args = [])
    {
        $this->puesto_id = $args['puesto_id'] ?? null;
        $this->puesto_nombre = $args['puesto_nombre'] ?? '';
        $this->puesto_sueldo = $args['puesto_sueldo'] ?? '';
        $this->puesto_situacion = $args['puesto_situacion'] ?? 1;
    }

    // METODO PARA INSERTAR
    public function guardar()
    {
        $sql = "INSERT into puestos (puesto_nombre, puesto_sueldo) values ('$this->puesto_nombre','$this->puesto_sueldo')";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    // METODO PARA CONSULTAR


    public function buscar(...$columnas)
    {
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM puestos where puesto_situacion = 1 ";

        if ($this->puesto_nombre != '') {
            $sql .= " AND puesto_nombre like '%$this->puesto_nombre%' ";
        }
        if ($this->puesto_sueldo != '') {
            $sql .= " AND puesto_sueldo like'%$this->puesto_sueldo%' ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscarPorId($id){
     
        $sql = "SELECT * FROM puestos where puesto_situacion = 1 and puesto_id = $id ";
        $resultado = array_shift( self::servir($sql));
        // $resultado = self::servir($sql)[0];
        return $resultado;
    }

    // METODO PARA MODIFICAR
    public function modificar()
    {
        $sql = "UPDATE puestos SET puesto_nombre = '$this->puesto_nombre', puesto_sueldo = '$this->puesto_sueldo' WHERE puesto_id = $this->puesto_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado;
    }

    public function eliminar(){
        // $sql = "DELETE FROM productos WHERE prod_id = $this->prod_id ";

        // echo $sql;
        $sql = "UPDATE puestos SET puesto_situacion = 0 WHERE puesto_id = $this->puesto_id ";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
}