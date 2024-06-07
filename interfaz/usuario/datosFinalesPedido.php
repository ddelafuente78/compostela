<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../css/usuario/datosFinalesPedido.css">
    <link rel="stylesheet" href="../../css/uicons-solid-rounded.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Articulos - <!Puerto Compostela</title>
</head>
<body class="body-finales">
    <?php
        include '../../helper/usuarioValidar.php';
        include("../../modelo/articulo.php");
        include 'barraNavegacion.php';
    ?>
    <header id="cabecera">
        <div id="usuario">
            <span>Mauricio</span>
        </div>
        <div class="seccion">
            <span>Datos Finales del Pedido</span>
        </div>
    </header>
    <div class="contenedor">
        
        <form class="form-datos-finales">
            <div class = "datos-finales">
                <!-- <label for="prioridad">Prioridad:</label><br>
                <input class="campo-form" id="prioridad" list="Prioridad" name="prioridad">
                <datalist id="Prioridad">
                    <option value="Normal">
                    <option value="Urgente">
                </datalist><br>  -->

                <p>Prioridad:</p>
                    <input class="campo-form" type="radio" id="r-u" name="prioridad" value="normal" checked>
                    <label for="r-u">Normal</label><br>
                    <input class="campo-form" type="radio" id="r-n" name="prioridad" value="urgente">
                    <label for="r-n">Urgente</label><br>
            
                <label for="fechaL">Fecha límite de entrega:</label>
                <input class="campo-form" type="date" id="fechaL" name="fechaL" min="<?php echo date('Y-m-d'); ?>" required><br>
                <label for="campania">Campaña:</label>
                <input class="campo-form" type="text" id="campania" name="campania"><br> 
                <label for="nPedidoExt">Nro. pedido externo:</label>
                <input class="campo-form" type="text" id="nPedidoExt" name="pedidoExt"><br>
                <div class="btn">
                    <button id="btn-enviar" class="btn-enviar" type="submit">Enviar</button>
                </div>
                
            </div>
        </form>
    </div>
    <footer class="pie-de-pagina">
            <div class=progreso>
            </div>
            <div class="texto-progreso">
                Sección 3 de 3 
            </div>
        </footer>
</body>

    
