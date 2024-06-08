# Registro de cambios (Changelog)

## [Unreleased]

### Added
- Se ha agregado la funcionalidad de autenticación de usuarios.
- Se ha implementado un nuevo sistema de notificaciones por correo electrónico.

### Changed
- Se ha actualizado la interfaz de usuario para mejorar la usabilidad.  

### Deleted
- Se borraron archivos del proyecto.

## [1.0.0] - 2024-02-15

### Added
- Se ha lanzado la versión 1.0.0 del proyecto.
- Se han añadido funcionalidades básicas para visualizacion de productos y stock en el FrontOffice.
- Se han agregado las funcionalidades basicas para la carga y mantenimiento de stock en el BackOffice. 


## Cambios en la interfaz de admin al actualizar articulos - 23/02/2024 (maxi)

### Changed
- Se realizaron cambios en los siguientes archivos. 
    /interfaz/admin/articulomodificar.php
    /interfaz/admin/articulomodificar.css

- Se agrego combo box para tipo de modificacion de stock

## Actualizacion de articulos - 23/02/2024 (diego)

## Changed
- Modificacion de la descripcion del articulo en la bbdd:
    /interfaz/admin/articulomodificar.php

## Actualizacion de articulos - 24/02/2024 (diego)
- Modificacion de la imagen del articulo en el file system y la bbdd:
    /interfaz/admin/articulomodificar.php
    /interfaz/admin/articulonuevo.php
    /modelo/articulo.php

## Modificacion de articulos - 25/02/2024 (diego)
- Actualizacion del nombre del css porque no se reconocia el css en el hosting
    /css/admin/articulomodificar.css

## Scaffolding inicial - 08/03/2024 (diego)
- Limpieza del proyecto anterior y creacion de un scaffoling inicial para 
para continuar con el desarrollo del sistema.

## Changed cambios en los nombres de los archivos y organizacion de carpetas- 12/03/2024 (maxi)
- Se aplico camelcase y se puso mismo nombre a archivos php relacionados con css y js.
- Se creo dentro de las carpetas de php,js,css una carpeta interna para separar admin y usuario

## Changed cmabios en nombre de archivos y orgainzacion de carpetas - 13/03/2004 (diego)
- se actualizaron los siguiente archivos/carpetas:
    deleted:    css/cambiar_contrasenia.css
    deleted:    css/usuario/cambiarPass.css
    modified:   helper/cambiarContrasenia.php
    modified:   interfaz/admin/articulos.php
    deleted:    interfaz/usuario/cambiarPass.php
    deleted:    js/articulosAdmin.js
    modified:   interfaz/usuario/barraNavegacion.php
    css/passwordCambiar.css
    css/usuario/passwordCambiar.css
    interfaz/usuario/passwordCambiar.php
    js/admin/

## Changed se realizaron cambios en la barra de navegacion - 21/03/2024 (Maxi).
- Se realizo cambio en la barra de navegacion. 
    css/usuario/barraNavegacion.css
- Se agrego btn de historial y se modificaron los siguentes archivos:
    interfaz/admin/articulos.php
    css/admin/articulos.css
    
### Added
- Se agregaron los siguientes archivos del lado del usuario:
    interfaz/usaurio/articulosDetalles.php
    css/usuario/articulosDetalles.css
    js/usuario/articulosDetalles.js
    ------------------------------
- Se agregaron los siguentes archivos del lado del admin:
    interfaz/admin/articuloHistorial.php
    css/admin/articuloHistorial.css

## Se actualizaron archivos para mostrar movimientos de stock y algunos ajuste
## de nombres- 23/03/2023 (diego)
## Changed 
-   css/admin/articuloHistorial.css
-   css/usuario/usuarioInicio.css
-   helper/usuarioValidar.php
-   interfaz/admin/articuloHistorial.php
-   interfaz/admin/articulomodificar.php
-   interfaz/admin/articulonuevo.php
-   interfaz/admin/articulos.php
-   interfaz/admin/usuariomodificar.php
-   interfaz/admin/usuarionuevo.php
-   interfaz/admin/usuarios.php
-   interfaz/usuario/articulos.php
-   interfaz/usuario/articulosDetalles.php
-   interfaz/usuario/barraNavegacion.php
-   interfaz/usuario/passwordCambiar.php
-   interfaz/usuario/passwordCambiar.php
-   interfaz/usuario/usuarioInicio.php
-   interfaz/usuario/usuariomodificar.php
-   interfaz/usuario/usuarionuevo.php
-   modelo/articulo.php
-   modelo/movimientosDescripcion.php
-   modelo/movimientosStock.php

## Fix de login por bug al ingreso como cliente 28/03/2024 (diego)
## changed
- login.php

## Fix de localizacion de fondo y ajuste consulta de descripcion de movimientos
## generar el registro de stock inicial cuando se crear el producto nuevo.
## 29/03/2024 (diego)
## changed
- css/usuario/usuarioInicio.css
- modelo/movimientosDescripcion.php
- interfaz/admin/articulonuevo.php
- modelo/articulo.php

## Fix mostrar el valor entero en el stock de los articulos 01/04/2024 (diego)
## changed
- interfaz/admin/articulos.php
- interfaz/usuario/articulos.php

## Se actualizó la página barraNavegación para añadirle un campo con el título de la sección actual en la que se encuentra el usuario y otro para que muestre el usuario. 13/04/2024 (Mauri)
## changed
- interfaz/usuario/barraNavegacion.php
- interfaz/usuario/barraNavegacion.css

## Se agregó la nueva sección de destinatario de envío. 26/04/2024 (Mauri)
## Added
- interfaz/usuario/destinatarioPedido.php
- interfaz/usuario/destinatarioPedido.css
- interfaz/usuario/destinatarioPedido.js

## Modificamos estructura de la página articulos.php  
## Added
- css/usuario/articulos.css
## changed
- interfaz/usuario/articulos.php

## Se crearon los 2 modales para el carrito y el detalle de los artículos y se agregó una barra de progreso al final, también se realizó control de cantidad para que no permita pedir más que el stock y además se va a pintar en rojo aquel stock que se encuentre por debajo del mínimo. 26/04/2024 (Mauri)
## Changed
    - css/usuario/articulos.css
    - interfaz/usuario/articulos.php

## Se creó la sección final de pedidos 30/04/2024 (Mauri)
- css/usuario/datosFinalesPedidos.css
- interfaz/usuario/datosFinalesPedidos.php

## Final pantalla 1 wizard carga de pedido 22/05/24 (diego)
# modificados:
    - interfaz/usuario/articulos.php
    - js/usuario/articulos.js
    - modelo/conexion.php
    - css/usuario/articulos.css
    - interfaz/usuario/articulos.php
    - modelo/articulo.php
    - interfaz/usuario/barraNavegacion.php
# borrados:
    - imagenes/productos/img1 - copia.webp
# nuevos:
    - modelo/carrito.php
    - modelo/destinatario.php

## Merging nivelatorio con el repositorio 07/06/2024 (Mauri)
# Modificados:
    - css/usuario/destinatarioPedidos.css
    - css/usuario/datosFinalesPedidos.css
    - interfaz/usuario/barraNavegacion.php

# Nuevos:
    -/interfaz/admin/pedidos.php
    -/css/admin/pedidos.css
    -/interfaz/admin/abmdestinatarios.php
    -/css/admin/abmdestinatarios.css