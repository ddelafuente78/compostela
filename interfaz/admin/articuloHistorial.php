<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPOSTELA - HISTORIAL ARTICULO</title>
    <link rel="stylesheet" href="../../css/admin/articuloHistorial.css">
</head>
<body>
<?php
        include '../../modelo/conexion.php';
        include '../../helper/validarUsuario.php';
        include 'barraNavegacionAdmin.php';
  ?>

<div class="lineaSuperior"></div>
              <div class="row">
              <table class="table">
                  <thead>
                    <tr>
                      <th>Articulo</th>
                      <th>Fecha-Hora</th>
                      <th>Movimiento</th>  
                      <th>Cantidad</th>
                      <th>Stock Inicial</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Iphone 13</td>                      
                      <td>21/03/2024 - 10:00</td>
                      <td>Ajuste</td>
                      <td>20</td>
                      <td>1000</td>
                    </tr>
                    
                    

                  </tbody>
                </table> 

    
</body>
</html>