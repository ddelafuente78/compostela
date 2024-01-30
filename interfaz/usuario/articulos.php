<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../../css/articulos.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
  </head>
  
  <body class="cuerpo">
    
    <?php
      include '../../helper/validar_usuario.php';
      include("../../modelo/articulo.php");
      include 'barraNavegacion.php';
      
      
      $articulo = new articulo();

      //si el usuario solicita filtro en el campo buscado filtramos
      //sino mostramos todos.
      if($_POST){
        if( $_POST['buscado'] <> ""){
          $listaArticulos = $articulo->obtenerArticulos(0 , $_POST['buscado']);
        } else {
          $listaArticulos = $articulo->obtenerArticulos(0);
        }
      } else {
        $listaArticulos = $articulo->obtenerArticulos(0);
      }
    ?> 

  <!--FORMULARIO DE-->              
  <div>
    <form class="formulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="containerBuscador">
          <input type="text" class="inputBuscar" name="buscado" placeholder="Search...">
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
     <!-- <a href="artdet.php?id=<?php echo $lineaArticulo['id'] ?>"> COMENTADO PARA NO INGRESAR A CREAR PEDIDO-->
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
        <a href="#" class="etiquetaPaginador" ><i class="fa-solid fa-backward"></i></a>
        <a href="#" class="etiquetaPaginador" id="numPag"> 1 </a>
        <a href="#" class="etiquetaPaginador" ><i class="fa-solid fa-forward"></i></a>
        <br>
        <br>
        <br>
        <br>
      <div>
  </body> 
</html>