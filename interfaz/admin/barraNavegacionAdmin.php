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
            <a href="pedidos.php?tipo=prep" class="selected">
                <div class="option">
                <i class="fa-solid fa-cubes" title="Pedidos"></i>
                    <h4>Pedidos</h4>
                </div>
            </a>
            <a href="articulos.php" class="selected">
                <div class="option">
                <i class="fa-solid fa-box" title="Articulos"></i>
                    <h4>Articulos</h4>
                </div>
            </a>
            <a href="usuarios.php" class="selected">
                <div class="option">
                <i class="fa-solid fa-users" title="Usuarios"></i>
                    <h4>Usuarios</h4>
                </div>
            </a>
            <a href="transporte.php" class="selected">
                <div class="option">
                <i class="fa-solid fa-truck-arrow-right" title="Transporte"></i>
                    <h4>Transporte</h4>
                </div>
            </a>
            <a href="reportes.php" class="selected">
                <div class="option">
                <i class="fa-solid fa-book-open" title="Transporte"></i>
                    <h4>Reportes</h4>
                </div>
            </a>
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