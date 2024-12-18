<?php
require_once './app/modelos/proveedores.modelo.php';
require_once './app/vistas/json.vista.php';

class ProveedoresApiControlador
{
    private $modelo;
    private $vista;

    public function __construct()
    {
        $this->modelo = new ProveedoresModelo();
        $this->vista = new JsonVista();
    }

    public function obtenerTodos($req)
    {
        $filtrarPor = null;
        $valor = null;
        if (isset($req->query->filtrarPor) && isset($req->query->valor)) {
            $filtrarPor = $req->query->filtrarPor;
            $valor = $req->query->valor;
        }
        if ($filtrarPor && !$this->modelo->existeColumna($filtrarPor)) {
            return $this->vista->respuesta(
                "No es posible filtrar por '$filtrarPor', campo inexistente",
                400
            );
        }
        if ($valor && !$this->modelo->existeValorEnColumna($filtrarPor, $valor)) {
            return $this->vista->respuesta(
                "No existen registros con el valor '$valor' en el campo '$filtrarPor'",
                404);
        }

        $ordenarPor = false;
        if (isset($req->query->orden))
            $ordenarPor = $req->query->orden;

        if ($ordenarPor && !$this->modelo->existeColumna($ordenarPor)) {
            return $this->vista->respuesta(
                "No es posible ordenar por '$ordenarPor', campo inexistente",
                400);
        }

        $ordenar = null;
        if (isset($req->query->ordenar)) {
            $ordenar = $req->query->ordenar;
        }
        if ($ordenar && !in_array($ordenar, ['asc', 'desc'])) {
            return $this->vista->respuesta(
                "El valor de 'ordenar' debe ser 'asc' o 'desc'.", 
                400);
        }

        $proveedores = $this->modelo->obtenerTodos($filtrarPor, $valor, $ordenarPor, $ordenar);
        return $this->vista->respuesta($proveedores);
    
    }
    
    public function obtener($req)
    {
        $id = $req->params->id;
        $proveedor = $this->modelo->obtener($id);

        if (!$proveedor) {
            return $this->vista->respuesta("El proveedor con el id=$id no existe", 404);
        }
        return $this->vista->respuesta($proveedor);
    }

    public function crear($req, $res)
    {
        if (!$res->usuario) {
            return $this->vista->respuesta("No autorizado", 401);
        }
        if (empty($req->cuerpo->nombre) || empty($req->cuerpo->contacto) || empty($req->cuerpo->cuit) || empty($req->cuerpo->ciudad) || empty($req->cuerpo->informacion_pago)) {
            return $this->vista->respuesta('Faltan completar datos', 400);

        }
        $nombre = $req->cuerpo->nombre;
        $contacto = $req->cuerpo->contacto;
        $cuit = $req->cuerpo->cuit;
        $ciudad = $req->cuerpo->ciudad;
        $informacion_pago = $req->cuerpo->informacion_pago;

        $id = $this->modelo->crear($nombre, $contacto, $cuit, $ciudad, $informacion_pago);

        if (!$id) {
            return $this->vista->respuesta("Error al insertar proveedor", 500);
        }

        $proveedor = $this->modelo->obtener($id);
        return $this->vista->respuesta($proveedor, 201);
    }

    public function editar($req, $res)
    {
        if (!$res->usuario) {
            return $this->vista->respuesta("No autorizado", 401);
        }
            $id = $req->params->id;

            $proveedor = $this->modelo->obtener($id);
            if (!$proveedor) {
                return $this->vista->respuesta("El proveedor con el id=$id no existe", 404);
            }

            if (empty($req->cuerpo->nombre) || empty($req->cuerpo->contacto) || empty($req->cuerpo->cuit) || empty($req->cuerpo->ciudad) || empty($req->cuerpo->informacion_pago)) {
                return $this->vista->respuesta('Faltan completar datos', 400);
            }

            $id_proveedor = $req->cuerpo->id_proveedor;
            $nombre = $req->cuerpo->nombre;
            $contacto = $req->cuerpo->contacto;
            $cuit = $req->cuerpo->cuit;
            $ciudad = $req->cuerpo->ciudad;
            $informacion_pago = $req->cuerpo->informacion_pago;

            $this->modelo->editar($id_proveedor, $nombre, $contacto, $cuit, $ciudad, $informacion_pago);

            $proveedor = $this->modelo->obtener($id);
            $this->vista->respuesta($proveedor, 200);
        }
    
}
