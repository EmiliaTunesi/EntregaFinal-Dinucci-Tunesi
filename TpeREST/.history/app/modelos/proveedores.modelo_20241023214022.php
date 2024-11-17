<?php

class ProveedoresModelo{

    private $db;
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
    }

    public function obtenerTodos($filtrarPorCuit=null, $ordenarPor=false) {
        $sql = 'SELECT * FROM proveedores';

        if($filtrarPorCuit != null) {
           $sql .= ' WHERE cuit = :cuit';
           
        }
    
        if($ordenarPor) {
            $columnasPermitidas = ['nombre', 'contacto', 'cuit', 'direccion', 'informacion_pago', 'ciudad'];
        if (in_array($ordenarPor, $columnasPermitidas)) {
            $sql .= ' ORDER BY ' . $ordenarPor;
        } else {
            // Si el valor de ordenarPor no es válido, podemos ignorarlo o lanzar una excepción
            return []; // No se realiza ningún ordenamiento si el campo no es válido
        }
    }/*
            switch($ordenarPor) {
                case 'nombre':
                    $sql .= ' ORDER BY nombre';
                    break;
                case 'contacto':
                    $sql .= ' ORDER BY contacto';
                    break;
                case 'cuit':
                    $sql .= ' ORDER BY cuit';
                    break;
                case 'ciudad':
                $sql .= ' ORDER BY ciudad';
                break;
                case 'informacion':
                    $sql .= ' ORDER BY informacion_pago';
                    break;                
            }
        }*/
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