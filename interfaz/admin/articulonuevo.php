<!DOCTYPE html>
  <html>
    <head>
      <title>Administrador - compostela</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">-->
      <link rel="stylesheet" href="../../css/admin/articuloNuev.css">
      
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
        include 'barraNavegacionAdmin.php';
        

        function cargarArchivo($nroArchivo,$nombreArchivo){
          $carpeta="../../imagenes/productos";
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
        <h1>Nuevo artículo</h1>
        <div class='container'>
          
          <div class="contForm">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
              <label class="classLbl" for="nombre">Nombre:</label>
              <input type="text" id="nombre" name="nombre" placeholder="Sin nombre">
              <label class="classLbl" for="descripcion">Descripcion:</label>
              <input type="text" id="descripcion" name="descripcion" placeholder="Sin descripcion">
              <label class="classLbl" for="foto1">Foto 1:</label>
              <input type="file" id="file1" name="file1">
              <label class="classLbl" for="foto2">Foto 2:</label>
              <input type="file" id="file2" name="file2">
              <label class="classLbl" for="stock">Stock</label>
              <input type="number" id="stock" name="stock" placeholder="0">
              <label class="classLbl" for="stockminimo">Stock minimo</label>
              <input type="number" id="stockminimo" name="stockminimo" placeholder="0">
              <input type="submit" id="cargar" name="cargar" value="cargar">
            </form>
          </div>
        </div 
     
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
