<?php
    class carrito_cab {
        private $id;
        private $fecha_entrega;
        private $prioridad_importante;
        private $destinatario;
        private $nro_sistema_externo;
        private $en_carrito;
        private $carrito_detalle = array();

        public function __construct($id = null, $en_carrito = null) {
            $this->id = $id;
            $this->en_carrito = $en_carrito;
        }

        public function set_fecha_entrega($fecha){
            $this->fecha_entrega = $fecha;
        }

        public function get_fecha_entrega() {
            return $this->fecha_entrega;
        }

        public function set_es_importante($es_importante){
            $this->prioridad_importante = $es_importante;
        }

        public function get_es_importante(){
            return $this->prioridad_importante;
        }

        public function set_destinatario($destinatario){
            $this->destinatario = $destinatario;
        }

        public function get_destinatario(){
            return $this->destinatario;
        }

        public function get_detalle() {
            return $this->carrito_detalle;
        }

        public function obtener_carrito($usuario_id){
            include 'conexion.php';

            $selPedido = "SELECT id FROM carrito_cab WHERE usuario_id=" . $usuario_id
                . " and en_carrito=1";
            
            $rsPedido = mysqli_query($conexion,$selPedido);
            $result = mysqli_fetch_assoc($rsPedido);
            
            mysqli_close($conexion);

            if(mysqli_num_rows($rsPedido) > 0) {
                $this->id = $result['id'];                
                return $this->id;
            } else {
                return 0;
            }
        }

        public function insertar_carrito($usuario_id, $articulo_id, $cantidad) {
            include 'conexion.php';

            $nroCarrito = $this->obtener_carrito($usuario_id);

            if($nroCarrito === 0) {

                $insCarrito = "INSERT INTO carrito_cab (fecha_hora, usuario_id, en_carrito) 
                            VALUES(CURRENT_TIMESTAMP(),". $usuario_id .",1)";
                mysqli_query($conexion,$insCarrito);
                $nroCarrito = mysqli_insert_id($conexion);

            }

            $selTotalDetalle = "SELECT count(*) as total FROM carrito_det WHERE carrito_cab_id=" . $nroCarrito;
            $rsTotalDetalle = mysqli_query($conexion, $selTotalDetalle);
            $total = mysqli_fetch_assoc($rsTotalDetalle);

            if ($total["total"] < 5){
                $insDetalle = "INSERT INTO carrito_det (carrito_cab_id,articulo_id,cantidad)
                          VALUES(". $nroCarrito . "," . $articulo_id . "," . $cantidad . ")";
            
                mysqli_query($conexion,$insDetalle);        
            } else {
                $message = "El limite del carrito es de 5 productos";
                echo "<script>showSnackbar('".htmlspecialchars($message, ENT_QUOTES, 'UTF-8')."');</script>";

            }
            
            mysqli_close($conexion);
        }

    }

    class carrito_det {
        private $ID;
        private $articulo;
        private $cantidad;

        public function __construct($id = null, $articulo =null,  $cantidad = null) {
            $this->id = $id;
            $this->articulo = $articulo;
            $this->cantidad = $id;
        }

        public function set_articulo($articulo){
            $this->articulo;       
        }

        public function get_articulo(){
            return $this->articulo;
        }

        public function get_detalle_carrito($carrito_id) {
            include 'conexion.php';

            $selDetalle = "SELECT a.id as id, det.id detid, det.cantidad, a.foto1, a.nombre FROM carrito_det det 
                JOIN articulos a ON  a.id=det.articulo_id 
                WHERE carrito_cab_id=" . $carrito_id;

            $rsDetalle = mysqli_query($conexion,$selDetalle);
            
            $resultsArray = [];
            while ($row = $rsDetalle->fetch_assoc()) {
                 $resultsArray[] = $row;
            }

            mysqli_close($conexion);

           return $resultsArray;
        }

        public function borrar_detalle($id){
            include 'conexion.php';

            $delDetalle = "DELETE FROM carrito_det WHERE id=" . $id;

            mysqli_query($conexion,$delDetalle);

            mysqli_close($conexion);
        }

        public function esta_en_carrito($id, $detalleCarrito){
            include 'conexion.php';

            if ($detalleCarrito) {
                foreach ($detalleCarrito as $row) {
                    if ($row['id'] === $id) {
                        return 1;
                    }
                }
            }
            return 0;
        }
    }
?>