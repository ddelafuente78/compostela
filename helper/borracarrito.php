<?php
    include '../helper/conexion.php';
    include '../helper/validar_usuario.php';

    if($_GET){
        echo "borrar id ". $_GET["id"];
        mysqli_query($conexion, "delete from carrito where id=$_GET[id]");
    }
    header("Location: ../interfaz/usuario/carrito.php");
?>