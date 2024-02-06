<?php
  include '../../modelo/conexion.php';
  include '../../helper/validar_usuario.php';
  
  if($_GET){
    $_SESSION['nropedido'] = $_GET['nro'];
  }

  //echo $_SESSION['nropedido'];
  header("Location: carrito.php");
?>