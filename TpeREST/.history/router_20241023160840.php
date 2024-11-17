<?php
    
    require_once 'libs/router.php';

    require_once 'app/controladores/proveedores.controlador.php';

    $router = new Router();

    #                 endpoint        verbo      controller                                metodo
    $router->addRoute('proveedores'      ,       'GET',     'ProveedoresController',   'obtenerTodos');
    $router->addRoute('proveedores/:id'  ,       'GET',     'ProveedoresController',   'obtener'   );
    $router->addRoute('proveedores'  ,            'POST',    'ProveedoresController',   'crear');
    $router->addRoute('proveedores/:id'  ,        'PUT',     'ProveedoresController',   'editar');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);