<?php
require_once 'config.php';

class ModeloUsuario 
{
    private $db;
    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=compras;charset=utf8', 'root', '');
    }
    public function obtenerUsuarioPorNombre($nombre, $contrasena)
    {
        $query = $this->db->prepare("SELECT * FROM usuario WHERE nombre = ?");
        $query->execute([$nombre]);

        $usuario = $query->fetch(PDO::FETCH_OBJ);

        if ($usuario && password_verify($contrasena, $usuario->contrasena)) {
            return $usuario;
        }

        return null;
    }
}
