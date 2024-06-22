<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/usuario/abmDestinatarios.css">
    <link rel="stylesheet" href="../../css/uicons-solid-rounded.css">
    <title>Puerto Compostela - ABM Destinatarios</title>
</head>
<body>
    <?php
        include 'barraNavegacion.php';
    ?>
    <header>
        <div>
            <h1>ABM Destinatarios</h1>
        </div>
    </header>
    <div class="contenedor">
        <form class="campo-form" autocomplete="off" action="">
        <div class="form">
            <label for="razonSoc">Razón Social:</label><br> 
            <div class="input">
                <input class="campo-form" id="razonSoc" type="text" name="razons" placeholder="Razón Social">
            </div>
            <label for="dni">DNI / CUIT:</label><br>
            <input class="campo-form" id="dni" type="text" name= "dni" value="30266778" size="10" /><br>
            <label for="te">Teléfono:</label><br>
            <input class="campo-form" id="te" type="Text" name="te" value="3493416651" size="15" /><br>
            <label for="dire">Dirección:</label><br>
            <div class="etiqueta"></div>
            <input class="campo-form" id="dire" type="text" name="dire" value="Victoria Ocampo 56"; /><br>
            <label for="CP">Código Postal:</label><br>
            <input class="campo-form" id="CP" type="text" name= "codPost" value="2322"; /><br>
            <label for="prov">Provincia:</label><br>
            <input class="campo-form" id="prov" type="text" name="prov" value="Santa Fe"; />
        </div>
        <div class="contiene-boton">
            <button class="btn" type="button" id="graba">Grabar</button>
            <button class="btn" type="button" id="borra">Borrar</button>
            <button class="btn" type="button" id="nuevo" onclick="limpiaForm()">Nuevo</button>
        </div>
    
        

        </form>
    </div>
    <script src="../../js/usuario/abmDestinatarios.js"></script>
</body>
</html>