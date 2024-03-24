<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../../css/usuario/articulos.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
  </head>
  
  <body class="cuerpo">
    
    <?php
      include '../../helper/usuarioValidar.php';
      include("../../modelo/articulo.php");
      include 'barraNavegacion.php';
      
      $articulo = new articulo();
      $pagina = 1;

      if(!isset($_SESSION['buscado'])) {
        $_SESSION['buscado'] = "";
      }

      if ($_GET){
        $pagina = $_GET["pag"]; 
      }

      if($_POST) {
        $_SESSION['buscado'] = $_POST['buscado'];
      }

      $listaArticulos = $articulo->obtenerArticulos($pagina, $_SESSION['buscado']);
      $cantidadPaginas = $articulo->cantidadPaginas($pagina, $_SESSION['buscado']);

    ?>  

  <!--FORMULARIO DE-->             
  <div>
    <form class="formulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="containerBuscador">
          <input type="text" class="inputBuscar" name="buscado" placeholder="Search..." value="<?php echo $_SESSION['buscado']; ?>">
          <button class="btnBuscar" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
      </form>
  </div>
  <!--CARDS PRODUCTOS-->  
  <div class="row">
  <?php
    while ($lineaArticulo = mysqli_fetch_array($listaArticulos)) {
  ?>
  <div class="col-4">
    <div class="card">
     <a href="articulosDetalles.php?id=<?php echo $lineaArticulo['id'] ?>">
        <img src='../../imagenes/productos/<?php echo $lineaArticulo['foto1'] ?>' alt="">
      </a>
      <div class="contenidoCard">
        <h3 class="tituloCard"><?php echo $lineaArticulo['nombre'] ?></h3>
        <p class="descripcionCard"><?php echo $lineaArticulo['descripcion'] ?></p>
        <p class="stockCard"><?php echo $lineaArticulo['stock'] ?> en stock.</p>
      </div>
    </div>
  </div>
  <?php
    }
  ?>
</div>
<!--PAGINADOR-->
      <div class="paginador">
        <a href="articulos.php?pag=<?php echo $pagina==1 ? 1 : ($pagina - 1) ?>" class="etiquetaPaginador" ><i class="fa-solid fa-backward"></i></a>
        <a href="#" class="etiquetaPaginador" id="numPag"> <?php echo $pagina ?> </a>
        <a href="articulos.php?pag=<?php echo $cantidadPaginas==$pagina ? $pagina :  $pagina + 1 ?>" class="etiquetaPaginador" ><i class="fa-solid fa-forward"></i></a>
        <br>
        <br>
        <br>
        <br>
      <div>
  </body> 
</html>