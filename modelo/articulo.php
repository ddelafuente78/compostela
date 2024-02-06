<?php
    class articulo {
            private $id;
            private $nombre;
            private $descripcion;
            private $foto1;
            private $foto2;
            private $stock;
            private $stock_minimo;

            public function __construct($id = null, $nombre = null, $descripcion = null, $foto1 = null, 
                        $foto2 = null, $stock = null, $stock_minimo = null) {
                
                $this->id = $id;
                $this->nombre = $nombre;
                $this->descripcion = $descripcion;
                $this->foto1 = $foto1;
                $this->foto2 = $foto2;
                $this->stock = $stock;
                $this->stock_minimo = $stock_minimo;
            }

            public function obtenerArticulos($pagina, $filtro = null){
                include 'conexion.php';

                if($filtro == null){
                    $selArticulos = "SELECT * FROM articulos WHERE fecha_baja IS NULL LIMIT 20 OFFSET " . $pagina . ";";
                } else {
                    $selArticulos = "SELECT * FROM articulos WHERE fecha_baja IS NULL AND nombre LIKE '%". $filtro ."%' LIMIT 20 OFFSET " . $pagina . ";";
                }

                $rsArticulos = mysqli_query($conexion, $selArticulos) or
                    die("Problemas en el select:" . mysqli_error($conexion));

                mysqli_close($conexion);
                return $rsArticulos;
            }

        }
?>
