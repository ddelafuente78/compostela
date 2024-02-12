<html>
    <head>
        <link rel="stylesheet" href="../../css/artdet.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Nunito:wght@200;500&family=Open+Sans:wght@300;400&family=Pacifico&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Stock insuficnete</p>
            </div>
        </div>
        <?php
            include '../../helper/conexion.php';
            include '../../helper/validar_usuario.php';
            include 'barraNavegacion.php';
            
            $registros = mysqli_query($conexion, "select * from articulos where id=". $_GET["id"] ) or
                die("Problemas en el select:" . mysqli_error($conexion));

            $articulo = mysqli_fetch_array($registros);

            $registros = mysqli_query($conexion, "SELECT ar.nombre, ca.cantidad, ca.nro_pedido
                                FROM carrito ca
                                    join articulos ar on ca.articulos_id = ar.id
                                where ca.nro_pedido='" . $_SESSION['nropedido'] . "';" ) or
                                    die("Problemas en el select:" . mysqli_error($conexion));

            $carrito =  mysqli_fetch_all($registros, MYSQLI_ASSOC);

        ?>
            <!-- Header -->
            <!--<header class="d-flex flex-wrap py-3 mb-5 border-bottom">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                    <div class="container">
                        <a class="navbar-brand" href="#"><?php echo $_SESSION["usuario"]; ?></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="menu.php">Menu</a>                    
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="articulos.php">Articulos</a>                    
                                </li>
                                <li class="nav-item">   
                                    <a class="nav-link active" aria-current="page" href="carrito.php">Carrito</a>                    
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="../../login.php">Cerrar</a>                    
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>-->
            <div class="contenedorGrl">
                    <div class="contenedorSec" id="contImg">
                        <div class="slide">
                            <ul>
                                <li><img src="../../imagenes/productos/<?php echo $articulo["foto1"] ?>" alt="<?php echo $articulo["foto1"] ?>" class="imagenArt" /></li>
                                <li><img src="../../imagenes/productos/<?php echo $articulo["foto2"] ?>" alt="<?php echo $articulo["foto2"] ?>" class="imagenArt"/></li>
                            </ul>

                        </div>
                    </div>    
                    <div class="contenedorSec"> <!--CONTENEDOR FORM-->
                            
                        <div class="contenedorFormulario">
                            <h4 class="tituloCard"><div>Artículo: <?php echo $articulo["nombre"] ?> </div></h4>
                                <p class="textoCard">
                                    <form class="formulario" action="carrito.php" method="post">
                                        <label  class="lblForm"><b>Stock actual:</b> <?php echo $articulo["stock"] ?></label><br>
                                        <label for="cantidad" class="lblForm"><b>Cantidad:</b></label>
                                        <input type="number" class="lblForm" id="cantidad" name="cantidad" placeholder="0">
                                        <br>
                                        <button type="submit" class="btn" id='btnPedir' disabled>
                                            <b>Pedir</b>
                                        </button>
                                        <input type="hidden" name='id_articulo' value=<?php echo $articulo["id"] ?>>
                                        <input type="hidden" id='stock' value=<?php echo $articulo["stock"] ?>>
                                    </form> 
                                </p>
                            </div>
                            <div class="detalleCarrito">
                                <h6>Articulos cargados <i class="fa-solid fa-cart-shopping"></i> :</h6> 
                            </div>
                            
                    
                        
                        <?php
                            $i=1;
                            foreach ($carrito as $car) {
                                echo $i++ . "- " . $car['nombre'] . " x " . $car['cantidad'] . " unidades. <br>";
                            } 
                        ?>
                    
                
            </div>
            <!--<div class="row filaDescripcion">
                <div class="col-8">
                <div class="lineaInferior"></div>
                    <p>
                        <div class="tabulador">              
                            <h6>
                                <?php echo $articulo["descripcion"] ?>
                            </h6>
                        </div>
                    </p>
                </div>
            </div>   -->
            </div>
                    
        
        <script src="../../js/slider.js"></script>
        <script lang='JavaScript'>
            // Get the modal
            var modal = document.getElementById("myModal");
            
            const inputElement = document.getElementById('cantidad');

            inputElement.addEventListener('keyup', function(event) {
                let stock = document.getElementById('stock').value;
                let cantidad = document.getElementById('cantidad').value;
                
                if(parseInt(stock) < parseInt(cantidad)){
                    
                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];
                    //open the modal
                    modal.style.display = "block";
                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";
                    }

                    document.getElementById('btnPedir').disabled = true;
                } else {
                    document.getElementById('btnPedir').disabled = false;
                }
            });
            
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </body>
<html>

