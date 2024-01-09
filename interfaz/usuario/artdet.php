<html>
    <head>
        <link rel="stylesheet" href="../../css/artdet.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        </style>
    </head>
    <body>
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>La cantidad pedida es mayor al stock disponible!!</p>
            </div>
        </div>
        <?php
            include '../../helper/conexion.php';
            include '../../helper/validar_usuario.php';
            
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
        <div class= "container-fluid">
            <!-- Header -->
            <header class="d-flex flex-wrap py-3 mb-5 border-bottom">
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
            </header>
            <div class="row">
                <div class="col-8">
                    <div class="lineaSuperior"></div>
                    <div id="slideshow" class='cajaimagenes'>
                        <img src="../../imagenes/productos/<?php echo $articulo["foto1"] ?>" alt="<?php echo $articulo["foto1"] ?>" class="img-thumbnail imagen-centrada" />
                        <img src="../../imagenes/productos/<?php echo $articulo["foto2"] ?>" alt="<?php echo $articulo["foto2"] ?>" class="img-thumbnail imagen-centrada"/>
                    </div>
                </div>
                <div class="col-4">
                    <div class="lineaSuperior"></div>
                    <div class="card caja fondopedido" style='border: 1px solid white;'>
                        <div class="card-body">
                            <h4 class="card-title"><div class="cssanimation lightning">producto: <?php echo $articulo["nombre"] ?> </div></h4>
                            <p class="card-text">
                                <form class="custom-form" action="carrito.php" method="post">
                                    <label  class="form-label">Stock: <?php echo $articulo["stock"] ?></label><br>
                                    <label for="cantidad" class="form-label">cantidad:</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="0">
                                    <button type="submit" class="btn btn-primary" id='btnPedir' disabled>Pedir</button>
                                    <input type="hidden" name='id_articulo' value=<?php echo $articulo["id"] ?>>
                                    <input type="hidden" id='stock' value=<?php echo $articulo["stock"] ?>>
                                </form> 
                            </p>
                        </div>        
                    </div>
                    <div style="margin:10px 20px">
                        <h6>Productos en carrito:</h6> 
                        <?php
                            $i=1;
                            foreach ($carrito as $car) {
                                echo $i++ . "- " . $car['nombre'] . " x " . $car['cantidad'] . " unidades. <br>";
                            } 
                        ?>
                    </div>
                </div>
            </div>
            <div class="row filaDescripcion">
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
            </div>   
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

