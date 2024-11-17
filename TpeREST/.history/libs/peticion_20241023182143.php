<?php
    class Peticion {
        public $cuerpo = null; 
        public $parametros = null; 
        public $query = null; 

        public function __construct() {
            try {
                $this->cuerpo = json_decode(file_get_contents('php://input'));
            }
            catch (Exception $e) {
                $this->cuerpo = null;
            }
            $this->query = (object) $_GET;
        }
    }