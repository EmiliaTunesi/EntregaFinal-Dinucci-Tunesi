<?php

require_once 'modelo.php';
require_once 'config.php';

class ProveedoresModelo{
    public function obtenerTodas() {
        $query = $this->db->prepare('SELECT * FROM clientes');
        $query->execute();

        $clientes = $query->fetchAll(PDO::FETCH_OBJ);

        return $clientes;
    }
    public function obtener($id) {
    }
    public function borrar($id) {
    }
    public function crear($nombre, $contacto, $cuit, $direccion, $informacion_pago){

    }
    public function editar($nombre, $contacto, $cuit, $direccion, $informacion_pago){

    }


}