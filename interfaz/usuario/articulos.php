<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="../../css/usuario/articulos.css">
        <link rel="stylesheet" href="../../css/uicons-solid-rounded.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
        <title>Articulos - Puerto Compostela</title>
    </head>
<body>
    <div id="snackbar"></div>
    <?php
        include '../../helper/usuarioValidar.php';
        include '../../modelo/articulo.php';
        include '../../modelo/carrito.php';
        include 'barraNavegacion.php';
    
        $articulo = new articulo();
        $carrito_cab = new carrito_cab();
        $carrito_det = new carrito_det();
        $pagina = 1;
        

        if(!isset($_SESSION['buscado'])){
            $_SESSION['buscado'] = "";
        }

        if ($_GET){
            $pagina = $_GET["pag"]; 
        }

        if($_POST){

            if(isset($_POST['buscado'])){
                $_SESSION['buscado'] = $_POST['buscado'];
            }
            
            if (isset($_POST['btnpedir'])) {
                $carrito_cab->insertar_carrito($_SESSION["id"], $_POST['btnpedir'], $_POST['cantidad' . $_POST['btnpedir']]);
            }

            if (isset($_POST['btnBorrar'])) {
                echo $_POST['btnBorrar'];
                $carrito_det->borrar_detalle($_POST['btnBorrar']);
            }

        }

        $idCarrito = $carrito_cab->obtener_carrito($_SESSION["id"]);
        $detalleCarrito = $carrito_det->get_detalle_carrito($idCarrito);
        $listaArticulos = $articulo->obtenerArticulos($pagina, $_SESSION['buscado']);
        $cantidadPaginas = $articulo->cantidadPaginas($_SESSION['buscado']);

    ?> 

    <div class="contenedor"> 

        <header class="cabecera">
            <div class="usuario">
                <span><?php echo $_SESSION["usuario"]?></span>
            </div>
            <div class="contiene-carrito">
                <div class = "carro">
                    <span>ID:</span>
                    <span id="carrito" class="carrito"><?php echo $idCarrito;?></span>
                </div>
                <div class="carro">
                    <i id="changuito" class="fi fi-sr-shopping-cart"></i>
                    <span id="carrito" class="carrito" onclick='mostrarModalCarrito()'><?php echo count($detalleCarrito);?></span>
                </div>
            </div>
        </header>

        <div class="buscador">
            <form class="formulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="containerBuscador">
                    <input type="text" class="inputBuscar" name="buscado" placeholder="Search..." value="<?php echo $_SESSION['buscado']; ?>">
                    <button class="btnBuscar" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>

        <div class="articulos">
            <div class="articulos_cabecera">
                <div class="col1">
                    <div>Artículo</div>
                </div>
                <div class="col2">
                    <div>Stock</div>
                </div>
                <div class="col3">
                    <div>Cantidad</div>
                </div>
                <div class="col4">

                </div>
            </div>

            <form class="form-articulos" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <?php
                    foreach($listaArticulos as $articulo) {
                ?>
                    <div class="grilla_articulos_detalle">
                    
                        <div id="col-g-1" class="col-g-1">
                            <img src="../../imagenes/productos/<?php echo $articulo['foto1']?>"
                            onClick="mostrarModalImagenes('<?php echo $articulo['foto1']?>','<?php echo $articulo['foto2']?>')">
                        </div>
                        <div id="col-g-2" class="col-g-2">
                            <span><?php echo $articulo['nombre'] ?></span>
                        </div>
                        <div id="col-g-3" class="col-g-3">
                            <span id="cant-art"><?php echo intval($articulo['stock']) ?></span>
                        </div>
                        <div id="col-g-4" class="col-g-4">
                            <input type="number" class="lblForm" id ="cantidad<?php echo $articulo['id']?>" 
                            onblur="checkMax(event,<?php echo intval($articulo['stock']) ?>)" 
                            name="cantidad<?php echo $articulo['id']?>" placeholder="0" min=0>
                        </div>
                        <div id="col-g-5" class="col-g-5">
                            <button type="submit" 
                            <?php 
                                if($carrito_det->esta_en_carrito($articulo['id'],$detalleCarrito)===1) {
                            ?>      class="btn-disabled"
                            <?php
                                } else {
                            ?>      class="btn-pedido"
                            <?php    
                                }
                            ?>
                            id='btnPedir' name='btnpedir'
                            value="<?php echo $articulo['id']?>">Agregar al Carrito</button>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </form>
        </div>
    </div>

    <!-- El Modal -->
<div id="imagenesModal" class="modal">
    <div class="modal-content">
        <div style="margin-bottom:20px">
            <span class="close" onclick='ocultarModalImagenes()'>&times;</span>
        </div> 
        <!-- Slideshow container -->
        <div class="slideshow-container">
            <div style="text-align:center">
            <!-- Slides -->
            <div class="mySlides fade">
                <img id='imgModal1' src="" style="width:25%; height:25%">
            </div>
            <div class="mySlides fade">
                <img id='imgModal2' src="" style="width:25%; height:25%">
            </div>
            </div>
        </form>
    </div>
    
</div>

    
    <div id="modalCarrito" class="modal">
        <!-- Modal content -->
        <div class="modal-content">

            <span class="close" onclick='ocultarModalCarrito()'>&times;</span>
            
            <div class="Contenedor-form-modal">
                <div class="titulo-Modal">
                    <h2>Articulos en carrito</h2>
                </div>
            </div>
            <div class="grilla_articulos_detalle">
                <div id="col-g-1" class="col-g-1">
                    <img id="detalle" src="../../imagenes/productos/celular1.jpg">
                </div>
                <div id="col-g-2" class="col-g-2">
                    <span>Celular Samsung A24 64gb Almacenamiento, 2gb Ram, pantalla 6.5', color azul</span>
                </div>
                <div id="col-g-3" class="col-g-3">
                    <span id="cant-art-2">60</span>
                </div>
                <div id="col-g-4" class="col-g-4">
                    <input type="number" class="lblForm" id="cantidad-1" name="cantidad" placeholder="0">
                </div>
                <div id="col-g-5" class="col-g-5">
                    <button type="submit" class="btn-pedido" id='btnPedir'>Quitar</button>
                </div>
            </div>
            <div class="contiene-boton">
                <button id="btn-confirm_add" class="btn-enviar" type="submit">Finalizar pedido</button>
            </div>
        </div>
        </form>
    </div>
</div>

<div id="modalDetalle" class="modal">
    <span class="close">&times;</span>
    <form class="form-articulos" action="">
        <div class="Contenedor-form-modal">
            <div class="slider">
                <div class="slider-Inner">
                    <div class="contiene-slider">
                        <ul class="slider">
                            <li>
                                <input type="radio" id="sbutton1" name="sradio" checked>
                                <label for="sbutton1"></label>
                                <img src="../../imagenes/productos/celular1.jpg" alt="Celular1">
                            </li>
                            <li>
                                <input type="radio" id="sbutton2" name="sradio">
                                <label for="sbutton2"></label>
                                <img src="../../imagenes/productos/celular3.jpg" alt="Celular3">
                            </li>
                            <li>
                                <input type="radio" id="sbutton3" name="sradio">
                                <label for="sbutton3"></label>
                                <img src="../../imagenes/productos/termo1.webp" alt="termo1">
                            </li>
                        </ul>
                        <div class="descripcion">
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio iusto atque deleniti reiciendis molestiae doloribus quo fugit explicabo corporis, quis temporibus. Illo eum tenetur cumque quam fuga ullam et ad!</span>
                        </div>
                    </div>
                    <hr style="width:65%">
                <?php
                    
                ?>
            </form>
        </div>
    </div>

    <div class="pagination">
        <a href="articulos.php?pag=1">&laquo;</a>
        <?php 
            for($i=1; $i <= $cantidadPaginas; $i++) {
        ?>
            <a  <?php 
                    echo ($i == $pagina) ? "class='active'" : ""; ?> 
                href="articulos.php?pag=<?php echo $i ?>"><?php echo $i ?>
            </a>
        <?php   
            }
        ?>
        <a href="articulos.php?pag=<?php echo $cantidadPaginas ?>">&raquo;</a>
    </div>

    <div class="contiene-boton">
        <a href="destinatarioPedido.php"><button id="btn-confirm_add" class="btn-continuar">Continuar...</button></a>
    </div>

    <footer class="pie-de-pagina">
        <div class="progreso">
        </div>
        <div class="texto-progreso">
            Sección 1 de 4 
        </div>
    </footer>
    <script src="../../js/usuario/articulos.js"></script>
</body>
</html>