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
    
