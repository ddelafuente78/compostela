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
<div class="contenedor">
    <?php
    include '../../helper/usuarioValidar.php';
    include("../../modelo/articulo.php");
    include 'barraNavegacion.php';
    
    
    $articulo = new articulo();
    $pagina = 1;

    if(!isset($_SESSION['buscado'])) {
        $_SESSION['buscado'] = "";
    }

    if ($_GET){
        $pagina = $_GET["pag"]; 
    }

    if($_POST) {
        $_SESSION['buscado'] = $_POST['buscado'];
    }

    $listaArticulos = $articulo->obtenerArticulos($pagina, $_SESSION['buscado']);
    $cantidadPaginas = $articulo->cantidadPaginas($pagina, $_SESSION['buscado']);

    ?> 

    <header id="cabecera">
        <div class="usuario">
            <span>Mauricio</span>
        </div>
        <div class="titulo">
            <span>Artículos</span>
        </div>
        <div class="contiene-carrito">
            <div class = "carro">
            <i id="changuito" class="fi fi-sr-shopping-cart"></i>
                <span id="carrito" class="carrito"> 150 </span>
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
                <DIV>Artículo</DIV>
            </div>
            <div class="col2">
                <DIV>Stock</DIV>
            </div>
            <div class="col3">
                <DIV>Cantidad</DIV>
            </div>
            <div class="col4">

            </div>
        </div>
        <form class="form-articulos">
            <div class="grilla_articulos_detalle">
                <div id="col-g-1" class="col-g-1">
                    <img id="detalle" src="../../imagenes/productos/celular1.jpg">
                </div>
                <div id="col-g-2" class="col-g-2">
                    <span>Celular Samsung A24 64gb Almacenamiento, 2gb Ram, pantalla 6.5', color azul</span>
                </div>
                <div id="col-g-3" class="col-g-3">
                    <span id="cant-art">60</span>
                </div>
                <div id="col-g-4" class="col-g-4">
                    <input type="number" class="lblForm" id="cantidad-1" name="cantidad" placeholder="0" min=0>
                </div>
                <div id="col-g-5" class="col-g-5">
                    <button type="submit" class="btn-pedido" id='btnPedir'>Agregar al Carrito</button>
                </div>
<!--             </div> -->
<!--             <div class="grilla_articulos_detalle"> -->
                <div id="col-g-1" class="col-g-1">
                    <img src="../../imagenes/productos/termo1.webp">
                </div>
                <div id="col-g-2" class="col-g-2">
                <span>Celular Samsung A24 64gb Almacenamiento, 2gb Ram, pantalla 6.5', color azul</span>
                </div>
                <div id="col-g-3" class="col-g-3">
                    <span id="cant-art-2">60</span>
                </div>
                <div id="col-g-4" class="col-g-4">
                    <input type="number" class="lblForm" id="cantidad-2" name="cantidad" placeholder="0" min=0>
                </div>
                <div id="col-g-5" class="col-g-5">
                    <button type="submit" class="btn-pedido" id='btnPedir'>Agregar al Carrito</button>
                </div>
            </div>
            <div class="pagination">
                <a href="#">&laquo;</a>
                <a class="active" href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
            </div>
            <div class="contiene-boton">
                <button id="btn-confirm_add" class="btn-enviar" type="submit">Finalizar pedido</button>
            </div>

        </form>
    </div>
</div>
<div id="modalCarrito" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form class="form-articulos" action="">
        <div class="Contenedor-form-modal">
            <div class="titulo-Modal">
                <h2>Carrito</h2>
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
                </div>
            </div>
        </div>
    </form> 
</div>
<script src="../../js/usuario/articulos.js"></script>
<footer class="pie-de-pagina">
    <div class=progreso>
    </div>
    <div class="texto-progreso">
        Sección 1 de 3 
    </div>
</footer>
</body>
</html>