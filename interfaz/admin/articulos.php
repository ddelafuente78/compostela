<!DOCTYPE html>
  <html>
  <?php
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';
  ?>
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

          span img {
            border: 1px solid #ddd; /* Gray border */
            border-radius: 4px;  /* Rounded border */
            padding: 5px; /* Some padding */
            width: 150px; /* Set a small width */
            height: 50%; /* Set a small width */
          }

          span img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
          }

          .imagengrande{
            display:none; 
            position:absolute; 
            z-index: 1;
            width:1%;
          }

          .imagenchica:hover {opacity: 0.7;}

          .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
          }

          .contenido-modal {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
          }

          .caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
          }

          .contenido-modal, .caption {
            animation-name: anima;
            animation-duration: 0.6s;
          }

          @keyframes anima {
            from {transform:scale(0)}
            to {transform:scale(1)}
          }

          .close {
            position: absolute;
            top: 40px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
          }

          .close:hover,
          .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
          }

          /* 100% Image Width on Smaller Screens */
          @media only screen and (max-width: 700px){
            .contenido-modal {
              width: 100%;
            }
          }

          * {box-sizing: border-box}

          /* Set a style for all buttons */
          .boton {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
          }

          .boton:hover {
            opacity:1;
          }

           /* Float cancel and delete buttons and add an equal width */
          .cancelbtn, .deletebtn {
            float: left;
            width: 50%;
          }

          /* Add a color to the cancel button */
          .cancelbtn {
            background-color: #ccc;
            color: black;
          }

          /* Add a color to the delete button */
          .deletebtn {
            background-color: #f44336;
          }

          /* Add padding and center-align text to the container */
          .containerdelete {
            padding: 16px;
            text-align: center;
          }

          /* The Modal (background) */
          .modaldelete {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: #474e5d;
            padding-top: 50px;
          }

          /* Modal Content/Box */
          .modalcontentdelete {
            background-color: #fefefe;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
          }

          /* Style the horizontal ruler */
          hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
          }

          /* The Modal Close Button (x) */
          .cerrardelete {
            position: absolute;
            right: 35px;
            top: 35px;
            font-size: 40px;
            font-weight: bold;
            color: #f1f1f1;
          }

          .cerrardelete:hover,
          .cerrardelete:focus {
            color: #f44336;
            cursor: pointer;
          }

        /* Clear floats */
        .clearfix::after {
          content: "";
          clear: both;
          display: table;
        }

        /* Change styles for cancel button and delete button on extra small screens */
        @media screen and (max-width: 300px) {
          .cancelbtn, .deletebtn {
            width: 100%;
          }
        }
      </style>
    </head>
    <body>
      <?php

        if($_POST){
          $qryDelete = "UPDATE articulos SET fecha_baja=current_timestamp WHERE id=". $_POST["idborrar"]; 
          mysqli_query($conexion, $qryDelete);
        }
        
        $query = "Select * from articulos"; 
        $productos = mysqli_query($conexion, $query) or die("Elimina");
      ?>
      <div class='Container'>
        <div class='row'>
          <div class="col-12">
            <!-- Header -->
            <header class="d-flex flex-wrap py-3 mb-5 border-bottom">
              <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container">
                  <a class="navbar-brand" href="#"><?php echo $_SESSION["usuario"] ?></a>
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
          </div>
        </div>
        <div class="row">
          <div class="col-1">
            <div id="sidebar" class="sidebar">
              <ul class="menu">
                <li><a href="pedidos.php?tipo=prep">Pedidos</a></li>
                <li><a class="menusel" href="#">Articulos</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a href="transporte.php">Transporte</a></li>
                <li><a href="reportes.php">Reportes</a></li>                
              </ul>
            </div>
          </div>
          <div class="col-11">
            <div class="container-fluid">
              <div class="row">
                <div class="col-2">
                  <a href="articulonuevo.php">
                    <button class="btn-primary">Nuevo articulo</button>
                  </a>
                </div>
                <div class="lineaSuperior"></div>
              </div>
              <div class="row">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Foto 1</th>  
                      <th>Foto 2</th>
                      <th>Stock minimo</th>
                      <th>Stock</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $IDfoto = 0;
                      foreach ($productos as $fila) { 
                    ?>
                      <tr>
                        <td><?php echo $fila['nombre'] ?></td>
                        <td><?php echo $fila['descripcion'] ?></td>
                        <td>
                          <span title="<?php echo $fila['foto1']?>">
                            <img class="imagenchica" src="../../imagenes/productos/<?php echo $fila['foto1']?>" onclick="mostrar(<?php echo $IDfoto?>,'<?php echo $fila['descripcion']?>');" />
                          </span>
                          <!-- Modal para la imagen -->
                          <div id="imgModal<?php echo $IDfoto?>" class="modal">

                            <!-- Boton cerrar -->
                            <span class="close" onclick="document.getElementById('imgModal<?php echo $IDfoto?>').style.display='none'">&times;</span>

                            <!-- Contenido del modal (imagen) -->
                            <img class="contenido-modal" id="img<?php echo $IDfoto?>"
                              src="../../imagenes/productos/<?php echo $fila['foto1']?>"/>

                            <!--Caption del modal (texto) -->
                            <div class='caption' id="caption<?php echo $IDfoto++?>"></div>
                          </div>
                        </td>
                        <td>
                          <span title="<?php echo $fila['foto2']?>">
                            <img class="imagenchica" src="../../imagenes/productos/<?php echo $fila['foto2']?>" onclick="mostrar(<?php echo $IDfoto?>,'<?php echo $fila['descripcion']?>');"/>
                          </span>
                          <!-- Modal para la imagen -->
                          <div id="imgModal<?php echo $IDfoto?>" class="modal">

                            <!-- Boton cerrar -->
                            <span class="close" onclick="document.getElementById('imgModal<?php echo $IDfoto?>').style.display='none'">&times;</span>

                            <!-- Contenido del modal (imagen) -->
                            <img class="contenido-modal" id="img<?php echo $IDfoto?>"
                            src="../../imagenes/productos/<?php echo $fila['foto2']?>"/>

                            <!--Caption del modal (texto) -->
                            <div class='caption' id="caption<?php echo $IDfoto++?>"></div>
                          </div>
                        </td>
                        <td><?php echo $fila['stock'] ?></td>
                        <td><?php echo $fila['stock_minimo'] ?></td>
                        
                        <td style="color:red">
                          <?php if($fila['fecha_baja']!=null)  {
          
                          ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentcolor" class="bi bi-x-square" viewBox="0 0 16 16">
                              <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                          
                          <?php
                            }
                          ?>
                          
                        </td>

                        <td class="text-right">
                          <span title="Actualizar articulo">
                            <a class="btn btn-outline-danger btn-sm" id="btnactualizar<?php echo $fila['id'] ?>" role="button" 
                              href="articulomodificar.php?id=<?php echo $fila['id'] ?>">
                              <i class="bi bi-pencil-square"></i>
                            </a>
                          </span>
                          <span title="Borrar articulo">
                            <a class="btn btn-outline-danger btn-sm" id="btnBorrar<?php echo $fila['id'] ?>" role="button" 
                              href="#" onClick="modalEliminacion(<?php echo $fila['id'] ?>);">
                              <i class="bi bi-trash3"></i>
                            </a>
                          </span>
                        </td>

                        <!--Modal para eliminacion -->
                        <div id="id<?php echo $fila['id'] ?>" class="modaldelete">
                          <span onclick="document.getElementById('id<?php echo $fila['id'] ?>').style.display='none'" class="cerrardelete" title="Cerrar">&times;</span>
                          <form id="frm<?php echo $fila['id'] ?>"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <div class="modalcontentdelete">
                              <input type="hidden" id="idborrar" name="idborrar" value="<?php echo $fila['id']?>">
                              <div class="containerdelete">
                                <h1>Borrar articulo</h1>
                                <p>Esta seguro de borrar el articulo <b> <?php echo $fila['descripcion'] ?></b>?</p>
                                <div class="clearfix">
                                  <button type="button" class="boton cancelbtn" onclick="document.getElementById('id<?php echo $fila['id']?>').style.display='none'">Cancelar</button>
                                  <button type="button" class="boton deletebtn" onclick="document.forms['frm<?php echo $fila['id']?>'].submit();">Borrar</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <?php
                          }
                        ?>
                      </tr>
                  </tbody>
                </table> 
              <div>
            </div>
          </div>
        </div>
      </div>
      <script>
          function mostrar(nro,texto){
            
            //asgino el texto al caption
            document.getElementById("caption" + nro).innerHTML = texto;
            // hago visible el modal
            document.getElementById("imgModal" + nro).style.display="block";

          };

          function ocultar(elemento){
            document.getElementById(elemento).style.display="none";
          }

          function modalEliminacion(idborrar){
            document.getElementById("id"+idborrar).style.display="block";
          }
      </script>
    </body>
</html> 
