<?php
  include '../helper/conexion.php';
  include '../helper/validar_usuario.php';
  
  $productos_sin_stock = [];

  $destinatarios = mysqli_query($conexion, "select id from destinatarios where dni= '" . $_POST['dni'] . "'" ) or
                die("Problemas en el select:" . mysqli_error($conexion));

  $numrows = mysqli_num_rows($destinatarios);

  //buscar el destinatario, sino existe se inserta.
  //Pendientee: si existe actualizar con los datos cargados
  if($numrows==0){
    $insertresult = mysqli_query($conexion, "insert into destinatarios values (default,'" . $_POST['nombre'] . "','" . $_POST['dni'] . "','" . $_POST['telefono'] . 
                                 "','" . $_POST['direccion'] . "','". $_POST['cp'] . "','" . $_POST['provincias'] . "')") 
          or die("Problemas en el select:" . mysqli_error($conexion));
    $resultId = array("id" => mysqli_insert_id($conexion));
  }else{
    $result =  mysqli_fetch_array($destinatarios);
    $destinatarioId = $result['id'];
  }

  //Obteniene todos los productos del carrito.
  $registros = mysqli_query($conexion, "select * from carrito where nro_pedido='". $_SESSION['nropedido']."'") or
                die("Problemas en el select from carrito:" . mysqli_error($conexion));

  //insertar la cabecera del pedido
  if($_POST['prioridad']=='normal'){
    $prioridad=0;
  }else{
    $prioridad=1;
  }
  
  $insertaPedidoCabecera = mysqli_query($conexion, "insert into pedidoscab values(default,'" . $_SESSION['nropedido'] . "',1,'" . $_POST['fecha'] . "'"
  . ",". $prioridad ."," . $destinatarioId . "," . $_SESSION["id"] . ", now() , " . $_POST['nroasociado']  . ");") or 
  die("Problemas en el insert cuando pasamos del carrito a pedidos:" . mysqli_error($conexion));

  $idpedido = mysqli_insert_id($conexion);
  //insertar el detalle del pedido.
  while ($reg = mysqli_fetch_array($registros)) {

      if(controlarStock($conexion, $reg['articulos_id'], $reg['cantidad'] )){
        
        mysqli_query($conexion, "insert into pedidosdet values(default,'" . $reg['articulos_id'] . "','". $_SESSION['nropedido'] . 
                        "',". $reg['cantidad'] . "," . $idpedido . ");" ) or 
                        die("Problemas en el insert cuando pasamos del carrito a pedidos:" . mysqli_error($conexion));
        
        mysqli_query($conexion, "update articulos set stock = stock - " . $reg['cantidad'] . " where id = " . $reg['articulos_id'])
                      or die("Problemas en el update cuando actualizamos el stock:" . mysqli_error($conexion));
      }
  }
  
  $insertaPedido = mysqli_query($conexion, "delete from carrito where nro_pedido = '" . $_SESSION['nropedido'] . "'") 
      or die("Problemas en el delete en el carrito:" . mysqli_error($conexion));
  
  mysqli_close($conexion);

  function controlarStock($conexion, $articuloid, $cantidadpedido){
    global $productos_sin_stock;
    $articulo = mysqli_query($conexion, "select * from articulos where id=". $articuloid);
    $articuloresult =  mysqli_fetch_array($articulo);
    if($articuloresult['stock'] < $cantidadpedido){
      $productos_sin_stock[] = $articuloresult['nombre'];
      return false;
    }else{
      return true;
    }
  }

?>
<html>
  <head>
    <link rel="stylesheet" href="../css/carrito.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </style> 
  </head>
  <body>
    <div class="container-flex">
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
                    <a class="nav-link active" aria-current="page" href="../interfaz/usuario/menu.php">Menu</a>                    
                  </li>
                </ul>
              </div>
            </div>
        </nav>
      </header>
      <?php
        foreach ($productos_sin_stock as $posicion => $nombre) {
      ?>
          <div class="row bg-warning" style="padding:25px 50px;">
            <div class="col-12">
              El producto <?php echo $nombre ?> solicitado, ya no tiene disponiblidad en stock. !!!
            </div>
          </div>
      <?php
       }
      ?>
      <div class="row bg-info" style="padding:25px 50px;">
        <div class="col-12">
            Fin de la confirmacion de pedido. El pedido se confirmo con los productos con stock ok.
        </div>
      </div>
    </div>
  </body>
<html>