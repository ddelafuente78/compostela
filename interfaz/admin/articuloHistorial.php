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
      include '../../helper/usuarioValidar.php';
      include '../../modelo/movimientosStock.php';
      include '../../modelo/articulo.php';
      include 'barraNavegacionAdmin.php';

      $movimiento = new movimientoStock(null, null, $_GET["id"], null, null);
      $rsMovimientos = $movimiento->obtenerMovimientoStockporArticulo();
      $articulo = new articulo($_GET["id"],null,null,null,null,null,null);


    ?>
    <div class="lineaSuperior"></div>
    <h1> Articulo: <?php echo $articulo->obtenerNombreArticulo() ?> </h2> 
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th>Fecha-Hora</th>
            <th>Movimiento</th>  
            <th>Cantidad</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($rsMovimientos as $fila) { 
          ?>
          <tr>                    
            <td><?php echo $fila['fecha_hora']?></td>
            <td><?php echo $fila['descripcion']?></td>
            <td><?php echo $fila['cantidad']?></td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
    </div> 
  </body>
</html>