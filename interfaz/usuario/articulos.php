<html>
  <head>
    <link rel="stylesheet" href="../../css/articulos.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">  
  </head>
  
  <body class="cuerpo">
    
    <?php
      include '../../helper/conexion.php';
      include '../../helper/validar_usuario.php';

      //si lo pide el usuario buscamos por nombre de articulo
      //sino mostramos todos.

      $busqueda = "select * from articulos where fecha_baja is null;";
      if($_POST){
        if( $_POST['buscado'] <> ""){
          $busqueda = "select * from articulos where nombre like '" . $_POST['buscado'] . "%' and fecha_baja is null;;";
        }
      }

      echo $busqueda;
    
      $registros = mysqli_query($conexion, $busqueda) or
                die("Problemas en el select:" . mysqli_error($conexion));

    ?> 
    <div class="container-fluid">
      
      <!-- Header -->
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
                  <a class="nav-link active" aria-current="page" href="menu.php">Menu</a>                    
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="carrito.php">Carrito</a>                    
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../../login.php">Cerrar</a>                    
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
    
    <div class="row">
      <div class="col-12">
        <form class="custom-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <div class="input-group w-50">
            <span class="input-group-text" id="basic-addon1">
              <button class='btn' type="submit"><i class="bi bi-search"></i></button>  
            </span>
            <input name="buscado" type="text" class="form-control" placeholder="buscar..." aria-label="Input group example" aria-describedby="basic-addon1">
          </div>  
        </form>
      </div>
    </div>  

    <div class="row">
      <div class="col-12">
        <div class="contenedor-cards">
          <?php
            while ($reg = mysqli_fetch_array($registros)) {
          ?>
          <div class="contenedor-card-item">
            <div class="contenedor-card-item-wrapper">
              <a href="artdet.php?id=<?php echo $reg['id']?>"><img src='../../imagenes/productos/<?php echo $reg['foto1'] ?>' alt=""></a>
              <div class="contenedor-info">
                <div class="info">
                  <p class="titulo"><?php echo $reg['nombre'] ?></p>
                  <span class="categoria"><?php echo $reg['descripcion'] ?></span>
                  <span class="categoria"><?php echo $reg['stock'] ?> en stock.</span>
                </div>
                <div class="fondo"></div>
              </div>
            </div>
          </div>
          <?php
            };
            mysqli_close($conexion); 
          ?>  
        </div>
      </div>
    </div>
    
  </body>
</html>
