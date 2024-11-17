<?php

    class Jsonvista {
        public function respuesta($data, $estado = 200) {
            header("Content-Type: application/json");
            $textoEstado = $this->_pedirEstado($estado);
            header("HTTP/1.1 $estado $textoEstado");
            echo json_encode($data);
        }

        private function _pedirEstado ($codigo) {
            $estado = array(
                200 => "OK",
                201 => "Created",
                204 => "No Content",
                400 => "Bad Request",
                404 => "Not Found",
                500 => "Internal Server Error"
            );
            if(!isset($estado[$codigo])) {
                $code = 500;
            }
            return $estado[$codigo];
        }
    }