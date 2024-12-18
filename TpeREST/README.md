Integrantes: Dinuci Luisina, Tunesi, Maria Emilia. 

## EXPLICACION

En la parte 3 del TPE, se creó una nueva tabla llamada proveedores en la base de datos compras.

## Endpoints

### /proveedores

*GET*  
  Este endpoint utiliza el método obtenerTodos del controlador ProveedoresControlador. El controlador solicita al modelo que obtenga de la base de datos la lista de todos los proveedores y la devuelva en formato JSON a través de la vista.

*POST* 
    Este endpoint utiliza el método crear del controlador ProveedoresControlador. El controlador solicita al modelo que envíe un nuevo proveedor a la base de datos.


### /proveedores/:id

*GET* 
Este endpoint utiliza el método obtener del controlador ProveedoresControlador. El controlador solicita al modelo que obtenga de la base de datos el proveedor cuyo id coincida con el proporcionado en la URL, y devuelve la información de dicho proveedor en formato JSON a través de la vista.

*PUT* 
Este endpoint utiliza el método editar del controlador ProveedoresControlador. El controlador solicita al modelo que actualice la información del proveedor cuyo id coincida con el proporcionado en la URL, y luego devuelve la información actualizada del proveedor en formato JSON a traves de la vista. 

## ADICIONALES
### Ordenar por cualquier campo de la tabla: 
La url para testear el orden es:(localhost/carpeta en la que este guardado el tp/)TpeREST/api/proveedores?orden=nombre&ordenar=desc (o cualquier otro criterio que quiera usarse para ordenar en vez de nombre). 

### Filtrar por cualquier campo de la tabla: 
La url para testear el filtrado es:(localhost/carpeta en la que este guardado el tp/) TpeREST/api/proveedores?filtrarPor=ciudad&valor=Mar del Plata (se puede buscar por cualquier campo o cualquier valor).

### Api Auth
para obtener el token: (localhost/carpeta en la que este guardado el tp/) TpeREST/api/usuarios/token
usuario: webadmin
contraseña: Admin1229