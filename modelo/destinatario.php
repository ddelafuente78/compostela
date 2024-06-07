<?php
    class destinatario {
        private $id;
        private $nombre;
        private $DNI;
        private $direccion;

        public function __construct($id = null, $nombre = null, $DNI = null) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->DNI = $DNI;
        }

        public function set_direccion($direccion){
            $this->direccion = $direccion;
        }

        public function get_direccion(){
            return $this->direccion;
        }
    }

    class direccion {
        private $id;
        private $telefono;
        private $direccion;
        private $provincia;

        public function __construct($id = null, $telefono = null, $direccion = null, $provincia = null) {
            $this->id = $id;
            $this->telefono = $telefono;
            $this->direccion = $direccion;
            $this->provincia = $provincia;
        }
    }
?>