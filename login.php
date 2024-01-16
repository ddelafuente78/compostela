<?php
    session_start();
    include 'helper/conexion.php';
    $error = false;

    if($_POST){

        $registros = mysqli_query($conexion, "select * from usuarios where email = '" . $_POST["email"] . 
                "' and password = '" . $_POST["password"] . "'") or
                die("Problemas en el select de login:" . mysqli_error($conexion));
        
        if($registros->num_rows==0){
            $error = true;
        } else {
            $usu = mysqli_fetch_array($registros);
            $_SESSION["id"] = $usu["id"];
            $_SESSION["usuario"] = $usu["nombre"];
            if ($usu['rol'] == "cliente"){
                header("Location: interfaz/usuario/menus.php");
            } else {
                header("Location: interfaz/admin/pedidos.php?tipo=prep");
            }      
        }
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/login.css">
        <script src="https://kit.fontawesome.com/7568cd4100.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div>
                <form class="custom-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <label class="label">Email <i class="fa-solid fa-envelope"></i></label>
                    <input class="form-control" type="text" name="email" size="30"><br>
                    <label class="label">Password <i class="fa-solid fa-lock"></i></label>
                    <input class="form-control" type="password" name="password" size="30"><br>
                    <button class="submit" type="submit">Ingresar</button>
                </form>
                <?php
                    if($error){
                ?>
                    <div class="error">
                        Usuario o Contraseña incorrecto
                    </div>
                <?php        
                    }
                ?>
            </div>
        </div>    
    </body>
</html>