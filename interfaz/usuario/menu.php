<html>
  <head>
      <title>Menu</title>
      <link rel="stylesheet" href="../../css/menu.css">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">  
  </head>
  <body>
    <?php
      include '../../helper/conexion.php';
      include '../../helper/validar_usuario.php';
    ?>
    <header class="d-flex flex-wrap py-3 mb-5 border-bottom">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><?php echo $_SESSION["usuario"]; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../../login.php">Cerrar</a>                    
                </li>
              </ul>
            </div>
          </div>
      </nav>
    </header>

    <div class="container"> 
      
      <div class="row"> 
        <div class="col-md">        
          <div class="card bg-danger text-white">
            <div class="card-body">
              <h4 class="card-title">
              <i class="bi bi-card-checklist"></i>
                Crear pedido
              </h4>
              <p class="card-text" style="margin-left: 150px"></p>
              <a href="../../helper/nropedido.php  " class="btn btn-primary">Entrar</a>
            </div>
          </div>
        </div>

        <div class="col-md">        
          <div class="card bg-danger text-white">
            <div class="card-body">
              <h4 class="card-title">
                <i class="bi bi-binoculars"></i>
                Ver pedidos pedientes
              </h4>
              <p class="card-text"></p>
              <a href="pendientes.php" class="btn btn-primary">Entrar</a>
            </div>
          </div>          
        </div>
      
        <div class="col-md">        
          <div class="card bg-danger text-white">
            <div class="card-body">
              <h4 class="card-title">
                <i class="bi bi-send"></i>
                Pedidos en viaje</h4>
              <p class="card-text"></p>
              <a href="#" class="btn btn-primary">Entrar</a>
            </div>
          </div>          
        </div>
      </div>

      <div class="row" style="padding-top: 10px">
        
        <div class="col-md col-4">        
          <div class="card bg-danger text-white">
            <div class="card-body">
              <h4 class="card-title">
                <i class="bi bi-shield-check"></i>
                Pedidos entregado</h4>
              <p class="card-text"></p>
              <a href="#" class="btn btn-primary">Entrar</a>
            </div>
          </div>          
        </div>

        <div class="col-md col-4">        
          <div class="card bg-danger text-white">
            <div class="card-body">
              <h4 class="card-title">
                <i class="bi bi-shield-check"></i>
                Compras</h4>
              <p class="card-text"></p>
              <a href="#" class="btn btn-primary">Entrar</a>
            </div>
          </div>          
        </div>

        <div class="col-md"></div>        
      
      </div> 
    </div>
  </body>
</html>