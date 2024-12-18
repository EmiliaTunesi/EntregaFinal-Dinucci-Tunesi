<?php

class ProveedoresModelo{

    private $db;
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
    }
    public function existeColumna($columna) {
        $query = $this->db->prepare("SHOW COLUMNS FROM proveedores LIKE :columna");
        $query->bindValue(':columna', $columna);
        $query->execute();
        return $query->rowCount() > 0;
    }
    public function existeValorEnColumna($columna, $valor) {
        $query = $this->db->prepare("SELECT COUNT(*) FROM proveedores WHERE $columna = :valor");
        $query->bindValue(':valor', $valor);
        $query->execute();
        return $query->fetchColumn() > 0;
    }

    public function obtenerTodos($filtrarPor=null, $valor=null, $ordenarPor=false, $ordenar= 'ASC') {
        $sql = 'SELECT * FROM proveedores';
        $params= [];
        if($filtrarPor) {
            $sql .= ' WHERE '; 
            switch($filtrarPor) {
                case 'nombre':
                    $sql .= 'nombre = :valor';
                    break;
                case 'contacto':
                    $sql .= 'contacto = :valor';
                    break;
                case 'cuit':
                    $sql .= 'cuit = :valor';
                    break;
                case 'ciudad':
                    $sql .= 'ciudad = :valor';
                break;
                case 'informacion':
                    $sql .= 'informacion = :valor';
                break;                
            }
        $params[':valor'] = $valor;
        }
        if ($ordenar){
            $orden=strtoupper($ordenar);
        }else{
            $orden= 'ASC';
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
        if(!empty($params)) {
            foreach($params as $param => $value) {
                $query->bindValue($param, $value);
            }
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