<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../../css/usuario/destinatarioPedido.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
    <title></title>

  </head>

  <body class="cuerpo">
  <?php
            include '../../modelo/conexion.php';
            include '../../helper/usuarioValidar.php';
            include 'barraNavegacion.php';
        ?>
  <!--FORMULARIO DE-->             
  <header id="cabecera">
    <div id="usuario">
      <span>Mauricio</span>
    </div>
    <div class="seccion">
      <span>Destinatario</span>
    </div>
  </header>
  <div class="container" >
    <form autocomplete="off" action="">
        <div class="form">
        <label for="razonSoc">Razón Social:</label><br> 
          <div class="input">
            <input class="campo-form" id="razonSoc" type="text" name="razons" placeholder="Razón Social"> 
            <button id="btn-add" class="btn-add" type="button">+</button> <br>
          </div>
        </div>
        <div class="form">   
          <label for="dni">DNI / CUIT:</label><br>
          <input class="campo-form" id="dni" type="text" name= "dni" value="30266778" readonly onmousedown="return false;" /><br>
          <label for="te">Teléfono:</label><br>
          <input class="campo-form" id="te" type="Text" name="te" value="3493416651" readonly onmousedown="return false;" /><br>
          <label for="dire">Dirección:</label><br>
          <input class="campo-form" id="dire" type="text" name="dire" value="Victoria Ocampo 56" readonly onmousedown="return false;" /><br>
          <label for="CP">Código Postal:</label><br>
          <input class="campo-form" id="CP" type="text" name= "codPost" value="2322" readonly onmousedown="return false;" /><br>
          <label for="prov">Provincia:</label><br>
          <input class="campo-form" id="prov" type="text" name="prov" value="Santa Fe" readonly onmousedown="return false;" /><br>
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
          <div class="titulo-Modal">
            <h2>Agregar nuevo destinatario</h2>
          </div>
          <div>
            <label for="razonS">Razón Social:</label><br> 
            <input class="campo-form" id="razonS" type="text" name="razons" placeholder="Razón Social"> <br>
            <label for="dni">DNI / CUIT:</label><br>
            <input class="campo-form" id="dni" type="text" name= "dni"/><br>
            <label for="te">Teléfono:</label><br>
            <input class="campo-form" id="te" type="Text" name="te" /><br>
            <label for="dire">Dirección:</label><br>
            <input class="campo-form" id="dire" type="text" name="dire"/><br>
            <label for="CP">Código Postal:</label><br>
            <input class="campo-form" id="CP" type="text" name= "codPost"/><br>
            <label for="prov">Provincia:</label><br>
            <input class="campo-form" id="prov" list="Provincia" name="prov"><br>
            <datalist id="Provincia">
              <option value="Catamarca">
              <option value="Chaco">
              <option value="Chubut">
              <option value="Córdoba">
              <option value="Corrientes">
              <option value="Entre Ríos">
              <option value="Formosa">
              <option value="Jujuy">
              <option value="La Pampa">
              <option value="La Rioja">
              <option value="Mendoza">
              <option value="Misiones">
              <option value="Neuquén">
              <option value="Río Negro">
              <option value="Salta">
              <option value="San Juan">
              <option value="San Luis">
              <option value="Santa Fe">
              <option value="Tierra del Fuego">
              <option value="Tucumán">
            </datalist>
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
