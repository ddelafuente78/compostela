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
                header("Location: interfaz/usuario/menu.php");
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link rel="stylesheet" href="css/login.css">
        
    </head>
    <body>
        <div class="container">
            <div>
                <form class="custom-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    email:
                    <input class="form-control" type="text" name="email" size="30"><br>
                    password:
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