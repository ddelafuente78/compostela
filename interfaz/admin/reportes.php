<!DOCTYPE html>
  <html>
    <head>
      <title>Administrador - compostela</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
      <style>
        body {
              font-family: "Segoe UI", sans-serif;
              font-size:100%;
          }

        .menu {
            background:#333;
            width:100%;
            height: 100%;
            left: 10px;
          }

          #contenido {
            margin-left:0;
          }

          .sidebar {
            position: fixed;
            top: -10px;
            bottom: 10px;
            left: 0px ;
            z-index: 1;
          }

          .sidebar ul, .sidebar li {
            margin:0;
            padding:0;
            margin-left: 10px ;
            list-style:none inside;
          }

          .sidebar ul {
            margin: 4rem auto;
            display: block;
            width: 80%;
            min-width:120px;
          }

          .sidebar a {
            display: block;
            font-size: 120%;
            color: #fff;
            text-decoration: none;
          }

          .sidebar a:hover{
            color:#fff;
            background-color: #f90;
            border-radius: 5px;
            padding-left: 5px;
          }

          .sidebar .menusel{
            color:#fff;
            background-color: #f90;
            border-radius: 5px;
            padding-left: 5px;
          }

          #contenido {
           margin-left: 150px;
          }

          #menuhorizontal {
            margin:0;
            padding:0;
            list-style-type:none; 
          }

          #menuhorizontal a {
            width:100px;
            text-decoration:none;
            text-align:center;
            color:#ff0000;
            background-color:#f7f8e8;
            padding:3px 5px;
            border-right:1px solid blue;
            display:block;
            width: 150px;
          }

          #menuhorizontal li {
            float:left;
          }

          #menuhorizontal a:hover {
            background-color:#336699;
            color:#fff;
          }

          #menuhorizontal .seleccionado {
            background-color:#336699;
            color:#fff;
          }

          .lineaSuperior{
            margin-top: 5px;
            border: 1px solid #000; 
            padding:1px; 
            background-color: black;
          }
      </style>
    </head>
    <body>
      
      <?php
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';
        
        $query = "Select * from articulos"; 
        $productos = mysqli_query($conexion, $query);
      ?>
      <div class='Container'>
        <div class='row'>
          <div class="col-12">
            <!-- Header -->
            <header class="d-flex flex-wrap py-3 mb-5 border-bottom">
              <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container">
                  <a class="navbar-brand" href="#">usuario:</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="menu.php">Cerrar</a>                    
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
            </header>
          </div>
        </div>
        <div class="row">
          <div class="col-1">
            <div id="sidebar" class="sidebar">
              <ul class="menu">
                <li><a href="pedidos.php?tipo=prep">Pedidos</a></li>
                <li><a href="articulos.php">Articulos</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a class="menusel" href="#">Reportes</a></li>
                <li><a href="#">Transporte</a></li>
              </ul>
            </div>
          </div>
          <div class="col-11">
            <div class="container-fluid">
              <div class="row"> 
                <div class="col-md">        
                  <div class="card bg-warning text-white">
                    <div class="card-body">
                      <h4 class="card-title">
                        <i class="bi bi-card-checklist"></i>
                        Reporte 1
                      </h4>
                      <p class="card-text" style="margin-left: 150px"></p>
                      <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                  </div>
                </div>

                <div class="col-md">        
                  <div class="card bg-warning text-white">
                    <div class="card-body">
                      <h4 class="card-title">
                        <i class="bi bi-binoculars"></i>
                        Reporte 2
                      </h4>
                      <p class="card-text"></p>
                      <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                  </div>          
                </div>
      
                <div class="col-md">        
                  <div class="card bg-warning text-white">
                    <div class="card-body">
                      <h4 class="card-title">
                        <i class="bi bi-send"></i>
                        Reporte 3
                      </h4>
                      <p class="card-text"></p>
                      <a href="#" class="btn btn-primary">Entrar</a>
                    </div>
                  </div>          
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
</html> 
