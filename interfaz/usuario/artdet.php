<html>
    <head>
        <link rel="stylesheet" href="../../css/artdet.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <Style>
            .cssanimation, .cssanimation span {
                animation-duration: 1s;
                animation-fill-mode: both;
            }

            .cssanimation span { display: inline-block }
            .infinite { animation-iteration-count: infinite !important }

            .lightning { animation-name: lightning }
            
            @keyframes lightning {
                from, 50%, to { opacity: 1 }
                25%, 75% { opacity: 0 }
            }
        </Style>
    </head>
    <body>
        <?php
            include '../../helper/conexion.php';
            include '../../helper/validar_usuario.php';
            
            $registros = mysqli_query($conexion, "select * from articulos where id=". $_GET["id"] ) or
                die("Problemas en el select:" . mysqli_error($conexion));

            $articulo = mysqli_fetch_array($registros);

            $registros = mysqli_query($conexion, "SELECT ar.nombre, ca.cantidad, ca.nro_pedido
                                FROM compostela.carrito ca
                                    join articulos ar on ca.articulos_id = ar.id;" ) or
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
                                    <a class="nav-link active" aria-current="page" href="../login.php">Home</a>                    
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="menu.php">Menu</a>                    
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="carrito.php">Carrito</a>                    
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
                        <img src="../../imagenes/<?php echo $articulo["foto1"] ?>" alt="<?php echo $articulo["foto1"] ?>" class="img-thumbnail imagen-centrada" />
                        <img src="../../imagenes/<?php echo $articulo["foto2"] ?>" alt="<?php echo $articulo["foto2"] ?>" class="img-thumbnail imagen-centrada"/>
                    </div>
                </div>
                <div class="col-4">
                    <div class="lineaSuperior"></div>
                    <div class="card caja">
                        <div class="card-body">
                            <h4 class="card-title"><div class="cssanimation lightning">producto: <?php echo $articulo["nombre"] ?> </div></h4>
                            <p class="card-text">
                                <form class="custom-form" action="carrito.php" method="post">
                                    <label  class="form-label">Stock: <?php echo $articulo["stock"] ?></label><br>
                                    <label for="cantidad" class="form-label">cuanto?:</label>
                                    <input type="text" class="form-control" id="cantidad" name="cantidad">
                                    <button type="submit" class="btn btn-primary">Pedir</button>
                                    <input type="hidden" name='id_articulo' value=<?php echo $articulo["id"] ?>>
                                </form> 
                            </p>
                        </div>        
                    </div>
                    <div style="margin:10px 50px">
                        <h6>Productos en carrito</h6> 
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
    </body>
<html>

