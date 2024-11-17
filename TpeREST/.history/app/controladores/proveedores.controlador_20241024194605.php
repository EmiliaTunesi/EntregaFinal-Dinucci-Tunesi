<?php
require_once './app/modelos/proveedores.modelo.php';
require_once './app/vistas/json.vista.php';

class ProveedoresControlador {
    private $modelo;
    private $vista;

    public function __construct() {
        $this->modelo = new ProveedoresModelo();
        $this->vista = new JsonVista();
    }

    public function obtenerTodos($req, $res) {
        $filtrarPorCuit = null;
        if(isset($req->query->cuit)) {
            $filtrarPorCuit = $req->query->cuit;
        }
        
        $ordenarPor = false;
        if(isset($req->query->orden))
            $ordenarPor = $req->query->orden;

        $filtrarPorCuit = null;
        if(isset($req->query->cuit)) {
            $filtrarPorCuit = $req->query->cuit;
        }

        $proveedores = $this->modelo->obtenerTodos($filtrarPorCuit, $ordenarPor);
        return $this->vista->respuesta($proveedores);
    }

    public function obtener($req, $res) {
        $id = $req->params->id;
        $proveedor = $this->modelo->obtener($id);

        if(!$proveedor) {
            return $this->vista->respuesta("El proveedor con el id=$id no existe", 404);
        }
        return $this->vista->respuesta($proveedor);
    }

    public function crear($req, $res) {
        if (empty($req->cuerpo->nombre) ||empty($req->cuerpo->contacto) ||empty($req->cuerpo->cuit) || empty($req->cuerpo->ciudad) || empty($req->cuerpo->informacion_contacto)) {
            return $this->vista->respuesta('Faltan completar datos', 400);
        }
        $nombre = $req->cuerpo->nombre;       
        $contacto = $req->cuerpo->contacto;       
        $cuit = $req->cuerpo->cuit;    
        $ciudad= $req->cuerpo->ciudad;
        $informacion_pago= $req->cuerpo->direccion;   

        $id = $this->modelo->crear($nombre, $contacto, $cuit, $ciudad, $informacion_pago);

        if (!$id) {
            return $this->vista->respuesta("Error al insertar proveedor", 500);
        }

        $proveedor = $this->modelo->obtener($id);
        return $this->vista->respuesta($proveedor, 201);
    }

    public function editar($req, $res) {
        $id = $req->params->id;

        $proveedor = $this->modelo->obtener($id);
        if (!$proveedor) {
            return $this->vista->respuesta("El proveedor con el id=$id no existe", 404);
        }

         if (empty($req->cuerpo->nombre) ||empty($req->cuerpo->contacto) ||empty($req->cuerpo->cuit) || empty($req->cuerpo->ciudad) || empty($req->cuerpo->informacion_contacto)) {
            return $this->vista->respuesta('Faltan completar datos', 400);
        }

        $id_proveedor=$req->cuerpo->id_proveedor;
        $nombre = $req->cuerpo->nombre;       
        $contacto = $req->cuerpo->contacto;       
        $cuit = $req->cuerpo->cuit;    
        $ciudad= $req->cuerpo->ciudad;
        $informacion_pago= $req->cuerpo->direccion;   

        $this->modelo->editar($id_proveedor, $nombre, $contacto, $cuit, $ciudad, $informacion_pago);

        $proveedor = $this->modelo->obtener($id);
        $this->vista->respuesta($proveedor, 200);
    }
}