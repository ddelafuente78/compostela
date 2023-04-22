<!DOCTYPE html>
  <html>
    <head>
      <title>Administrador - compostela</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
      <link rel="stylesheet" href="../../css/articulomodificar.css">
    </head>
    <body>
      <!-- Ventana modal, por defecto no visiblel -->
      <div id="ModalArticuloOk" class="modalActualizacion">
        <div class="contenido-modal-actualizacion">
          <p>Se actualizo el articulo correctamente.</p>
        </div>
      </div>
      
      <?php
        include '../../helper/conexion.php';
        include '../../helper/validar_usuario.php';
        include '../../modelo/clases.php';

        function borrarViejaImagen($nombreArchivo){
          unlink('../../imagenes/productos/' . $nombreArchivo);
        }

        function cargarNuevaImagen($nombreArchivo, $nrofile){
          
          $carpeta="../../imagenes/productos/";
          $archivoFinal= $carpeta . $nombreArchivo;
          //pathinfo: Devuelve información acerca de la ruta de un fichero
          $tipoArchivoImagen = strtolower(pathinfo($_FILES[$nrofile]["name"],PATHINFO_EXTENSION));
          $ArchivoOK = true;

          $check = getimagesize($_FILES[$nrofile]["tmp_name"]);
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
          if ($_FILES[$nrofile]["size"] > 500000) {
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
            if (move_uploaded_file($_FILES[$nrofile]["tmp_name"], $archivoFinal)) {
              return true;
            }else{
              return false;
            }         
          }
        }

        $articulo = new articulo();
        $actualizacion=false;

        if($_POST){

          $articulo->id=$_POST['idactualizar'];
          $articulo->nombre=$_POST['nombre'];
          $articulo->desscripcion=$_POST['descripcion'];
          $articulo->foto1=$_POST['file1'];
          $articulo->foto2=$_POST['file2'];
          $articulo->stock=$_POST["stock"];
          $articulo->stock_minimo=$_POST["stockminimo"];

          if($_FILES['img1']['name'] != null){
            borrarViejaImagen($_POST['file1']);
            cargarNuevaImagen($_FILES['img1']['name'], 'img1');
            $articulo->foto1 = $_FILES['img1']['name'];
          }

          if($_FILES['img2']['name'] != null){
            borrarViejaImagen($_POST['file2']);
            cargarNuevaImagen($_FILES['img2']['name'], 'img2');
            $articulo->foto2 = $_FILES['img2']['name'];
          }

          $qryUpdate = "UPDATE articulos SET nombre='" . $articulo->nombre . "', foto1='" . $articulo->foto1 . "', foto2='" . $articulo->foto2
                        . "', descripcion='" . $articulo->desscripcion . "', stock=" . $articulo->stock . ", stock_minimo=" . $articulo->stock_minimo 
                        . " where id=" . $articulo->id ;
          mysqli_query($conexion, $qryUpdate);
          $actualizacion=true;
        }

        if($_GET){
          $articulo->id=$_GET['id'];
        }

        $qrySelect = "SELECT * FROM articulos WHERE id=" . $articulo->id;
        $rsArticulo = mysqli_query($conexion, $qrySelect);
        $articulo = mysqli_fetch_array($rsArticulo);
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
                        <a class="nav-link active" aria-current="page" href="../login.php">Cerrar</a>                    
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
              <h1>Modificar articulo</h1>
              <div class="row">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name='idactualizar' value='<?php echo $articulo['id'] ?>'>
                  <label for="nombre">Nombre:</label>
                  <input type="text" id="nombre" name="nombre" placeholder="Sin nombre"
                    value='<?php echo $articulo['nombre'] ?>'>
                  <label for="descripcion">Descripcion:</label>
                  <input type="text" id="descripcion" name="descripcion" placeholder="Sin descripcion"
                    value='<?php echo $articulo['descripcion'] ?>'>
                  <label for="foto1">Foto 1:</label>
                  <input type="hidden" id="file1" name="file1"
                    value='<?php echo $articulo['foto1'] ?>'> 
                  <span title="<?php echo $articulo['foto1']?>">
                    <img src='../../imagenes/productos/<?php echo $articulo['foto1'] ?>'/>
                  </span>
                  <input type="file" id="img1" name="img1">
                  
                  <label for="foto2">Foto 2:</label>
                  <input type="hidden" id="file2" name="file2"
                    value='<?php echo $articulo['foto2'] ?>'> 
                  <span title="<?php echo $articulo['foto2']?>">
                    <img src='../../imagenes/productos/<?php echo $articulo['foto2'] ?>'/>
                  </span>
                  <input type="file" id="img2" name="img2">
                  
                  <label for="stock">Stock</label>
                  <input type="number" id="stock" name="stock" placeholder="0"
                  value='<?php echo $articulo['stock'] ?>'>
                  <label for="stockminimo">Stock minimo</label>
                  <input type="number" id="stockminimo" name="stockminimo" placeholder="0"
                  value='<?php echo $articulo['stock_minimo'] ?>'>
                  <input type="submit" id="modificar" name="modificar" value="Modificar">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script language='JavaScript'>
        <?php
          if($actualizacion){
            echo "let mimodal = document.getElementById('ModalArticuloOk');" ;
            echo "mimodal.style.display='block';" ;
            echo "setTimeout(function() {" ;
            echo "let mimodal = document.getElementById('ModalArticuloOk');" ;
            echo "mimodal.style.display='none';" ;
            echo "}, 2000); ";
          }
        ?>  
      </script>
    </body>
</html> 
