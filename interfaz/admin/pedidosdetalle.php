<!DOCTYPE html>
  <html>
    <head>
      <?php
        require ('../../modelo/conexion.php');
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

.bulto {
margin-left: 30px;
}
.bulto span {
text-decoration: underline;
}

table {
border-collapse: collapse;
}

th  {
border-right: 1px solid #fff;
border-bottom: 1px solid #fff;
padding: 0.5em;
background-color:#ff9800;;
}
td {
border: 1px solid #000;
padding: .5em;
width:100px;
text-align:center;
}
tr:nth-child(odd) {
background-color:#c9c9c9;;
}

tr:nth-child(even) {
background-color:#dcdcdc;
}
      </style>
    </head>
    <body>
      <?php
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

        $qryDetalle = "SELECT cantidad, nombre, descripcion 
                        FROM pedidosdet pd 
                        JOIN articulos a on pd.articulo_id = a.id
                        WHERE pd.pedidoscab_codigo = '". $codigo . "'";
        $rsDetalle =  mysqli_query($conexion, $qryDetalle);

        $selBulto = "SELECT * FROM bultos WHERE codigo_pedido = '" . $codigo . "'";
        $rsBulto = mysqli_query($conexion, $selBulto);
        $filaBulto = mysqli_fetch_array($rsBulto);
        
        if(isset($filaBulto['idpeso'])){
          $selpesos = "SELECT * FROM pesos where id = " . $filaBulto['idpeso'];  
        }else{
          $selpesos = "SELECT * FROM pesos where id = 0"; 
        }
        $rsPesos = mysqli_query($conexion, $selpesos);
        $filapeso = mysqli_fetch_array($rsPesos);

        if(isset($filaBulto['idtamanio'])){
          $seltamanios = "SELECT * FROM tamanios where id = " . $filaBulto['idtamanio'];  
        }else{
          $seltamanios = "SELECT * FROM tamanios where id = 0";
        }
        $rsTamanio = mysqli_query($conexion, $seltamanios);
        $filatamanio = mysqli_fetch_array($rsTamanio);

      ?>
      <div class='Container'>
        <div class='row'>
          <div class="col-12">
            <!-- Header -->
            <header class="d-flex flex-wrap py-3 mb-5 border-bottom">
              <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container">
                  <a class="navbar-brand" href="#"><?php echo $_SESSION['usuario'] ?></a>
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
                    <?php echo $fila['id']; ?>
                    <a href='pedidosdetallepdf.php?codigo=<?php echo $codigo; ?>'>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style='color:red' class="bi bi-filetype-pdf " viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                      </svg>
                    </a>
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
                <div>  
                  <span class="sombra">Estado:</span>
                  <?php echo $fila['descripcion']; ?>
                </div>
              </div>

              <div class="row">  
                <div class="lineaSuperior"></div>
              </div>

              <span class="sombra">Bultos:</span>

              <div class="row">
                <div class='bulto'>
                  <span>Cantidad:</span>
                  <?php if(isset($filaBulto['cantidad'])){echo $filaBulto['cantidad'];} else {echo 'Sin especificar';} ?>
                  <span title="Caratulas">
                  <a href='caratulaspdf.php?codigo=<?php echo $codigo; ?>'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style='color:red' class="bi bi-filetype-pdf " viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                    </svg>
                  </a>
                </span>
                </div>
              </div>

              <div class="row">
                <div class='bulto'>
                  <span>Peso:</span>
                  <?php if(isset($filapeso['descripcion'])){echo $filapeso['descripcion'];}else{echo 'Sin especificar';} ?>
                </div>
              </div>

              <div class="row">
                <div class='bulto'>
                  <span>Tamaño:</span>
                  <?php if(isset($filatamanio['descripcion'])){echo $filatamanio['descripcion'];}else{echo 'Sin especificar';} ?>
                </div>
              </div>

              <div class="row">  
                <div class="lineaSuperior"></div>
              </div>

              <div style="padding-bottom:5px">
                  <span class="sombra">Detalle:</span>
              </div>

              <div class="row text-center">
                <div class="col-8">
                  <table style="width:100%">
                    <tr>
                      <th>nombre</th>
                      <th>descripcion</th>
                      <th>cantidad</th>
                    </tr>
                    <?php
                      foreach ($rsDetalle as $linea) { 
                    ?>
                    <tr>
                      <td>
                        <?php echo $linea['nombre']; ?>
                      </td>
                      <td>
                        <?php echo $linea['descripcion']; ?>
                      </td>
                      <td>
                        <?php echo $linea['cantidad']; ?>
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </table>
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
      
    </body>
</html> 
