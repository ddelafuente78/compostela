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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="../../css/admin/articulos.css">


    </head>

    <body>
      <?php
        
        $query="";


        if ($_SERVER["REQUEST_METHOD"] === "POST") {
          if (isset($_POST['busqueda'])) {
            echo "Procesar el formulario de busqueda";
            $query = "SELECT * FROM articulos where nombre like '%" . $_POST['search'] . "%'";
          } else {
            $qryDelete = "UPDATE articulos SET fecha_baja=current_timestamp WHERE id=". $_POST["idborrar"]; 
            mysqli_query($conexion, $qryDelete);
            $query = "Select * from articulos";  
          }
        } else {
          $query = "Select * from articulos"; 
        }

        //echo $query;

        $productos = mysqli_query($conexion, $query) or die("Eliminar");
      ?>

      <div class='container-fluid'>
        <div class='row'>
          <div class="col-12">
            
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
                <li><a class="menusel" href="articulos.php">Articulos</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a href="transporte.php">Transporte</a></li>
                <li><a href="#">Reportes</a></li>
              </ul>
            </div>
          </div>
          <div class="col-11">
            <div class="container-fluid">
              <div class="topnav">
                <a href="articulonuevo.php">
                  <button id="nuevoArticulo" class="btn-primary">Nuevo articulo</button>
                </a>
                <div class="search-container">
                  <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <input type="text" placeholder="Search..." name="search">
                    <button name="busqueda" type="submit"><i class="fa fa-search"></i></button>
                  </form>
                </div>
              </div>
              <div class="lineaSuperior"></div>
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
