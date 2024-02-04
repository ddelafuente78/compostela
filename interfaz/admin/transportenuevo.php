<!DOCTYPE html>
  <html>
    <head>
      <title>Administrador - compostela</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">-->
      <link rel="stylesheet" href="../../css/admin/transportenuevo.css">
    </head>
    <body>
      <!-- Ventana modal, por defecto no visiblel -->
      <div id="modalinsertarusuario" class="modal">
        <div class="contenido-modal">
          <p>Se inserto el transporte.</p>
        </div>
      </div>
      <?php
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';
        include '../../modelo/clases.php';
        include 'barraNavegacionAdmin.php';

        $insercion=false;
        if($_POST){
          $transporte = new transporte();
          
          $transporte->nombre=$_POST['nombre'];
          $transporte->direccion=$_POST['direccion'];
          $transporte->telefono=$_POST['telefono'];
          
          $insQuery = "INSERT INTO transportes VALUES(default,'" . $transporte->nombre . "','" . $transporte->direccion . "','" . $transporte-> telefono  . "');";
          echo $insQuery;
          mysqli_query($conexion, $insQuery);
          $insercion=true;
        }
      ?>
      <div class='container'>
        <div class="row">
          <div class="col-11">
            <div class='Container'>
              <h1 class="classH1">Nuevo transporte</h1>
              <div class="row">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                  <label class="classLbl"for="nombre">Nombre:</label>
                  <input type="text" id="nombre" name="nombre" placeholder="Sin nombre">
                  <label class="classLbl"for="direccion">direccion:</label>
                  <input type="text" id="direccion" name="direccion" placeholder="Sin direccion">
                  <label class="classLbl"for="telefono">telefono:</label>
                  <input type="text" id="telefono" name="telefono" placeholder="Sin telefono">
                  <input type="submit" id="cargar" name="cargar" value="cargar">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script language="javascript">
        <?php
          if($insercion){
            echo "let mimodal = document.getElementById('modalinsertarusuario');" ;
            echo "mimodal.style.display='block';" ;
            echo "setTimeout(function() {" ;
            echo "let mimodal = document.getElementById('modalinsertarusuario');" ;
            echo "mimodal.style.display='none';" ;
            echo "}, 2000); ";
          }
        ?>
        </script>
    </body>
</html> 
