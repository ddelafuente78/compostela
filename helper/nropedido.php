<?php
    include 'validar_usuario.php';
    $_SESSION['nropedido'] = uniqid();
    //$_SESSION['nropedido'] = 2;
    header("Location: ../interfaz/usuario/articulos.php");
?>