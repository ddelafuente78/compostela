<html>
    <head>
      <link rel="stylesheet" href="../../css/carrito.css">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
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
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';

        $masdediez = false;
        if($_POST){
          $qryselcant = "SELECT count(*) as total FROM carrito where nro_pedido = '" . $_SESSION['nropedido'] . "';";
          $cantidadCarrito = mysqli_query($conexion, $qryselcant);
          
          $RegCount = mysqli_fetch_array($cantidadCarrito);

          if($RegCount['total'] <= 10){
            $qryins = "insert into carrito values (default, 1," . $_POST['id_articulo'] . ", " 
                      . $_POST['cantidad'] . ", default , '". $_SESSION['nropedido'] . "')";
            mysqli_query($conexion,$qryins);
          }else{
            $masdediez = true;
          }
        }
      
        $qryselcarrito = mysqli_query($conexion, "select ca.id, ca.cantidad, ca.fecha_hora, ca.nro_pedido, ar.descripcion 
                            from carrito ca join articulos ar on ca.articulos_id = ar.id  
                            where ca.nro_pedido='" . $_SESSION['nropedido'] . "' order by fecha_hora;"
          ) or die(mysqli_error($conexion));

        $filas = mysqli_fetch_all($qryselcarrito, MYSQLI_ASSOC);
      ?>

      <!-- Header -->
      <!--<header class="d-flex flex-wrap py-3 mb-5 border-bottom">
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
                    <a class="nav-link active" aria-current="page" href="articulos.php">Articulos</a>                    
                  </li>
                </ul>
              </div>
            </div>
        </nav>
      </header>-->

      <?php
        include "barraNavegacion.php";
      ?>
      <div class="contTitulo"><h1 class="titulo">Detalle de pedido</h1></div>
        <div class="contNroPedido">Nro:<span><?php echo $_SESSION['id']?></span></div>  
          <div class="contenedorTabla">
            <table class="tabla">
              <thead>
                <tr>
                  <th>Articulo</th>
                  <th>Cantidad</th>
                  <th>Fecha/hora</th>
                  <th>Borrar</th>
                </tr>
              </thead>
        <tbody>
          <?php
            foreach ($filas as $fila) { 
          ?>
            <tr>
              <td><?php echo $fila['descripcion'] ?></td>
              <td><?php echo $fila['cantidad'] ?></td>
              <td><?php echo $fila['fecha_hora'] ?></td>
              <td class="text-right">
                  <a class="btn btn-outline-danger btn-sm botonborrar" id="btnBorrar<?php echo $fila['id'] ?>" role="button" href="#" 
                    onClick="getButtontoOpen(<?php echo $fila['id'] ?>)"><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr> 
            <!-- The Modal -->
            <div id="myModal<?php echo $fila['id'] ?>" class="modal">
              <!-- Modal content -->
              <div  class="modal-content">
                <div class="modal-header">
                  <span class="close" onclick="cerrarModal(<?php echo $fila['id'] ?>)">&times;</span>
                  <h2>Borrar articulo.</h2>
                </div>
                <div class="modal-body">
                  <p>
                    borrar el producto: 
                    <span style='text-decoration: underline red;'> <?php echo $fila['descripcion'] ?> X <?php echo $fila['cantidad'] ?> unidades</span>
                  </p>
                  <p>
                    <button style="display: block; width:100%;" class='btn btn-danger'>
                      <a  style="text-decoration:none; color:white;" href='../../modelo/borracarrito.php?id=<?php echo $fila['id'] ?>'>
                        Confirmo borrado...
                      </a>
                    </button>
                  <p>
                </div>
                <div class="modal-footer">
                  <h3> </h3>
                </div>
              </div>
          </div>
          <?php
          }
          ?>
        </tbody>
      </table>
    
        </div>
        
    </div>
    <div class="contBtnConfirmar">
    <a href="datos_destino.php"><button type="button" id="btnconfirmarpedido" class="btnConfirmar">Confirmar pedido</button></a>
    </div>
      <?php
        if($masdediez){
      ?>
        <div style='margin-top:20px; text-align:center' class="alert alert-danger" role="alert">
          <div style='margin:0px auto;'>
            No se puede cargar mas productos.!!!
          </div>
        </div>
      <?php
        }
      ?>
    
    <script src="../../js/modal.js"></script>

  </body>
</html>