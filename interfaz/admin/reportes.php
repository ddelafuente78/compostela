<!DOCTYPE html>
  <html>
    <head>
      <title>Administrador - compostela</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">-->
      <link rel="stylesheet" href="../../css/admin/reportes.css">
      <style>
        
      </style>
    </head>
    <body>
      
      <?php
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';
        include 'barraNavegacionAdmin.php';

        $query = "Select * from articulos"; 
        $productos = mysqli_query($conexion, $query);
      ?>

    <div class="contenedor2">
        <div class="tarjetas">
            <figure>
                <img src="images/java.jpg" alt="">
            </figure>
            <div class="contenido">
                <h3>Reporte 1</h3>
                    <a href="#">Ingresar</a>   
            </div>
        </div>
        <div class="tarjetas">
            <figure>
                <img src="images/java.jpg" alt="">
            </figure>
            <div class="contenido">
                <h3>Reporte 2</h3>
                    <a href="#">Ingresar</a>                
            </div>
        </div>
        <div class="tarjetas">
            <figure>
                <img src="images/java.jpg" alt="">
            </figure>
            <div class="contenido">
                <h3>Reporte 3</h3>
                    <a href="#">Ingresar</a>
                
            </div>
        </div>
        </div>
    </body>
</html> 
