<!DOCTYPE html>
  <?php 
    include '../../helper/conexion.php';
    include '../../helper/validar_usuario.php';
  ?>  
  <html>
    <head>
      <title>Administrador - compostela</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="../../css/admin/transporte.css">
    </head>
    <body> 
      <?php
      include 'barraNavegacionAdmin.php';


        if($_POST){
          $qryDelete = "DELETE FROM transportes WHERE id=". $_POST["idborrar"]; 
          mysqli_query($conexion, $qryDelete);
        }

        $qrySel = "Select * from transportes"; 
        $transportes = mysqli_query($conexion, $qrySel);
      ?>
      <div class='Container'>
        <div class='row'>
              <div class="row">
                <div class="topnav">
                  <a href="transportenuevo.php">
                    <button class="btnNuevoTransp">Nuevo transporte</button>
                  </a>
                </div>
                <div class="lineaSuperior"></div>
              </div>
              <div class="row">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($transportes as $fila) { 
                    ?>
                      <tr>
                        <td><?php echo $fila['nombre'] ?></td>
                        <td><?php echo $fila['direccion'] ?></td>
                        <td><?php echo $fila['telefono'] ?></td>

                        <td class="text-right">
                          <span title="Actualizar transporte">
                            <a class="btnAct" id="btactualizar<?php echo $fila['id'] ?>" role="button" 
                              href="transportemodificar.php?id=<?php echo $fila['id'] ?>" >
                              <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                          </span>
                          <span title="Borrar Transporte">
                            <a class="btnBorr" id="btnBorrar<?php echo $fila['id'] ?>" role="button" 
                              href="#" onClick="modalEliminacion(<?php echo $fila['id'] ?>);">
                              <i class="fa-solid fa-trash"></i>
                            </a>
                          </span>
                          <!--Modal para eliminacion -->
                          <div id="id<?php echo $fila['id'] ?>" class="modaldelete">
                            <span onclick="document.getElementById('id<?php echo $fila['id'] ?>').style.display='none'" class="cerrardelete" title="Cerrar">&times;</span>
                            <form id="frm<?php echo $fila['id'] ?>"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                              <div class="modalcontentdelete">
                                <input type="hidden" id="idborrar" name="idborrar" value="<?php echo $fila['id']?>">
                                <div class="containerdelete">
                                  <h1>Borrar transporte</h1>
                                  <p>Esta seguro de borrar el transporte <b> <?php echo $fila['nombre'] ?></b>?</p>
                                <div class="clearfix">
                                  <button type="button" class="boton cancelbtn" onclick="document.getElementById('id<?php echo $fila['id']?>').style.display='none'">Cancelar</button>
                                  <button type="button" class="boton deletebtn" onclick="document.forms['frm<?php echo $fila['id']?>'].submit();">Borrar</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        </td>
                        <?php
                          }
                        ?>
                      </tr>
                  </tbody>
                </table> 
              <div>
            
          </div>
        
          
      </div>
      <script>
          function modalEliminacion(idborrar){
            document.getElementById("id"+idborrar).style.display="block";
          }
      </script>
    </body>
</html> 
