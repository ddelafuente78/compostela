<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../css/admin/pedidos.css">
    <link rel="stylesheet" href="../../css/uicons-solid-rounded.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Puerto Compostela</title>
    <?php
        include '../../modelo/conexion.php';
        include '../../helper/usuarioValidar.php';
        include 'barraNavegacionAdmin.php';
    ?>
</head>
<body class="body-pedidos">
    <header class="cabecera">
        <div id="cab-usuario">
            <span>Mauricio</span>
        </div>
    </header>
    <div class="contenedor">
        <button class="tablink btn1" onclick="openPage('Bandeja', this, '#FDC5BA')"id="defaultOpen">Bandeja de entrada</button>
        <button class="tablink" onclick="openPage('Proceso', this, '#FAF797')">En Proceso</button>
        <button class="tablink" onclick="openPage('Enviado', this, '#BCFA97')">Enviado</button>
<!-- --------------Primera pestaña---------------- -->
        <div id="Bandeja" class="tabcontent"> 
            <section class="cab-pedidos">
                <div class="col1">
                    <span>Código</span>
                </div>
                <div class="col2">
                    <span>Fecha</span>
                </div>
                <div class="col3">
                    <span>Prioridad</span>
                </div>
                <div class="col4">
                    <span>Usuario</span>
                </div>
                <div class="col5">
                    <span>Destinatario</span>
                </div>
            </section>
            <section class="det-pedidos accordion">
                <div class="col1">
                    <span id="cod">123456</span>
                </div>
                <div class="col2">
                    <span id="fecha">08/05/2024</span>
                </div>
                <div class="col3">
                    <span id="prioridad">Normal</span>
                </div>
                <div class="col4">
                    <span id="usuario">Mauricio</span>
                </div>
                <div class="col5">
                    <span id="destinatario">Diego De La Fuente</span>
                </div>
            </section>
            <div class="panel">
                <section class="datos-pedido">
                    <div class="cab-articulos-det">
                        <div id="nombre">
                            <p>Artículo</p>
                        </div>
                        <div id="desc">
                            <p>Descripción</p>
                        </div>
                        <div id="cant">
                            <p>Cantidad</p>
                        </div>
                    </div>
                    <div class="articulos-det ">
                        <div id="nom-articulo">
                            <p>Nombre</p>
                        </div>
                        <div id="desc-articulo">
                            <p>Descripción</p>
                        </div>
                        <div id="cant-articulo">
                            <p>Cantidad</p>
                        </div>
                    </div>
                    <div class="btn-pedidos">
                        <button type="submit" id='btnCambioEstado' class="btn">Procesar</button>
                        <button type="submit" id='btnImprimir'class="btn">Imprimir</button>
                    </div>
                </section>
            </div>
        </div>
<!-- --------------Segunda pestaña---------------- -->
        <div id="Proceso" class="tabcontent">
            <section class="cab-pedidos">
                <div class="col1">
                    <span>Código</span>
                </div>
                <div class="col2">
                    <span>Fecha</span>
                </div>
                <div class="col3">
                    <span>Prioridad</span>
                </div>
                <div class="col4">
                    <span>Usuario</span>
                </div>
                <div class="col5">
                    <span>Destinatario</span>
                </div>
            </section>
            <section class="det-pedidos accordion">
                <div class="col1">
                    <span id="cod">123456</span>
                </div>
                <div class="col2">
                    <span id="fecha">08/05/2024</span>
                </div>
                <div class="col3">
                    <span id="prioridad">Normal</span>
                </div>
                <div class="col4">
                    <span id="usuario">Mauricio</span>
                </div>
                <div class="col5">
                    <span id="destinatario">Diego De La Fuente</span>
                </div>
            </section>
            <div class="panel">
                <section class="datos-pedido">
                    <div class="accordion2 cab-articulos-det">
                        <div id="nombre">
                            <p>Artículo</p>
                        </div>
                        <div id="desc">
                            <p>Descripción</p>
                        </div>
                        <div id="cant">
                            <p>Cantidad</p>
                        </div>
                    </div>
                    <div class="panel2">
                        <div class="articulos-det ">
                            <div id="nom-articulo">
                                <p>Nombre</p>
                            </div>
                            <div id="desc-articulo">
                                <p>Descripción</p>
                            </div>
                            <div id="cant-articulo">
                                <p>Cantidad</p>
                            </div>
                        </div>
                    </div>
                    <form action="/action_page.php">
                        <div class="datos-embalaje">
                            <fieldset>
                                <legend>Embalaje:</legend>
                                <label for="cant-b">Cantidad bultos: </label>
                                <input type="number" id="cant-b" class="input" name="cant-b" min=1 value= 1>
                                <button class="btn" type="button" onclick="generar()">Generar tabla</button>       
                                <table id="dataTable">
                                    <thead>    
                                        <tr>
                                            <th class="col-t-1">Tipo Embalaje</th>
                                            <th class="col-t-2">Especial</th>
                                            <th class="col-t-3">Peso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </fieldset>
                            <div class="btn-pedidos">
                                <button type="submit" id='btnCambioEstado' class="btn">Procesar</button>
                            </div> 
                        </div>
                    </form>
                </section>
            </div>
        </div>
<!-- --------------Tercer pestaña---------------- -->
        <div id="Enviado" class="tabcontent">
        <section class="cab-pedidos">
                <div class="col3_1">
                    <span>Código</span>
                </div>
                <div class="col3_2">
                    <span>Fecha</span>
                </div>
                <div class="col3_3">
                    <span>Prioridad</span>
                </div>
                <div class="col3_4">
                    <span>Usuario</span>
                </div>
                <div class="col3_5">
                    <span>Destinatario</span>
                </div>
                <div class="col3_6">
                    <span>Fecha envío</span>
                </div>
                <div class="col3_7">
                    <span>Imprimir</span>
                </div>
            </section>
            <section class="det-pedidos envios">
                <div class="col3_1">
                    <span id="cod">123456</span>
                </div>
                <div class="col3_2">
                    <span id="fecha">08/05/2024</span>
                </div>
                <div class="col3_3">
                    <span id="prioridad">Normal</span>
                </div>
                <div class="col3_4">
                    <span id="usuario">Mauricio</span>
                </div>
                <div class="col3_5">
                    <span id="destinatario">Diego De La Fuente</span>
                </div>
                <div class="col3_6">
                    <span id="fecha">15/05/2024</span>
                </div>
                <div class="col3_7">
                    <button class="btn" type="button"><i class="fi fi-rr-file-pdf"></i></button>
                </div>
            </section>
            
        </div>
    </div>
</body>
<script src='../../js/admin/pedidos.js'></script>
</html>