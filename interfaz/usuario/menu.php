<html>
  <head>
      <title>Menu</title>
      <link rel="stylesheet" href="../../css/menu.css">
      <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script> 
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">  -->
  </head>
  <body>
    <?php
      include '../../helper/validar_usuario.php';
    ?>
    <header class="header">
      <nav class="navbar">
        <div class="containerHipervinculos">
            <a class="etiquetaA" href="#"><?php echo $_SESSION["usuario"]; ?></a>
            <a class="etiquetaA" aria-current="page" href="../../login.php">Cerrar</a>                    
        </div>
      </nav>
    </header>
    <div class="container">
      <div class="fila1"> 
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">
              <i class="fa-solid fa-box-open"></i>
                Consultar Stock
            </h4>
              <a href="../../helper/nropedido.php  " class="btn">Entrar</a>
            </div>
          </div>
        
        <!--CARD DE LAS DEMAS FUNCINALIDADES-->
                
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">
              <i class="fa-solid fa-eye"></i>
                Ver pedidos pedientes
              </h4>
              <a href="pendientes.php" class="btn">Entrar</a>
            </div>
          </div>          
        
                
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">
              <i class="fa-solid fa-truck-fast"></i>
                Pedidos en viaje</h4>
              <a href="#" class="btn">Entrar</a>
            </div>
          </div>          
      </div>  
      <div class="fila2">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">
              <i class="fa-solid fa-square-check"></i>
                Pedidos entregados</h4>
              <a href="#" class="btn">Entrar</a>
            </div>
        </div>          
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">
              <i class="fa-solid fa-shop"></i>
                Compras</h4>
              <a href="#" class="btn">Entrar</a>
            </div>
          </div>         
      </div>
    </div>
  </body>
</html>