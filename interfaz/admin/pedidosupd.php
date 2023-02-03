<!DOCTYPE html>
  <html>
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
      </style>
    </head>
    <body>
      
      <?php
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';

        if($_POST){
          $codigo = $_POST['codigo'];
          $qryUpdate = "update pedidoscab set estado_id = " . $_POST['estado'] . " where codigo = '" . $_POST['codigo'] . "'";
          $update = mysqli_query($conexion, $qryUpdate);
          
          $qrybulto = "select count(*) as total from bultos where codigo_pago='". $codigo . "'";
          $count = mysqli_query($conexion, $qrybulto);
          $data=mysql_fetch_assoc($count);
          
          if($data['total'] == 0){
            $insbulto = "insert into bultos values(default," . $POST['id'] . ",'" . $codigo . "'," . $POST['cantidad'] . "," . $POST['peso'] . "," . $POST['tamanio'] .")";
            $insert = mysqli_query($conexion, $insbulto);
          }else{
            $updbulto = "update bultos set cantidad=" . $POST['cantidad'] . ", peso=" . $POST['peso'] . ", tamanio='" . $POST['tamanio'] . " where id=" . $POST['id'];
            $update = mysqli_query($conexion, $updbulto);
          }
          
        }

        if($_GET) {
          $codigo = $_GET['codigo'];
        }

        $query = "SELECT pc.id, pc.codigo, pc.fecha_entrega,
                      if(prioridad_urgente = 1,'Urgente','Normal') as prioridad, 
                      d.razon_social, u.nombre, e.descripcion
                    FROM compostela.pedidoscab pc 
                      join estados e on pc.estado_id = e.id
                      join destinatarios d on pc.destinatario_id = d.id
                      join usuarios u on pc.usuario_id = u.id
                      left join bultos b on b.idpago = pc.id
                    where pc.codigo='". $codigo ."';";

        $pedido = mysqli_query($conexion, $query);
        $fila = mysqli_fetch_array($pedido);
        
        
      ?>
      <div class='Container'>
        <div class='row'>
          <div class="col-12">
            <!-- Header -->
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
                        <a class="nav-link active" aria-current="page" href="menu.php">Cerrar</a>                    
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
                <li><a href="Reportes.php">Reportes</a></li>
                <li><a href="#">Opcion 5</a></li>
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
                    <input type="radio" name="estado" value="3" <?php if($fila['descripcion']=='Entregado'){echo 'checked';} ?>/> Entregado
                  </div>
                  <div class="row">
                    <span class="sombra">Bultos:</span>
                    <label for="cantidad" class="form-label">Cantidad:</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad">
                    <label for="peso" class="form-label">Peso:</label>
                    <input type="number" step="any" class="form-control" id="peso" name="peso">
                    <label for="tamanio" class="form-label">Tamaño:</label>
                    <input type="number" step="any" class="form-control" id="tamanio" name="tamanio">
                  </div>
                </div>
                <br/>
                <button type="submit" class="btn btn-success">Actualizar</button>
                <span style='font-size: xx-large;'><i class="bi bi-check-square"></i></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </body>
</html> 
