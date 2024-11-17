<?php
    class Peticion {
        public $cuerpo = null; # { nombre: 'Saludar', descripcion: 'Saludar a todos' }
        public $parametros = null; # /api/tareas/:id
        public $query = null; # ?soloFinalizadas=true

        public function __construct() {
            try {
                # file_get_contents('php://input') lee el body de la request
                $this->cuerpo = json_decode(file_get_contents('php://input'));
            }
            catch (Exception $e) {
                $this->cuerpo = null;
            }
            $this->query = (object) $_GET;
        }
    }