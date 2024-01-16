<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../../css/articuloss.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
  </head>
  <body class="cuerpo">
    
    <?php
      include '../../helper/conexion.php';
      include '../../helper/validar_usuario.php';
      include 'barraNavegacion.php';
      

      //si lo pide el usuario buscamos por nombre de articulo
      //sino mostramos todos.

      $busqueda = "select * from articulos where fecha_baja is null;";
      if($_POST){
        if( $_POST['buscado'] <> ""){
          $busqueda = "select * from articulos where nombre like '" . $_POST['buscado'] . "%' and fecha_baja is null;;";
        }
      }
    
      $registros = mysqli_query($conexion, $busqueda) or
                die("Problemas en el select:" . mysqli_error($conexion));
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
    while ($reg = mysqli_fetch_array($registros)) {
  ?>
  <div class="col-4">
    <div class="card">
      <!--<a href="artdet.php?id=<?php echo $reg['id'] ?>"> COMENTADO PARA NO INGRESAR A CREAR PEDIDO-->
        <img src='../../imagenes/productos/<?php echo $reg['foto1'] ?>' alt="">
      </a>
      <div class="contenidoCard">
        <h3 class="tituloCard"><?php echo $reg['nombre'] ?></h3>
        <p class="descripcionCard"><?php echo $reg['descripcion'] ?></p>
        <p class="stockCard"><?php echo $reg['stock'] ?> en stock.</p>
      </div>
    </div>
  </div>
  <?php
    }
    mysqli_close($conexion);
  ?>
</div>
  
  
  </body>
</html>
