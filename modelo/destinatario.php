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

        public function get_destinatarios(){
            include 'conexion.php';

            $selDestinatarios = "SELECT id, razon_social, DNI FROM destinatarios;";

            $rsDestinatarios = mysqli_query($conexion,$selDestinatarios);
            
            $resultsArray = [];
            while ($row = $rsDestinatarios->fetch_array()) {
                $resultsArray[] = [
                    'id' => $row[0],
                    'desc' => $row[1]
                ];
            }

            mysqli_close($conexion);

            return $resultsArray;
        }

        public function guardarDestinatario($razon_social, $dnicuit, $telefono, $direccion, $cp, $provincia){
            include 'conexion.php';

            $insDest = "INSERT INTO destinatarios (razon_social,dni) values('$razon_social','$dnicuit')";

            if (mysqli_query($conexion, $insDest)) {
                $idDest = mysqli_insert_id($conexion);
                $insDire = "INSERT INTO direcciones_destinatarios (destinatario_id, telefono, direccion, provincia, codigo_postal)
                                                            VALUES($idDest,'$telefono','$direccion','$provincia','$cp')";
                if (mysqli_query($conexion, $insDire)){
                    $response = "ok";
                }else{
                    $response = "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                $response = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conexion);
            
            return $response;
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

        function obtenerDirecciones($idx){
            include 'conexion.php';

            $selDirecciones = "SELECT * FROM direcciones_destinatarios where destinatario_id=" . intval($idx);

            $rsDirecciones = mysqli_query($conexion,$selDirecciones);

            mysqli_close($conexion);

            return $rsDirecciones;
            
        }

        function guardarDireccionCarrito($idcarrito, $iddireccion){
            include 'conexion.php';

            $updDireccion = "UPDATE carrito_cab SET direccion_id=$iddireccion WHERE id=$idcarrito";

            $response = "";
            if (mysqli_query($conexion, $updDireccion)) {
                $response = "ok";
            } else {
                $response = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            // Cerrar la conexión
            mysqli_close($conexion);

            return $response;
        }
    }
?>