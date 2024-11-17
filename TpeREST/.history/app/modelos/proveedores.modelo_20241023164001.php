<?php

require_once 'modelo.php';
require_once 'config.php';

class ProveedoresModelo{

    protected function _deploy()
    {   
        $query = $this->db->query('SHOW TABLES LIKE\'proveedores\'');
        $tablas = $query->fetchAll();

        if (count($tablas) == 0) {
            $proveedores = [
                ['id_proveedor' => '1', 'nombre' => 'Puig', 'contacto' => '2494587965', 'cuit' => '24568625633', 'direccion' => 'Avellaneda 500', 'informacion_pago' => 'Enviar pagos por transferencia, en horario de banco (enviar comprobante al conacto), ALIAS: puig.SA'],
               

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