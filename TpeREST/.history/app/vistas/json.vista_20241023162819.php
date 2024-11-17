<?php

    class Jsonvista {
        public function respuesta($data, $status = 200) {
            header("Content-Type: application/json");
            $statusText = $this->_pedidosStatus($status);
            header("HTTP/1.1 $status $statusText");
            echo json_encode($data);
        }

        private function _pedidosStatus($code) {
            $status = array(
                200 => "OK",
                201 => "Created",
                204 => "No Content",
                400 => "Bad Request",
                404 => "Not Found",
                500 => "Internal Server Error"
            );
            if(!isset($status[$code])) {
                $code = 500;
            }
            return $status[$code];
        }
    }