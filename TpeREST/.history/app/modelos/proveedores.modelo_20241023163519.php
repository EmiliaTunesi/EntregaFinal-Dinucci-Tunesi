<?php

require_once 'modelo.php';
require_once 'config.php';

class ProveedoresModelo{

    protected function _deploy()
    {   
        $query = $this->db->query('SHOW TABLES LIKE\'proveedores\'');
        $tablas = $query->fetchAll();

        if (count($tablas) == 0) {
            $clientes = [
                ['id_cliente' => '1', 'dni' => '46555898', 'nombre' => 'Maria Florencia Miguens', 'telefono' => '556688', 'mail' => 'florenciamiguens@gmail.com', 'fecha_nacimiento' => '2014-10-08', 'imagen' => 'https://weremote.net/wp-content/uploads/2022/08/mujer-sonriente-apunta-arriba-1536x1024.jpg'],
                ['id_cliente' => '2','dni' => '38759465', 'nombre' => 'Pedro Gonzales', 'telefono' => '779635', 'mail' => 'pedrogonzales@gmail.com', 'fecha_nacimiento' => '2014-10-05', 'imagen' => 'https://plus.unsplash.com/premium_photo-1682096259050-361e2989706d?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'],
                ['id_cliente' => '3','dni' => '35648965', 'nombre' => 'Sofia Pereyra', 'telefono' => '541235', 'mail' => 'sofiap@gmail.com', 'fecha_nacimiento' => '2014-10-06', 'imagen' => 'https://phantom-telva.unidadeditorial.es/9132d2a2c7abb6ab7cf099d4af093fa6/resize/1280/f/webp/assets/multimedia/imagenes/2023/03/05/16780029716658.jpg'],
                ['id_cliente' => '4','dni' => '41235698', 'nombre' => 'Lucia Rodriguez', 'telefono' => '458976', 'mail' => 'luciarodriguez@gmail.com', 'fecha_nacimiento' => '2014-10-08', 'imagen' => 'https://as1.ftcdn.net/v2/jpg/06/02/06/62/1000_F_602066201_4zhQhDW6qVGqTQSaPmZzPfxKwQCEL3Kt.jpg'],
                ['id_cliente' => '5','dni' => '29564879', 'nombre' => 'Rodrigo Martinez', 'telefono' => '548796', 'mail' => 'rodrigom20@gmail.com', 'fecha_nacimiento' => '2024-10-01', 'imagen' => 'https://media.revistagq.com/photos/6008111d0c66a2a0f048c638/16:9/w_1600,c_limit/chris-hemsworth.jpg']

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
            $insertarSql = "INSERT INTO clientes (dni, nombre, telefono, mail, fecha_nacimiento, imagen) values(?,?,?,?,?,?)";
            $sentencia = $this->db->prepare($insertarSql);
            foreach ($clientes as $cliente) {
                $sentencia->execute([
                    $cliente['dni'],
                    $cliente['nombre'],
                    $cliente['telefono'],
                    $cliente['mail'],
                    $cliente['fecha_nacimiento'],
                    $cliente['imagen']

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