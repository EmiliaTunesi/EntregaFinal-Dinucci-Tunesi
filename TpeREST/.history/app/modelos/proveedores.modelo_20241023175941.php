<?php

require_once 'modelo.php';
require_once 'config.php';

class ProveedoresModelo extends Modelo{

    protected function _deploy()
    {   
        $query = $this->db->query('SHOW TABLES LIKE\'proveedores\'');
        $tablas = $query->fetchAll();

        if (count($tablas) == 0) {
            $proveedores = [
                ['id_proveedor' => '1', 'nombre' => 'Puig', 'contacto' => '2494587965', 'cuit' => '24568625633', 'direccion' => 'Avellaneda 500', 'informacion_pago' => 'Enviar pagos por transferencia, en horario de banco (enviar comprobante al conacto), ALIAS: puig.SA'], 
                ['id_proveedor' => '2', 'nombre' => 'Fragancia Premium', 'contacto' => '1134785962', 'cuit' => '30495874612', 'direccion' => 'Calle Libertad 1234', 'informacion_pago' => 'Enviar pagos por transferencia bancaria antes del día 15 de cada mes, ALIAS: fragancia.premium'], 
                ['id_proveedor' => '3', 'nombre' => 'Perfumes Exclusivos', 'contacto' => '1156784321', 'cuit' => '20587694321', 'direccion' => 'Av. Belgrano 850', 'informacion_pago' => 'Pagos por depósito bancario, ALIAS: perfumes.exclusivos, enviar comprobante al contacto'], 
                ['id_proveedor' => '4', 'nombre' => 'Aromas del Mundo', 'contacto' => '1167895432', 'cuit' => '27485963217', 'direccion' => 'Calle San Martín 450', 'informacion_pago' => 'Pagos por transferencia bancaria o efectivo, ALIAS: aromas.mundo']


            ];
            $sql = <<<SQL
                CREATE TABLE `proveedores` (
                `id_proveedor` int(11) NOT NULL,
                `nombre` varchar(50) NOT NULL,
                `contacto` int(20) NOT NULL,
                `cuit` int(50) NOT NULL,
                `direccion` varchar(50) NOT NULL,
                `informacion_pago` text NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            SQL;
            $this->db->query($sql);
            $insertarSql = "INSERT INTO proveedores (id_proveedor, nombre, contacto, cuit, direccion, informacion_pago) values(?,?,?,?,?,?)";
            $sentencia = $this->db->prepare($insertarSql);
            foreach ($proveedores as $proveedor) {
                $sentencia->execute([
                    $proveedor['dni'],
                    $proveedor['nombre'],
                    $proveedor['telefono'],
                    $proveedor['mail'],
                    $proveedor['fecha_nacimiento'],

                ]);
            }
        }
    }


    public function obtenerTodos() {
        $query = $this->db->prepare('SELECT * FROM proveedores');
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
    public function crear($nombre, $contacto, $cuit, $direccion, $informacion_pago){
        $query = $this->db->prepare('INSERT INTO proveedores(nombre, contacto, cuit, direccion, informacion_pago) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$nombre, $contacto, $cuit, $direccion, $informacion_pago]);

        $id_proveedor = $this->db->lastInsertId();

        return $id_proveedor;

    }
    public function editar($id_proveedor, $nombre, $contacto, $cuit, $direccion, $informacion_pago) {
        // Asegúrate de que no se intente editar el id_proveedor, solo otros campos
        $query = $this->db->prepare('UPDATE proveedores SET nombre = ?, contacto = ?, cuit = ?, direccion = ?, informacion_pago = ? WHERE id_proveedor = ?');
        
        // Ejecuta la consulta pasando el id_proveedor como último parámetro
        $query->execute([$nombre, $contacto, $cuit, $direccion, $informacion_pago, $id_proveedor]);
    }


}