<?php 
    class Usuario {
        private $id;
        private $nombre;
        private $mail;
        private $password;
        private $rol;

        public function __construct($id, $nombre, $mail, $password, $rol) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->mail = $mail;
            $this->password = $password;
            $this->rol = $rol;
        }

        public function getID(){
            return $this->id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getRol(){
            return $this->rol;
        }

        public function existeUsuario(){
            include 'conexion.php';

            $rsUsuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '" . $this->mail . 
                "' and password = '" . $this->password . "'") or
                die("Problemas en el select de login:" . mysqli_error($conexion));
            
            if($rsUsuario->num_rows==0){
                return false;
            }
            $dbUsuario = mysqli_fetch_array($rsUsuario);
            $this->id = $dbUsuario['id'];
            $this->nombre = $dbUsuario['nombre'];
            $this->rol = $dbUsuario['rol'];
            mysqli_close($conexion);
            return true;
        }
    }
?>