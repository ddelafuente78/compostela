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

        input[type=text], input[type=file], input[type=number]{
          width:99%;
          padding: 12px 20px;
          margin: 8px 8px;
          display:inline-block;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
        }

        /* Style the submit button */
        input[type=submit] {
          width: 99%;
          background-color: #f90;
          color: white;
          padding: 14px 20px;
          margin: 8px 8px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        }
        
        /* Fondo modal: negro con opacidad al 50% */
        .modalActualizacion {
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

          .contenido-modal-actualizacion {
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
      </style>
    </head>
    <body>
      <!-- Ventana modal, por defecto no visiblel -->
      <div id="ModalTransporteOk" class="modalActualizacion">
        <div class="contenido-modal-actualizacion">
          <p>Se actualizo el trasporte.</p>
        </div>
      </div>
      
      <?php
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';
        include '../../modelo/clases.php';

        $transporte = new transporte();
        $actualizacion=false;
        if($_POST){

          $transporte->id=$_POST['idactualizar'];
          $transporte->nombre=$_POST['nombre'];
          $transporte->direccion=$_POST['direccion'];
          $transporte->telefono=$_POST["telefono"];

          $qryUpdate = "UPDATE transportes SET nombre='" . $transporte->nombre . "', direccion='" . $transporte->direccion . 
                        "', telefono='" . $transporte->telefono . "' where id=" . $transporte->id ;
          mysqli_query($conexion, $qryUpdate);
          $actualizacion=true;
        }
        if($_GET){
          $transporte->id=$_GET['id'];
        }

        $qrySelect = "SELECT * FROM transportes WHERE id=" . $transporte->id;
        $rsTransporte = mysqli_query($conexion, $qrySelect);
        $transporte = mysqli_fetch_array($rsTransporte);
      ?>
      <div class='Container'>
        <div class='row'>
          <div class="col-12">
            <!-- Header -->
            <header class="d-flex flex-wrap py-3 mb-5 border-bottom">
              <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container">
                  <a class="navbar-brand" href="#"><?php echo $_SESSION["usuario"] ?></a>
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
                <li><a href="pedidos.php?tipo=prep">Pedidos</a></li>
                <li><a href="articulos.php">Articulos</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a class="menusel" href="transporte.php">Transporte</a></li>
                <li><a href="reportes.php">Reportes</a></li>
              </ul>
            </div>
          </div>
          <div class="col-11">
            <div class='Container'>
              <h1>Modificar transporte</h1>
              <div class="row">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name='idactualizar' value='<?php echo $transporte['id'] ?>'>
                  <label for="nombre">Nombre:</label>
                  <input type="text" id="nombre" name="nombre" placeholder="Sin nombre"
                  value='<?php echo $transporte['nombre'] ?>'>
                  <label for="direccion">Direccion:</label>
                  <input type="text" id="direccion" name="direccion" placeholder="Sin direccion"
                  value='<?php echo $transporte['direccion'] ?>'>
                  <label for="telefono">Telefono:</label>
                  <input type="text" id="telefono" name="telefono" placeholder="Sin telefono"
                  value='<?php echo $transporte['telefono'] ?>'>
                  <input type="submit" id="modificar" name="modificar" value="Modificar">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script language='JavaScript'>
        <?php
          if($actualizacion){
            echo "let mimodal = document.getElementById('ModalTransporteOk');" ;
            echo "mimodal.style.display='block';" ;
            echo "setTimeout(function() {" ;
            echo "let mimodal = document.getElementById('ModalTransporteOk');" ;
            echo "mimodal.style.display='none';" ;
            echo "}, 2000); ";
          }
        ?>  
      </script>
    </body>
</html> 
