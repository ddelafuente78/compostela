<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="../../css/barraNavegacion.css">
    <link rel="stylesheet" href="../../css/uicons-solid-rounded.css">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
</head>
<body id="body-barra">
    <div class="menu__side" id="menu_side">
        <div class="options__menu">
            <a href="javascript:history.back()"alt="selected">
                <div class="option">
                    <i class="fi fi-sr-left" title="Atrás"></i>
                <!-- <i class="fas fa-bars" id="btn_open"></i> -->
                </div>
            </a>
            <a href="usuarioInicio.php" class="selected">
                <div class="option">
                    <i class="fi fi-sr-home" title="Principal"></i> <!--<i class="fa-regular fa-star" title="Principal"></i> -->
                </div>
            </a>
            <a href="articulos.php" class="selected">
                <div class="option">
                    <i class="fa-solid fa-box-open" title="Consultar Stock"></i>
                </div>
            </a>
            <!--<a href="pendientes.php" class="selected">
                <div class="option">
                <i class="fa-solid fa-eye" title="Pedidos Pendisntes"></i>
                    <h4>Pedidos Pendientes</h4>
                </div>
            </a>
            <a href="#" class="selected">
                <div class="option">
                <i class="fa-solid fa-truck-fast" title="Pedidos en viaje"></i>
                    <h4>Pedidos en viaje</h4>
                </div>
            </a>
            <a href="#" class="selected">
                <div class="option">
                <i class="fa-solid fa-square-check" title="Pedidos Entregados"></i>
                    <h4>Pedidos entregados</h4>
                </div>
            </a>
            <a href="#" class="selected">
                <div class="option">
                <i class="fa-solid fa-shop" title="Compras"></i>
                    <h4>Compras</h4>
                </div>
            </a>-->
            <a href="passwordCambiar.php" class="selected">
                <div class="option">
                    <i class="fi fi-sr-key" title="Cambiar Contraseña"></i><!-- <i class="fa-solid fa-lock" title="Cambiar Contraseña"></i> -->
                </div>
            </a>
            <a href="../../login.php" class="selected">
                <div class="option">
                    <i class="fi fi-sr-exit-alt" title="Salir"></i><!-- <i class="fa-solid fa-rectangle-xmark" title="Cerrar"></i> -->
                </div>
            </a>
            
        </div>
    </div>
    <script src="../../js/menus.js"></script>
</body>

</html>