<!DOCTYPE html>
  <html>
    <head>
      <title>Administrador - compostela</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
      <style>
        body {
    font-family: "Segoe UI", sans-serif;
    font-size:100%;
}

.menu {
    background:#333;
    width:100%;
    height: 100%;
    left: 10px;
}

.sidebar {
    position: fixed;
    top: -10px;
    bottom: 10px;
    left: 0px ;
    z-index: 1;
}
.sidebar ul, .sidebar li {
    margin:0;
    padding:0;
    margin-left: 10px ;
    list-style:none inside;}
.sidebar ul {
    margin: 4rem auto;
    display: block;
    width: 80%;
    min-width:120px;}
.sidebar a {
    display: block;
    font-size: 120%;
    color: #fff;
    text-decoration: none}

.sidebar a:hover{
    color:#fff;
    background-color: #f90;
    border-radius: 5px;
    padding-left: 5px;
}

.sidebar .menusel{
    color:#fff;
    background-color: #f90;
    border-radius: 5px;
    padding-left: 5px;
}

input[type=text], input[type=file], input[type=number]{
    width:99%;
    padding: 12px 20px;
    margin: 8px 8px;
    display:inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

  /* Style the submit button */
input[type=submit] {
    width: 99%;
    background-color: #f90;
    color: white;
    padding: 14px 20px;
    margin: 8px 8px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
      </style>
      
    </head>
    <body>
      <!-- Ventana modal, por defecto no visiblel -->
      <div id="modalinsertarpedido" class="modal">
        <div class="contenido-modal">
          <p>Se inserto el articulo.</p>
        </div>
      </div>
      <?php
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';
        include '../../modelo/clases.php';

        function cargarArchivo($nroArchivo,$nombreArchivo){
          $carpeta="../../imagenes/productos/";
          $archivoFinal= $carpeta . $nombreArchivo;
          //pathinfo: Devuelve información acerca de la ruta de un fichero
          $tipoArchivoImagen = strtolower(pathinfo($_FILES["file" . $nroArchivo]["name"],PATHINFO_EXTENSION));
          $ArchivoOK = true;
          $check = getimagesize($_FILES["file" . $nroArchivo]["tmp_name"]);
          
          if($check !== false) {
            $ArchivoOK = true;;
          } else {
            $ArchivoOK = false;
          }

          // verfica si existe el archivo
          if (file_exists($archivoFinal)) {
            $ArchivoOK = false;
          }

          // verifica el tamanio del archivo
          if ($_FILES["file" . $nroArchivo]["size"] > 500000) {
            
            $ArchivoOK = false;
          }

          // permite ciertos formatos
          if($tipoArchivoImagen != "jpg" && $tipoArchivoImagen != "png" && $tipoArchivoImagen != "jpeg" && $tipoArchivoImagen != "gif" ) {
            $ArchivoOK = false;
          }

          
          // verifica si el archivo es correcto para subir
          if ($ArchivoOK == false) {
            return false;
          // Si todo esta ok, subimos el archivo
          } else {
            if (move_uploaded_file($_FILES["file" . $nroArchivo]["tmp_name"], $archivoFinal)) {
              return true;
            }else{
              return false;
            }         
          }
        }
        $insercion=false;
        if($_POST){
      
          $articulo = new articulo();
          
          $articulo->nombre=$_POST['nombre'];
          $articulo->desscripcion=$_POST['descripcion'];
          $articulo->foto1=$_FILES["file1"]["name"];
          $articulo->foto2=$_FILES["file2"]["name"];
          $articulo->stock=$_POST["stock"];
          $articulo->stock_minimo=$_POST["stockminimo"];
          
          if(cargarArchivo("2",$articulo->foto2) && cargarArchivo("1",$articulo->foto1)){
            $insQuery = "INSERT INTO articulos VALUES(default,'" . $articulo->nombre . "','" . $articulo->foto1 . "','" . $articulo->foto2 .
                        "','". $articulo->desscripcion . "'," . $articulo->stock . "," . $articulo->stock_minimo  . ", CURRENT_TIMESTAMP(), null);";
            mysqli_query($conexion, $insQuery);
            $insercion=true;
          }
        }
      ?>
      <div class='Container'>
        <div class='row'>
          <div class="col-12">
            <!-- Header -->
            <header class="d-flex flex-wrap py-3 mb-5 border-bottom">
              <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container">
                  <a class="navbar-brand" href="#"><?php echo $_SESSION["usuario"] ?></a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../login.php">Cerrar</a>                    
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
            </header>
          </div>
        </div>
        <div class="row">
          <div class="col-1">
            <div id="sidebar" class="sidebar">
              <ul class="menu">
                <li><a href="pedidos.php?tipo=prep">Pedidos</a></li>
                <li><a class="menusel" href="articulos.php">Articulos</a></li>
                <li><a href="usuarios.php">Usuarios</a></li>
                <li><a href="transporte.php">Transporte</a></li>
                <li><a href="reportes.php">Reportes</a></li>
              </ul>
            </div>
          </div>
          <div class="col-11">
            <div class='Container'>
              <h1>Nuevo articulo</h1>
              <div class="row">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                  <label for="nombre">Nombre:</label>
                  <input type="text" id="nombre" name="nombre" placeholder="Sin nombre">
                  <label for="descripcion">Descripcion:</label>
                  <input type="text" id="descripcion" name="descripcion" placeholder="Sin descripcion">
                  <label for="foto1">Foto 1:</label>
                  <input type="file" id="file1" name="file1">
                  <label for="foto2">Foto 2:</label>
                  <input type="file" id="file2" name="file2">
                  <label for="stock">Stock</label>
                  <input type="number" id="stock" name="stock" placeholder="0">
                  <label for="stockminimo">Stock minimo</label>
                  <input type="number" id="stockminimo" name="stockminimo" placeholder="0">
                  <input type="submit" id="cargar" name="cargar" value="cargar">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script language="javascript">
        <?php
          if($insercion){
            echo "let mimodal = document.getElementById('modalinsertarpedido');" ;
            echo "mimodal.style.display='block';" ;
            echo "setTimeout(function() {" ;
            echo "let mimodal = document.getElementById('modalinsertarpedido');" ;
            echo "mimodal.style.display='none';" ;
            echo "}, 2000); ";
        }
      ?>
      </script>
    </body>
</html> 
