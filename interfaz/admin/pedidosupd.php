<!DOCTYPE html>
  <html>
    <head>
      <?php
         require ('../../helper/conexion.php');
         require ('../../helper/validar_usuario.php');
      ?>
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

          .sombra {
            text-shadow: 1px -2px 3px orange;
          }

          /* Fondo modal: negro con opacidad al 50% */
          .modal {
            display: none; /* Por defecto, estará oculto */
            position: fixed; /* Posición fija */
            z-index: 1; /* Se situará por encima de otros elementos de la página*/
            padding-top: 200px; /* El contenido estará situado a 200px de la parte superior */
            left: 0;
            top: 0;
            width: 100%; /* Ancho completo */
            height: 100%; /* Algura completa */
            overflow: auto; /* Se activará el scroll si es necesario */
            background-color: rgba(0,0,0,0.5); /* Color negro con opacidad del 50% */
          }

          .contenido-modal {
            position: relative; /* Relativo con respecto al contenedor -modal- */
            background-color: white;
            margin: auto; /* Centrada */
            padding: 20px;
            width: 60%;
            -webkit-animation-name: animarsuperior;
            -webkit-animation-duration: 0.5s;
            animation-name: animarsuperior;
            animation-duration: 0.5s;
          }
          /* Add Animation */
          @-webkit-keyframes animatetop {
            from {top:-300px; opacity:0} 
            to {top:0; opacity:1}
          }
          @keyframes animarsuperior {
            from {top:-300px; opacity:0}
            to {top:0; opacity:1}
          }

          /* The Modal (background) */
          .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
          }

          /* Modal Content/Box */
          .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            }
      </style>
    </head>
    <body>
      <!-- Ventana modal, por defecto no visiblel -->
      <div id="ModalPedidoOk" class="modal">
        <div class="contenido-modal">
          <p>Se actualizo el pedido correctamente.</p>
        </div>
      </div>
      <?php
        $actualizacion=false;
        if($_POST){
          $codigo = $_POST['codigo'];
          $qryUpdate = "update pedidoscab set estado_id = " . $_POST['estado'] . " where codigo = '" . $_POST['codigo'] . "'";
          $update = mysqli_query($conexion, $qryUpdate);
          
          $qrybulto = "select count(*) as total from bultos where codigo_pedido='". $codigo . "'";
          $count = mysqli_query($conexion, $qrybulto);
          $data=mysqli_fetch_assoc($count);
          
          if($data['total'] == 0){
            $insbulto = "insert into bultos values(default," . $_POST['id'] . ",'" . $codigo . "'," . $_POST['cantidad'] . "," . $_POST['peso'] . "," . $_POST['tamanio'] .")";
            $insert = mysqli_query($conexion, $insbulto) or die("Error en la insercion en la tabla de bulto " . mysqli_error($conexion));
          }else{
            $updbulto = "update bultos set cantidad=" . $_POST['cantidad'] . ", idpeso=" . $_POST['peso'] . ", idtamanio=" . $_POST['tamanio'] . " where idPedido=" . $_POST['id'];
            $update = mysqli_query($conexion, $updbulto) or die("Error en la actualizacion de la tabla de bulto " . mysqli_error($conexion));
          }
          $actualizacion=true;
        }

        if($_GET) {
          $codigo = $_GET['codigo'];
        }

        $query = "SELECT pc.id, pc.codigo, pc.fecha_entrega,
                      if(prioridad_urgente = 1,'Urgente','Normal') as prioridad, 
                      d.razon_social, u.nombre, e.descripcion, b.cantidad, b.idpeso,
                      b.idtamanio
                    FROM compostela.pedidoscab pc 
                      join estados e on pc.estado_id = e.id
                      join destinatarios d on pc.destinatario_id = d.id
                      join usuarios u on pc.usuario_id = u.id
                      left join bultos b on b.idpedido = pc.id
                    WHERE pc.codigo='". $codigo ."';";

        $pedido = mysqli_query($conexion, $query);
        $fila = mysqli_fetch_array($pedido);

        $selBulto = "SELECT * FROM bultos WHERE codigo_pedido = '" . $codigo . "'";
        $rsBulto = mysqli_query($conexion, $selBulto);
        $filaBulto = mysqli_fetch_array($rsBulto);
        
        $selpesos = "SELECT * FROM pesos";
        $rsPesos = mysqli_query($conexion, $selpesos);

        $seltamanios = "SELECT * FROM tamanios";
        $rsTamanio = mysqli_query($conexion, $seltamanios);

      ?>
      <div class='Container'>
        <div class='row'>
          <div class="col-12">
            <!-- Header -->
            <header class="d-flex flex-wrap py-3 mb-5 border-bottom">
              <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container">
                  <a class="navbar-brand" href="#"><?php $_SESSION['usuario'] ?></a>
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
                <li><a class="menusel" href="pedidos.php?tipo=prep">Pedidos</a></li>
                <li><a href="articulos.php">Articulos</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a href="transporte.php">Transporte</a></li>
                <li><a href="Reportes.php">Reportes</a></li>
              </ul>
            </div>
          </div>
          <div class="col-11">
            <div class="container-fluid">
              <div class="row">  
                <div class="lineaSuperior"></div>
              </div>
              <div class="row">
                <div>
                  <span class="sombra">Codigo:</span>
                    <?php echo $fila['codigo']; ?>
                </div> 
              <div>
              <div class="row">
                <div>
                  <span class="sombra">Prioridad:</span>
                  <?php echo $fila['prioridad']; ?> 
                </div>
              <div>
              <div class="row">
                <div>
                  <span class="sombra">Fecha entrega:</span>
                  <?php echo $fila['fecha_entrega']; ?> 
                </div>
              <div>
              <div class="row">
                <div>
                  <span class="sombra">Destinatario:</span>
                  <?php echo $fila['razon_social']; ?>
                </div> 
              <div>
              <div class="row">
                <div>
                  <span class="sombra">Usuario:</span>
                  <?php echo $fila['nombre']; ?>
                </div> 
              <div>
              <div class="row">  
                <div class="lineaSuperior"></div>
              </div>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="hidden" name='id' value="<?php echo $fila['id']; ?>">
                <input type="hidden" name='codigo' value="<?php echo $fila['codigo']; ?>">
                <div class="row">
                  <span class="sombra">Estado:</span>
                  <div>  
                    <input type="radio" name="estado" value="1" <?php if($fila['descripcion']=='Preparando'){echo 'checked';} ?>/> Preparando &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="estado" value="2" <?php if($fila['descripcion']=='Enviado'){echo 'checked';} ?>/> Enviado &nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="row">
                    <span class="sombra">Bultos:</span>
                    <label for="cantidad" class="form-label">Cantidad:</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php if(isset($filaBulto)){echo $filaBulto['cantidad'];} else{ echo '0';}?>">

                    <label for="peso" class="form-label">Peso:</label>
                    <select class="form-select mb-3" id="peso" name="peso"> 
                      <?php
                        foreach ($rsPesos as $p) { 
                      ?>
                        <option value="<?php echo $p['id'] ?>" <?php if($p['id']==$fila['idpeso']){echo 'selected';} ?> ><?php echo $p['descripcion'] ?></option>
                      <?php   
                        }
                      ?> 
                    </select>

                    <label for="tamanio" class="form-label">Tamaño:</label>
                    <select class="form-select mb-3" id="tamanio" name="tamanio"> 
                      <?php
                        foreach ($rsTamanio as $t) { 
                      ?>
                        <option value="<?php echo $t['id'] ?>" <?php if($t['id']==$fila['idtamanio']){echo 'selected';} ?> ><?php echo $t['descripcion'] ?></option>
                      <?php
                        }
                      ?> 
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <script language="javascript">
        <?php
          if($actualizacion){
            echo "let mimodal = document.getElementById('ModalPedidoOk');" ;
            echo "mimodal.style.display='block';" ;
            echo "setTimeout(function() {" ;
            echo "let mimodal = document.getElementById('ModalPedidoOk');" ;
            echo "mimodal.style.display='none';" ;
            echo "}, 2000); ";
        }
      ?>  
      </script>
    </body>
</html> 
