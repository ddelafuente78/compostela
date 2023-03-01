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
      </style>
    </head>
    <body>
      
      <?php
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';

        if($_GET) {
          switch($_GET['tipo']){
            case 'prep':
              $query = "SELECT pc.codigo, pc.fecha_entrega,
                          if(prioridad_urgente = 1,'Urgente','Normal') as prioridad, 
                          d.razon_social, u.nombre
                        FROM compostela.pedidoscab pc 
                          join estados e on pc.estado_id = e.id
                          join destinatarios d on pc.destinatario_id = d.id
                          join usuarios u on pc.usuario_id = u.id
                        Where estado_id = 1
                        ORDER BY prioridad_urgente desc, fecha_entrega;";
              break;
            case 'env':
              $query = "SELECT pc.codigo, pc.fecha_entrega,
                          if(prioridad_urgente = 1,'Urgente','Normal') as prioridad, 
                          d.razon_social, u.nombre
                        FROM compostela.pedidoscab pc 
                          join estados e on pc.estado_id = e.id
                          join destinatarios d on pc.destinatario_id = d.id
                          join usuarios u on pc.usuario_id = u.id
                        Where estado_id = 2
                        ORDER BY prioridad_urgente desc, fecha_entrega;";
              break;
              case 'entr':
                $query = "SELECT pc.codigo, pc.fecha_entrega,
                            if(prioridad_urgente = 1,'Urgente','Normal') as prioridad, 
                            d.razon_social, u.nombre
                          FROM compostela.pedidoscab pc 
                            join estados e on pc.estado_id = e.id
                            join destinatarios d on pc.destinatario_id = d.id
                            join usuarios u on pc.usuario_id = u.id
                          Where estado_id = 3
                          ORDER BY prioridad_urgente desc, fecha_entrega;";
                break;
              default:
                $query = "SELECT pc.codigo, pc.fecha_entrega,
                            if(prioridad_urgente = 1,'Urgente','Normal') as prioridad, 
                            d.razon_social, u.nombre
                          FROM compostela.pedidoscab pc 
                            join estados e on pc.estado_id = e.id
                            join destinatarios d on pc.destinatario_id = d.id
                            join usuarios u on pc.usuario_id = u.id;";
          }

        }
        
        $pedidosprearando = mysqli_query($conexion, $query);
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
                <li><a href="#">Transporte</a></li>
              </ul>
            </div>
          </div>
          <div class="col-11">
            <div class="container-fluid">
              <div class="row">
                <ul id="menuhorizontal">
                  <li><a <?php if($_GET['tipo']=='prep'){ echo 'class="seleccionado"';} ?> href="pedidos.php?tipo=prep">En preparacion</a></li>
                  <li><a <?php if($_GET['tipo']=='env'){ echo 'class="seleccionado"';} ?> href="pedidos.php?tipo=env">Enviado</a></li>
                  <li><a <?php if($_GET['tipo']=='entr'){ echo 'class="seleccionado"';} ?> href="pedidos.php?tipo=entr">Entregado</a></li>
                </ul>
              </div>
              <div class="row">
                <div class="lineaSuperior"></div>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Prioridad</th>
                      <th>Fecha entrega</th>  
                      <th>Destinatario</th>
                      <th>Usuario</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($pedidosprearando as $fila) { 
                    ?>
                      <tr>
                        <td><?php echo $fila['codigo'] ?></td>
                        <td><?php echo $fila['prioridad'] ?></td>
                        <td><?php echo $fila['fecha_entrega'] ?></td>
                        <td><?php echo $fila['razon_social'] ?></td>
                        <td><?php echo $fila['nombre'] ?></td>

                        <td class="text-right">
                          <span title="Actualizar pedido">
                            <a class="btn btn-outline-danger btn-sm botonborrar" id="btnActualizar<?php echo $fila['codigo'] ?>" role="button" 
                              href="pedidosupd.php?codigo=<?php echo $fila['codigo'] ?>">
                              <i class="bi bi-pencil-square"></i>
                            </a>
                          </span>
                        </td>
                        <td class="text-right">
                          <span title="ver detalle">
                            <a class="btn btn-outline-danger btn-sm botonborrar" id="btnBorrar<?php echo $fila['codigo'] ?>" role="button" 
                              href="pedidosdetalle.php?codigo=<?php echo $fila['codigo'] ?>">
                              <i class="bi bi-search"></i>
                            </a>
                          </sapn>
                        </td>
                        <?php
                          }
                        ?>
                      </tr>
                  </tbody>
                </table> 
              <div>
            </div>
          </div>
        </div>
      </div>
    </body>
</html> 
