<?php
    
    require_once 'libs/router.php';

    require_once 'app/controladores/proveedores.api.controlador.php';
    require_once 'app/controladores/usuario.api.controlador.php';
    require_once 'app/middlewares/jwt.auth.middleware.php';

    $router = new Router();

    #                 endpoint                     verbo      controller                     metodo
    $router->addRoute('proveedores'      ,       'GET',     'ProveedoresControlador',   'obtenerTodos');
    $router->addRoute('proveedores/:id'  ,       'GET',     'ProveedoresControlador',   'obtener'   );
    $router->addRoute('proveedores'  ,            'POST',    'ProveedoresControlador',   'crear');
    $router->addRoute('proveedores/:id'  ,        'PUT',     'ProveedoresControlador',   'editar');

    $router->addRoute('usuarios/token'    ,       'GET',     'UsuarioControlador',   'obtenerToken');
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);