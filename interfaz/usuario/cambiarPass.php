<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/cambiarContrasenia.css">
    <title>Document</title>
</head>
<body>
    <?php 
    include 'barraNavegacion.php';
    ?>
    <h1>Cambiar Contraseña</h1>
        <div class='conteiner'>
          
          <div class="contForm">
            <form action="" method="post" enctype="">
              <label class="classLbl" for="contrasenia">Contraseña Actual:</label>
              <input type="text" id="contrasenia" name="contrasenia" placeholder="Contraseña">
            
              <label class="classLbl" for="nueva">Nueva Contraseña:</label>
              <input type="text" id="nueva" name="nueva" placeholder="nueva contraseña">

              <label class="classLbl" for="confirmar">Confirmar Contraseña</label>
              <input type="text" id="confirmar" name="confirmar" placeholder="confirmar contraseña">

              <input type="submit" id="cargar" name="cargar" value="Guardar">
            </form>
          </div>
        </div 


</body>
</html>

