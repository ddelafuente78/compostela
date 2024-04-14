<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../../css/usuario/destinatarioPedido.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
    

  </head>

  <body class="cuerpo">
  <?php
            include '../../modelo/conexion.php';
            include '../../helper/usuarioValidar.php';
            include 'barraNavegacion.php';
           
        ?>
  <!--FORMULARIO DE-->             
  
  <div class="container" >
    <form autocomplete="off" action="">
        <div class="form">
            <label for="razonSoc">Razón Social:</label><br> 
            <div class="input">
                <input class="RS" id="razonSoc" type="text" name="razons" placeholder="Razón Social"> 
                <button id="btn-add" class="btn-add" type="button">+</button> <br>
            </div>
        </div>
        <div class="form" >   
            <label for="dni">DNI / CUIT:</label><br>
            <input id="dni" type="text" name= "dni" value="30266778" readonly onmousedown="return false;" /><br>
            <label for="te">Teléfono:</label><br>
            <input id="te" type="Text" name="tel" value="3493416651" readonly onmousedown="return false;" /><br>
            <label for="dire">Dirección:</label><br>
            <input id="dire" type="text" name="direccion" value="Victoria Ocampo 56" readonly onmousedown="return false;" /><br>
            <label for="CP">Código Postal:</label><br>
            <input id="CP" type="text" name= "codPost" value="2322" readonly onmousedown="return false;" /><br>
            <label for="prov">Código Postal:</label><br>
            <input id="prov" type="text" name="provincia" value="Santa Fe" readonly onmousedown="return false;" /><br>
            <div class="contiene-boton">
              <button id="btn-confirm" class="btn-enviar" type="submit">Continuar</button>
            </div>
        </div>
    </form>
  </div>

  <!-- The Modal -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <form action="">
        <div class="Contenedor-form-modal">
          <div class="tituloModal">
            Agregar nuevo destinatario
          </div>
          <div>
            <label for="razonSoc">Razón Social:</label><br> 
            <input class="RS" id="razonSoc" type="text" name="razons" placeholder="Razón Social"> 
            <label for="dni">DNI / CUIT:</label><br>
            <input id="dni" type="text" name= "dni"/><br>
            <label for="te">Teléfono:</label><br>
            <input id="te" type="Text" name="tel" /><br>
            <label for="dire">Dirección:</label><br>
            <input id="dire" type="text" /><br>
            <label for="CP">Código Postal:</label><br>
            <input id="CP" type="text" name= "codPost"/><br>
            <label for="prov">Código Postal:</label><br>
            <input id="prov" type="text" name="provincia"/><br>
            <div class="contiene-boton">
              <button id="btn-confirm_add" class="btn-enviar" type="submit">Agregar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="../../js/usuario/destinatarioPedido.js"></script>
</body> 
</html>
