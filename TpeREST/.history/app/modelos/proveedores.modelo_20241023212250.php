<?php

class ProveedoresModelo{

    private $db;
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
    }

    public function obtenerTodos($filtrarPorCuit=null, $ordenarPor=false) {
        $sql = 'SELECT * FROM proveedores';

        if($filtrarPorCuit != null) {
           $sql .= ' WHERE cuit = <?php $filtrarPorCuit?>';
           
        }

        if($ordenarPor) {
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
                case 'direccion':
                $sql .= ' ORDER BY direccion';
                break;
                case 'informacion':
                    $sql .= ' ORDER BY informacion_pago';
                    break;                
            }
        }

        $query = $this->db->prepare($sql);
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