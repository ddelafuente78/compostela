<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../../css/usuario/cambiarPass.css">
      <title>Cambio contrasenia - Puerto compostela</title>
  </head>
  <body>
      <?php 
        include 'barraNavegacion.php';
        include '../../helper/validarUsuario.php';
      ?>
      <h1>Cambiar contraseña</h1>
      <div class='conteiner'>
        
        <div class="contForm">
          <form action="../../helper/cambiarContrasenia.php" method="post">

            <input type="hidden" name="hdnID" value="<?php echo $_SESSION['id']?>">
          
            <label class="classLbl" for="nueva">Nueva contraseña:</label>
            <input type="password" id="nueva" name="nueva" placeholder="nueva contraseña">

            <label class="classLbl" for="confirmar">Confirmar Contraseña</label>
            <input type="password" id="confirmar" name="confirmar" placeholder="confirmar contraseña">

            <div id='passdiferentes'>
              <p>La nueva contraseña y su confirmacion son diferentes.</p>
            </div>

            <input type="submit" id="cargar" name="cargar" value="Guardar">
          </form>
        </div>
        
      </div>
      <script src='../../js/cambiarPass.js'></script>
  </body>
</html>

