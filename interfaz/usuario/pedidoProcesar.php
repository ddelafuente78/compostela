<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../css/usuario/pedidoProcesar.css"> 
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Puerto Compostela</title>
</head>
<body>
    <?php
        include '../../helper/usuarioValidar.php';
        include("../../modelo/carrito.php");
        include 'barraNavegacion.php';
    ?>
    
    <header>
        <div id="usuario">
            <span><?php echo $_SESSION["usuario"]?></span>
        </div>
        <div class="seccion">
            <span>Resultado final del procesamiento del pedido</span>
        </div>
    </header>
    <div class="contenedor">
        <?php
            $carrito = new carrito_cab();
            $idCarrito = $carrito->obtener_carrito($_SESSION["id"]);
            if($idCarrito === 0){
                echo "<div class='log'>Warning: El carrito ya se proceso o no existe <span class='ribbon-warn'>warn</span></div>";
            }else{
                $response = $carrito->moverCarritoAPedido($idCarrito);
                if (is_string($response)) {
                    echo "<div class='log'>Error: no se pudo ejecutar el proceso de creacion del pedido <span class='ribbon-er'>Error</span></div>";
                }else{
                    foreach($response as $rsp){
                        if(substr($rsp['estado'], 0, 2)==='ok'){
                            echo "<div class='log'> Articulo: " . $rsp["nombre"] . " Estado: OK <span class='ribbon-ok'>OK</span></div>";
                        }else{
                            echo "<div class='log'>Articulo: " . $rsp["nombre"] . " Estado: " . $rsp["estado"]   . "<span class='ribbon-er'>Error</span></div>";
                        }
                    }
                    echo "<div class='log'>FINALIZO EL PROCESO DE CREACION DE PEDIDO!!</div>";
                }
            }
        ?>
    </div>
</body>

    
