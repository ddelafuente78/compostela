<html>
    <head>
      <link rel="stylesheet" href="../../css/carrito.css">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <style>
         .cssanimation, .cssanimation span {
            animation-duration: 1s;
            animation-fill-mode: both;
          }

          .cssanimation span { display: inline-block }
          .infinite { animation-iteration-count: infinite !important }
          .effect3d { animation-name: effect3d }
          @keyframes effect3d {
          to {
            text-shadow: 0 1px 0 #ccc, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 0 5px 0 #aaa, 
            0 6px 1px rgba(0, 0, 0, .1), 0 0 5px rgba(0, 0, 0, .1), 0 1px 3px rgba(0, 0, 0, .3), 0 3px 5px rgba(0, 0, 0, .2), 
            0 5px 10px rgba(0, 0, 0, .25), 0 10px 10px rgba(0, 0, 0, .2), 0 20px 20px rgba(0, 0, 0, .15)
          }
        }
        </style>
    </head>
  <body>
    <div class="container">
      <?php
        include '../../modelo/conexion.php';
        include '../../helper/validar_usuario.php';
      
        $consulta = mysqli_query(
          $conexion,
            "SELECT distinct nro_pedido FROM carrito;"
        ) or die(mysqli_error($conexion));

      $filas = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

      ?>
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
                </ul>
              </div>
            </div>
        </nav>
      </header>
      <h1 class="cssanimation effect3d">Pedidos pendientes</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th></th>
            <th>Nro pedido</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 1;
            foreach ($filas as $fila) { 
          ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><a href="ircarrito.php?nro=<?php echo $fila['nro_pedido']; ?>" style="text-decoration:none"><?php echo $fila['nro_pedido']; ?><a></td>
              <td></td>
            </tr> 
            <?php
            }
          ?>
        </tbody>
      </table>
    </body>
</html>