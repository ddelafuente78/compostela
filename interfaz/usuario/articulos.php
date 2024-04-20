<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../css/usuario/articulos.css">
    <link rel="stylesheet" href="../../css/uicons-solid-rounded.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Articulos</title>
</head>
<body>
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
<div class="contenedor">
    <header class="cabecera">
        <div class="titulo">
            acá va el título
        </div>
        <div class="carrito">
            <div class = "carro">
            <i id="changuito" class="fi fi-sr-shopping-cart"></i>
                <span class="carrito"> 0 </span>
            </div>
        </div>
    </header>
    <div>
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
                <DIV>Favorito</DIV>
            </div>
            <div class="col2">
                <DIV>Articulo</DIV>
            </div>
            <div class="col3">
                <DIV>Descripción</DIV>
            </div>
            <div class="col4">
                <DIV>Stock</DIV>
            </div>
            <div class="col5">
                <DIV>Cantidad</DIV>
            </div>
            <div class="col6">

            </div>
        </div>
        <form class="form-articulos">
            <div class="grilla_articulos_detalle">
                <div id="col-g-1" class="col-g-1">
                    <i class="fi fi-sr-icon-star"></i>
                </div>
                <div id="col-g-2" class="col-g-2">
                    <img src="../../imagenes/productos/celular1.jpg">
                </div>
                <div id="col-g-3" class="col-g-3">
                    <span>Celular Samsung A24 64gb Almacenamiento, 2gb Ram, pantalla 6.5', color azul</span>
                </div>
                <div id="col-g-4" class="col-g-4">
                    <span>6000</span>
                </div>
                <div id="col-g-5" class="col-g-5">
                    <input type="number" class="lblForm" id="cantidad" name="cantidad" placeholder="0">
                </div>
                <div id="col-g-7" class="col-g-7"> 
                    <button type="submit" class="btn2" id='btnPedir'>Agregar al Carrito</button>
                </div>
            </div>
            <div class="grilla_articulos_detalle">
                <div id="col-g-1" class="col-g-1">
                    <i class="fi fi-sr-icon-star"></i>
                </div>
                <div id="col-g-2" class="col-g-2">
                    <img src="../../imagenes/productos/termo1.webp">
                </div>
                <div id="col-g-3" class="col-g-3">
                    <span>Celular Samsung A24 64gb Almacenamiento, 2gb Ram, pantalla 6.5', color azul</span>
                </div>
                <div id="col-g-4" class="col-g-4">
                    <span>60</span>
                </div>
                <div id="col-g-5" class="col-g-5">
                    <input type="number" class="lblForm" id="cantidad" name="cantidad" placeholder="0">
                </div>
                <div id="col-g-7" class="col-g-7"> 
                    <button type="submit" class="btn2" id='btnPedir'>Agregar al Carrito</button>
                </div>
            </div>
        </form>
    </div>
    <div class="carrito">

    </div>
</div>
<Form class="form-articulos">


    </Form>
        <table>

        </table>
    </div>
</body>
</html>