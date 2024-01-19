<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="../../css/menuss.css">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
</head>
<body id="body">
    <header>
        <div class="icon_menu">
            <i class="fas fa-bars" id="btn_open"></i>
        </div>
    </header>
    <div class="menu__side" id="menu_side">
        <div class="options__menu">
            <a href="menus.php" class="selected">
                <div class="option">
                <i class="fa-regular fa-star" title="Principal"></i>
                    <h4>Principal</h4>
                </div>
            </a>
            <a href="../../helper/nropedido.php" class="selected">
                <div class="option">
                <i class="fa-solid fa-box-open" title="Consultar Stock"></i>
                    <h4>Consultar stock</h4>
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
            <a href="../../login.php" class="selected">
                <div class="option">
                <i class="fa-solid fa-rectangle-xmark" title="Cerrar"></i>
                    <h4>Cerrar</h4>
                </div>
            </a>
            
        </div>
    </div>
    <script src="../../js/menus.js"></script>
</body>

</html>