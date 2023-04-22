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
    <?php
      include '../../helper/conexion.php';
      include '../../helper/validar_usuario.php';
      include '../../modelo/clases.php';
      
      $destinatario = new destinatario();

      $destinatario->provincia="Santa Fe";

      if($_POST){
        
        $consulta = mysqli_query(
          $conexion,
            "select * from destinatarios where id=" . $_POST['destinatario'] . ";"
        );

        $destdb = mysqli_fetch_array($consulta);
        
        $destinatario->id = $destdb['id'];
        $destinatario->razon_social = $destdb['razon_social'];
        $destinatario->dni = $destdb['dni'];
        $destinatario->telefono = $destdb['numero_telefono'];
        $destinatario->direccion = $destdb['direccion'];
        $destinatario->cp = $destdb['codigo_postal'];
        $destinatario->provincia = $destdb['provincia'];
        
      }
      
      $consulta = mysqli_query(
        $conexion,
            "select id, razon_social from destinatarios;"
        );

        $destinatarios = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

    ?>
    <div class="container">
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
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="articulos.php">Articulos</a>                    
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="row">
        <div class="col-12">
          <h1 class="cssanimation effect3d" >Datos del destinatario...</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10">
          <div class="mb-3">
              <form class="custom-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="destinatario" class="form-label">Seleccione destinatario.</label>
                <select class="form-select mb-3" id="destinatario" name="destinatario" onchange='this.form.submit()'> 
                  <?php
                    foreach ($destinatarios as $dest) { 
                      if ($destinatario->id == $dest['id']) {
                  ?>
                        <option value="<?php echo $dest['id'] ?>" selected><?php echo $dest['razon_social'] ?> </option>
                  <?php
                      }else{
                  ?>
                        <option value="<?php echo $dest['id'] ?>"><?php echo $dest['razon_social'] ?> </option>
                  <?php
                      }
                    }
                  ?>
                </select>
              </form>        
          </div>
          <form action="../../modelo/crear_pedido.php" method="post">
            <div class="mb-3">
              <label for="nombre" class="form-label">Apellido y nombre / Razon social.</label>
              <?php 
                if($_POST){
              ?>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $destinatario->razon_social ?>"> 
              <?php
                  }else{
              ?>
                <input type="text" class="form-control" id="nombre" name="nombre">
              <?php
                }
              ?> 
            </div>
            
            <div class="mb-3">
              <label for="dni" class="form-label">DNI.</label>
              <?php 
                if($_POST){
              ?>
                  <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $destinatario->dni;?>">
              <?php
                }else{
              ?>
                <input type="text" class="form-control" id="dni" name="dni">
              <?php
                }
              ?>  
            </div>

            <div class="mb-3">
              <label for="telefono" class="form-label">Numero telefono.</label>
              <?php 
                if($_POST){
              ?>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $destinatario->telefono;?>">
              <?php
                } else {
              ?>
                <input type="text" class="form-control" id="telefono" name="telefono">
              <?php
                }
              ?>     
            </div>
            <div class="mb-3">
              <label for="direccion" class="form-label">Direccion (calle y nro).</label>
              <?php 
                if($_POST){
              ?>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $destinatario->direccion;?>">
              <?php
                } else {
              ?>
                <input type="text" class="form-control" id="direccion" name="direccion">
              <?php
                }
              ?>        
            </div>
            <div class="mb-3">
              <label for="cp" class="form-label">Codigo postal.</label>
              <?php 
                if($_POST){
              ?>
                <input type="text" class="form-control" id="cp" name="cp" value="<?php echo $destinatario->cp;?>">
              <?php
                } else {
              ?>
                <input type="text" class="form-control" id="cp" name="cp">
              <?php
                }
              ?>        
            </div>
            <div class="mb-3">
              <label for="provinicias" class="form-label">Provincias.</label>
              <?php 
                if($_POST){
              ?>
                <select class="form-select mb-3" id="provincias" name="provincias"> 
                  <option value='Santa Fe' <?php if($destinatario->provincia=="Santa Fe") {echo "Selected";} ?>>Santa Fe</option> 
                  <option value='Cordoba' <?php if($destinatario->provincia=="Cordoba") {echo "Selected";} ?>>Cordoba</option>
                  <option value='Mendoza' <?php if($destinatario->provincia=="Mendoza") {echo "Selected";} ?>>Mendoza</option> 
                  <option value='Buenos Aires' <?php if($destinatario->provincia=="Buenos Aires") {echo "Selected";} ?>>Buenos Aires</option> 
                  <option value='Neuquen' <?php if($destinatario->provincia=="Neuquen") {echo "Selected";} ?>>Neuquen</option> 
                </select>
              <?php
                } else {
              ?>
                <select class="form-select mb-3" id="provincias" name="provincias"> 
                  <option value='Santa Fe'>Santa Fe</option> 
                  <option value='Cordoba'>Cordoba</option>
                  <option value='Mendoza'>Mendoza</option> 
                  <option value='Buenos Aires'>Buenos Aires</option> 
                  <option value='Neuquen'>Neuquen</option> 
                </select>
              <?php
                }
              ?>        
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="normal" id="normal" name="prioridad" checked>
                <label class="form-check-label" for="normal">
                  Normal
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="urgente" id="urgente" name="prioridad">
                <label class="form-check-label" for="urgente">
                  Urgente
                </label>
            </div>
            <div class="mb-3">
              <label for="fecha" class="form-label">Fecha limite entrega.</label>
              <input type="Date" class="form-control" id="fecha" name="fecha" require>        
            </div>
            <div class="mb-3">
              <label for="fecha" class="form-label">Numero de pedido.</label>
              <input type="" class="form-control" id="nroasociado" name="nroasociado" require>        
            </div>
            <br>
            <button type="submit" class="btn btn-success">Finalizar</button>
          </form>
        </div>
        <div class="col-1">
        </div>
      </div> 
    </div>
  </body>
</html>