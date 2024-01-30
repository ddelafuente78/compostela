<!DOCTYPE html>
  <html>
    <head>
      <title>Administrador - compostela</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">-->
      <link rel="stylesheet" href="../../css/pedidos.css">
      <?php
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';
        include "barraNavegacionAdmin.php";
        if($_GET) {
            switch($_GET['tipo']){
            case 'prep':
              $query = "SELECT pc.id, pc.codigo, pc.fecha_entrega,
                          if(prioridad_urgente = 1,'Urgente','Normal') as prioridad, 
                          d.razon_social, u.nombre
                        FROM pedidoscab pc 
                          join estados e on pc.estado_id = e.id
                          join destinatarios d on pc.destinatario_id = d.id
                          join usuarios u on pc.usuario_id = u.id
                        Where estado_id = 1
                        ORDER BY prioridad_urgente desc, fecha_entrega;";
              break;
            case 'env':
              $query = "SELECT pc.id, pc.codigo, pc.fecha_entrega,
                          if(prioridad_urgente = 1,'Urgente','Normal') as prioridad, 
                          d.razon_social, u.nombre
                        FROM pedidoscab pc 
                          join estados e on pc.estado_id = e.id
                          join destinatarios d on pc.destinatario_id = d.id
                          join usuarios u on pc.usuario_id = u.id
                        Where estado_id = 2
                        ORDER BY prioridad_urgente desc, fecha_entrega;";
              break;
              case 'entr':
                $query = "SELECT pc.id, pc.codigo, pc.fecha_entrega,
                            if(prioridad_urgente = 1,'Urgente','Normal') as prioridad, 
                            d.razon_social, u.nombre
                          FROM pedidoscab pc 
                            join estados e on pc.estado_id = e.id
                            join destinatarios d on pc.destinatario_id = d.id
                            join usuarios u on pc.usuario_id = u.id
                          Where estado_id = 3
                          ORDER BY prioridad_urgente desc, fecha_entrega;";
                break;
              default:
                $query = "SELECT pc.id, pc.codigo, pc.fecha_entrega,
                            if(prioridad_urgente = 1,'Urgente','Normal') as prioridad, 
                            d.razon_social, u.nombre
                          FROM pedidoscab pc 
                            join estados e on pc.estado_id = e.id
                            join destinatarios d on pc.destinatario_id = d.id
                            join usuarios u on pc.usuario_id = u.id;";
          }
        }
        
        $pedidosprearando = mysqli_query($conexion, $query);
      ?>
    </head>
    <body>
      <div class='container-fluid'>
        <div class='row'>
          <div class="col-12">
            <!-- Header -->
          </div>
        </div>

        <div class="row">
          <!--<div class="col-1">
            <div id="sidebar" class="sidebar">
              <ul class="menu">
                <li><a class="menusel" href="pedidos.php?tipo=prep">Pedidos</a></li>
                <li><a href="articulos.php">Articulos</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a href="transporte.php">Transporte</a></li>
                <li><a href="#">Reportes</a></li>
              </ul>
            </div>
          </div>-->
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
                <br>
                <div class="lineaSuperior"></div>
                <div class="conTabla">   
                  <table class="table">
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
                        <td><?php echo $fila['id'] ?></td>
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
                </div>
                
              <div>
            </div>
          </div>
        </div>
      </div>
    </body>
</html> 
