<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../css/usuario/datosFinalesPedido.css">
    <link rel="stylesheet" href="../../css/uicons-solid-rounded.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Puerto Compostela</title>
    <script src='../../js/usuario/datosFinalesPedido.js'></script>
</head>
<body class="body-finales">
    <div id="snackbar"></div>
    <?php
        include '../../helper/usuarioValidar.php';
        include("../../modelo/carrito.php");
        include 'barraNavegacion.php';

        if($_POST){
            $carrito_cab = new carrito_cab(null,null);
            $idCarrito = $carrito_cab->obtener_carrito($_SESSION["id"]);
            if($carrito_cab->insertar_datos_finales($idCarrito,$_POST['prioridad'],$_POST['fechaEntrega'],$_POST['campania'])){
                header('location:pedidoProcesar.php');
            }else{
                echo "<script>showSnackbar('".htmlspecialchars('Hubo un error', ENT_QUOTES, 'UTF-8')."');</script>";
            };
        }
    ?>
    
    <header id="cabecera">
        <div id="usuario">
            <span><?php echo $_SESSION["usuario"]?></span>
        </div>
        <div class="seccion">
            <span>Datos finales del pedido</span>
        </div>
    </header>
    <div class="contenedor">      
        <form class="form-datos-finales" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
            <div class = "datos-finales">
                <p>Prioridad:</p>
                <input class="campo-form" type="radio" id="r-u" name="prioridad" value="0">
                <label for="r-u">Normal</label><br>
                <input class="campo-form" type="radio" id="r-n" name="prioridad" value="1">
                <label for="r-n">Urgente</label><br>
                <label for="fechaL">Fecha límite de entrega:</label>
                <input class="campo-form" type="date" id="fechaL" name="fechaEntrega" min="<?php echo date('Y-m-d'); ?>" required><br>
                <label for="campania">Campaña:</label>
                <input class="campo-form" type="text" id="campania" name="campania"><br> 
                <div class="btn">
                    <button id="btn-enviar" class="btn-enviar" type="submit">Terminar y procesar</button>
                </div>
            </div>
        </form>
    </div>
    <footer class="pie-de-pagina">
            <div class=progreso>
            </div>
            <div class="texto-progreso">
                Sección 3 de 4 
            </div>
        </footer>
</body>

    
