<?php
    class destinatario {
        public $id;
        public $razonsocial;
        public $dni;
        public $nrotelefono;
        public $direccion;
        public $cp;
        public $provincia;
    } 

    class articulo {
        public $id;
        public $nombre;
        public $descripcion;
        public $foto1;
        public $foto2;
        public $stock;
        public $stock_minimo;
    }

    class transporte {
        public $id;
        public $nombre;
        public $direccion;
        public $telefono;
    }
?>