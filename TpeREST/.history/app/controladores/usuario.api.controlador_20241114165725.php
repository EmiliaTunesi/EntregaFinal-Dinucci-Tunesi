<?php

    require_once 'app/modelos/usuario.modelo.php';
    require_once 'app/vistas/json.vista.php';
    require_once './libs/jwt.php';

    class UsuarioApiControlador {
        private $modelo;
        private $vista;

        public function __construct() {
            $this->modelo = new ModeloUsuario();
            $this->vista = new JSONVista();
        }

        public function obtenerToken() {
            // obtengo el email y la contraseña desde el header
            $auth_header = $_SERVER['HTTP_AUTHORIZATION']; // "Basic dXN1YXJpbw=="
            $auth_header = explode(' ', $auth_header); // ["Basic", "dXN1YXJpbw=="]
            if(count($auth_header) != 2) {
                return $this->vista->respuesta("Error en los datos ingresados", 400);
            }
            if($auth_header[0] != 'Basic') {
                return $this->vista->respuesta("Error en los datos ingresados", 400);
            }
            $user_pass = base64_decode($auth_header[1]); // "usuario:password"
            $user_pass = explode(':', $user_pass); // ["usuario", "password"]
            // Buscamos El usuario en la base
            $usuario = $this->modelo->obtenerUsuarioPorNombre($user_pass[0], $user_pass[1]);
            // Chequeamos la contraseña
            if($usuario == null || !password_verify($user_pass[1], $usuario->contrasena)) {
                return $this->vista->respuesta("Error en los datos ingresados", 400);
            }
            // Generamos el token
            $token = createJWT(array(
                'sub' => $usuario->id,
                'nombre' => $usuario->nombre,
                'role' => 'admin',
                'iat' => time(),
                'exp' => time() + 60,
            ));
            return $this->vista->respuesta($token);
        }
    }