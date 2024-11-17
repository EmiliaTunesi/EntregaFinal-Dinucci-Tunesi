<?php

class ProveedoresModelo{

    private $db;
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
    }

    public function obtenerTodos($filtrarPor=null, $valor=null, $ordenarPor=false, $ordenar= 'ASC') {
        $sql = 'SELECT * FROM proveedores';
        if ($ordenar){
            $orden=strtoupper($ordenar);
        }else{
            $orden= 'ASC';
        }

        /*if($filtrarPorCuit != null) {
           $sql .= ' WHERE cuit = :cuit';
        }*/
        if($filtrarPor) {
            $sql .= ' WHERE '; 
            switch($filtrarPor) {
                case 'nombre':
                    $sql .= 'nombre = :valor' . $orden;
                    break;
                case 'contacto':
                    $sql .= 'contacto = :valor' . $orden;
                    break;
                case 'cuit':
                    $sql .= 'cuit = :valor' . $orden;
                    break;
                case 'ciudad':
                    $sql .= 'cuidad = :valor' . $orden;
                break;
                case 'informacion':
                    $sql .= 'informacion = :valor' . $orden;
                break;                
            }
        }
        
        if($ordenarPor) {
            switch($ordenarPor) {
                case 'nombre':
                    $sql .= ' ORDER BY nombre ' . $orden;
                    break;
                case 'contacto':
                    $sql .= ' ORDER BY contacto ' . $orden;
                    break;
                case 'cuit':
                    $sql .= ' ORDER BY cuit ' . $orden;
                    break;
                case 'ciudad':
                $sql .= ' ORDER BY ciudad ' . $orden;
                break;
                case 'informacion':
                    $sql .= ' ORDER BY informacion_pago ' . $orden;
                    break;                
            }
        }
        
        $query = $this->db->prepare($sql);
        if($filtrarPor != null && $valor != null) {
            $query->bindParam(':valor', $valor, PDO::PARAM_STR);
            var_dump($query);
            die();
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