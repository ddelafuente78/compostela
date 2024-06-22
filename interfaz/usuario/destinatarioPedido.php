<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../../css/usuario/destinatarioPedido.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
    <title>Destinatarios</title>
    <script>
      function buscarDirecciones(event){
        let razonSocial = document.getElementById('razonSoc').value;
        if (event.key === "Enter"){
          console.log(razonSocial)
        }
      }
    </script>
  </head>

  <body class="cuerpo">
    <?php
      include '../../helper/usuarioValidar.php';
      include '../../modelo/conexion.php';
      include '../../modelo/destinatario.php';
      include '../../modelo/carrito.php';
      include 'barraNavegacion.php';

      $destinatarios = new destinatario(null,null,null);

      $carrito_cab = new carrito_cab();
      $idCarrito = $carrito_cab->obtener_carrito($_SESSION["id"]);
      if ($_POST) {
        if (isset($_POST['form_id'])) {
          $direcciones = new direccion(null, null, null, null);
          switch ($_POST['form_id']) {
            case 'frmBuscar':
              $DireccionesLista = $direcciones->obtenerDirecciones($_POST['selID']);
              break;
            case 'frmSeleccion':
              $direcciones->guardarDireccionCarrito($idCarrito,$_POST['direccion']);
              header('location:datosFinalespedido.php');
              break;
            case 'frmNuevo':
              $destinatarios->guardarDestinatario($_POST['razon'],$_POST['dni'],$_POST['tel'],
                                                $_POST['dire'],$_POST['codPost'],$_POST['prov']);

          }
        }
      }

      $dest = $destinatarios->get_destinatarios();
      echo '<script> var destinatarios = [' . json_encode($dest)  . '] </script>';
      
    ?>
    <header id="cabecera">
      <div id="usuario">
        <span><?php echo $_SESSION['usuario'] ?></span>
    </div>
    <div class="seccion">
      <span>Destinatarios</span>
    </div>
  </header>
  
  <div class="container">
    <div class="form">
      <label for="razonSoc">Razón Social:</label><br> 
      <div class="input">
        <form id='frmBuscar' autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <input type="hidden" name="form_id" value="frmBuscar">
          <input type="hidden" id="selID" name="selID" value="0">
          <input class="campo-form" id="razonSoc" type="text" name="razonSoc" placeholder="Razón Social"
            value="<?php echo (isset($_POST['form_id']) and $_POST['form_id']==="frmBuscar") ? $_POST['razonSoc'] : '';?>"  
            onkeyup="buscarDirecciones(event)">
        </form> 
        <button id="btn-add" class="btn-add" type="button">+</button> <br>
      </div>
    </div>
  </div>

  <div>
    <form id='frmdireccion' autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <div class="grid-container">  
        <input type="hidden" name="form_id" value="frmSeleccion">
          <?php 
            if(isset($DireccionesLista)){
              foreach($DireccionesLista as $direccion){
          ?>
                <div class="card">
                  <div class="cabeceracard">
                    <input type="radio" id="direccion" name="direccion" 
                      value="<?php echo $direccion['id']?>">
                  </div>
                  <label><b>Teléfono:&nbsp;</b><?php echo $direccion['telefono']?></label><br>
                  <label><b>Código Postal:&nbsp;</b><?php echo $direccion['codigo_postal']?></label><br>
                  <label><b>Dirección:&nbsp;</b><?php echo $direccion['direccion']?></label><br>
                  <label><b>Provincia:&nbsp;</b><?php echo $direccion['provincia']?></label>
                </div>
          <?php
              }
            }
          ?>
      </div>
      <div class="botoncontinuar">
        <button id="btn-confirm" class="btn-enviar" type="submit">Continuar</button>
      </div>
    </form>
  </div>

  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <form id='frmdireccion' autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="hidden" name="form_id" value="frmNuevo">
        <div class="Contenedor-form-modal">
          <div class="titulo-Modal">
            <h2>Agregar nuevo destinatario</h2>
          </div>
          <div>
            <label for="razonS">Razón Social:*</label><br> 
            <input class="campo-form" id="razon" type="text" name="razon" placeholder="Razón Social" required> <br>
            <label for="dni">DNI / CUIT:</label><br>
            <input class="campo-form" id="dni" type="text" name= "dni"/><br>
            <label for="te">Teléfono:</label><br>
            <input class="campo-form" id="tel" type="Text" name="tel" /><br>
            <label for="dire">Dirección:</label><br>
            <input class="campo-form" id="dire" type="text" name="dire"/><br>
            <label for="CP">Código Postal:</label><br>
            <input class="campo-form" id="CP" type="text" name="codPost"/><br>
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
  <footer class="pie-de-pagina">
        <div class="progreso">
        </div>
        <div class="texto-progreso">
            Sección 2 de 4 
        </div>
    </footer>
  <script src="../../js/usuario/destinatarioPedido.js"></script>
</body> 
</html>
