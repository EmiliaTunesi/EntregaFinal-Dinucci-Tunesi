<?php

class ProveedoresModelo{

    private $db;
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
    }

    public function obtenerTodos($filtrarPorCiudad=null, $ordenarPor=false) {
        $sql = 'SELECT * FROM tareas';

        if($filtrarPorCiudad != null) {
            if($filtrarPorCiudad == 'true')
                $sql .= ' WHERE ciudad = 1';
            else
                $sql .= ' WHERE ciudad = 0';
        }

        if($ordenarPor) {
            switch($ordenarPor) {
                case 'nombre':
                    $sql .= ' ORDER BY nombre';
                    break;
                case 'contacto':
                    $sql .= ' ORDER BY contacto';
                    break;
                case 'contacto':
                    $sql .= ' ORDER BY contacto';
                    break;
                case 'contacto':
                $sql .= ' ORDER BY contacto';
                break;
                }
            }
        }

        // 2. Ejecuto la consulta
        $query = $this->db->prepare($sql);
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $tasks = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $tasks;
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