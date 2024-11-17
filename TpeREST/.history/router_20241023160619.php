<?php
    
    require_once 'libs/router.php';

    require_once 'app/controladores/proveedores.controlador.php';

    $router = new Router();

    #                 endpoint        verbo      controller                                metodo
    $router->addRoute('proveedores'      ,       'GET',     'ProveedoresController',   'obtenerTodos');
    $router->addRoute('tareas/:id'  ,            'GET',     'ProveedoresController',   'get'   );
    $router->addRoute('tareas/:id'  ,            'DELETE',  'ProveedoresController',   'delete');
    $router->addRoute('tareas'  ,                'POST',    'ProveedoresController',   'create');
    $router->addRoute('tareas/:id'  ,            'PUT',     'ProveedoresController',   'update');
    $router->addRoute('tareas/:id/finalizada'  , 'PUT',     'ProveedoresController',   'setFinalize');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);