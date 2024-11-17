<?php
require_once './app/modelos/proveedores.controlador.php';
require_once './app/vistas/json.vista.php';

class ProveedoresControlador {
    private $modelo;
    private $vista;

    public function __construct() {
        $this->modelo = new ProveedoresModelo();
        $this->vista = new ProveedoresControlador();
    }

   
    public function obtenerTodas($req, $res) {
        $proveedores = $this->modelo->obtenerTodas();
        
        // mando las tareas a la vista
        return $this->vista->respuesta($proveedores);
    }

    // /api/tareas/:id
    public function obtener($req, $res) {
        // obtengo el id de la tarea desde la ruta
        $id = $req->parametros->id;

        // obtengo la tarea de la DB
        $proveedor = $this->modelo->obtener($id);

        if(!$proveedor) {
            return $this->vista->respuesta("El proveedor con el id=$id no existe", 404);
        }

        // mando la tarea a la vista
        return $this->vista->respuesta($proveedor);
    }

    // api/tareas (POST)
    public function crear($req, $res) {

        // valido los datos
        if (empty($req->cuerpo->nombre) || empty($req->cuerpo->cuit) || empty($req->cuerpo->contacto)) {
            return $this->vista->respuesta('Faltan completar datos', 400);
        }

        // obtengo los datos
        $nombre = $req->cuerpo->nombre;       
        $contacto = $req->cuerpo->contacto;       
        $cuit = $req->cuerpo->cuit;    
        $direccion= $req->cuerpo->direccion;
        $informacion_pago= $req->cuerpo->direccion;   

        // inserto los datos
        $id = $this->modelo->crear($nombre, $contacto, $cuit, $direccion, $informacion_pago);

        if (!$id) {
            return $this->vista->respuesta("Error al insertar proveedor", 500);
        }

        // buena práctica es devolver el recurso insertado
        $proveedor = $this->modelo->obtener($id);
        return $this->vista->respuesta($proveedor, 201);
    }

    // api/tareas/:id (PUT)
    public function editar($req, $res) {
        $id = $req->parametros->id;

        // verifico que exista
        $proveedor = $this->modelo->obtener($id);
        if (!$proveedor) {
            return $this->vista->respuesta("El proveedor con el id=$id no existe", 404);
        }

         // valido los datos
         if (empty($req->cuerpo->nombre) || empty($req->cuerpo->cuit) || empty($req->cuerpo->contacto)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        // obtengo los datos
        $titulo = $req->body->titulo;       
        $descripcion = $req->body->descripcion;       
        $prioridad = $req->body->prioridad;
        $finalizada = $req->body->finalizada;

        // actualiza la tarea
        $this->model->updateTask($id, $titulo, $descripcion, $prioridad, $finalizada);

        // obtengo la tarea modificada y la devuelvo en la respuesta
        $task = $this->model->getTask($id);
        $this->view->response($task, 200);
    }
}