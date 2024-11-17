<?php
    
    require_once 'libs/router.php';

    require_once 'app/controladores/proveedores.api.controlador.php';
    require_once 'app/controladores/usuario.api.controlador.php';
    require_once 'app/middlewares/jwt.auth.middleware.php';

    $router = new Router();

    #                 endpoint                     verbo      controller                     metodo
    $router->addRoute('proveedores'      ,       'GET',     'ProveedoresApiControlador',   'obtenerTodos');
    $router->addRoute('proveedores/:id'  ,       'GET',     'ProveedoresApiControlador',   'obtener'   );
    $router->addRoute('proveedores'  ,            'POST',    'ProveedoresApiControlador',   'crear');
    $router->addRoute('proveedores/:id'  ,        'PUT',     'ProveedoresApiControlador',   'editar');

    $router->addRoute('usuarios/token'    ,       'GET',     'UsuarioApiControlador',   'obtenerToken'); 
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);