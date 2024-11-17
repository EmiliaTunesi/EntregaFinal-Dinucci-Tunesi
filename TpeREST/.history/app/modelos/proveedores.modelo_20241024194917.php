<?php

class ProveedoresModelo{

    private $db;
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
    }

    public function obtenerTodos($filtrarPorCuit=null, $ordenarPor=false, $ordenar= 'ASC') {
        $sql = 'SELECT * FROM proveedores';

        if($filtrarPorCuit != null) {
           $sql .= ' WHERE cuit = :cuit';
           
        }
        if ($ordenar){
            $orden=strtoupper($ordenar);
        }
        if($ordenarPor) {
            switch($ordenarPor) {
                case 'nombre':
                    $sql .= ' ORDER BY nombre' . $orden;
                    break;
                case 'contacto':
                    $sql .= ' ORDER BY contacto' . $orden;
                    break;
                case 'cuit':
                    $sql .= ' ORDER BY cuit' . $orden;
                    break;
                case 'ciudad':
                $sql .= ' ORDER BY ciudad' . $orden;
                break;
                case 'informacion':
                    $sql .= ' ORDER BY informacion_pago' . $orden;
                    break;                
            }
        }
        
        $query = $this->db->prepare($sql);
        if($filtrarPorCuit != null) {
            $query->bindParam(':cuit', $filtrarPorCuit, PDO::PARAM_STR);
        }
        
        $query->execute();
        $proveedores = $query->fetchAll(PDO::FETCH_OBJ);
        return $proveedores;
    }

    public function obtener($id_proveedor) {
        $query = $this->db->prepare('SELECT * FROM proveedores WHERE id_proveedor = ?');
        $query->execute([$id_proveedor]);

        $proveedor = $query->fetch(PDO::FETCH_OBJ);

        return $proveedor;
    }

    public function crear($nombre, $contacto, $cuit, $ciudad, $informacion_pago){
        $query = $this->db->prepare('INSERT INTO proveedores(nombre, contacto, cuit, ciudad, informacion_pago) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre, $contacto, $cuit, $ciudad, $informacion_pago]);

        $id_proveedor = $this->db->lastInsertId();

        return $id_proveedor;

    }
    public function editar($id_proveedor, $nombre, $contacto, $cuit, $ciudad, $informacion_pago) {

        $query = $this->db->prepare('UPDATE proveedores SET nombre = ?, contacto = ?, cuit = ?, ciudad = ?, informacion_pago = ? WHERE id_proveedor = ?');
        $query->execute([$nombre, $contacto, $cuit, $ciudad, $informacion_pago, $id_proveedor]);
    }


}