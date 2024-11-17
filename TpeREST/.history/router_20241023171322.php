<?php
    
    require_once './libs/router.php';

    require_once 'app/controladores/proveedores.controlador.php';

    $router = new Router();

    #                 endpoint                     verbo      controller                     metodo
    $router->addRoute('proveedores'      ,       'GET',     'ProveedoresControlador',   'obtenerTodos');
    $router->addRoute('proveedores/:id'  ,       'GET',     'ProveedoresControlador',   'obtener'   );
    $router->addRoute('proveedores'  ,            'POST',    'ProveedoresControlador',   'crear');
    $router->addRoute('proveedores/:id'  ,        'PUT',     'ProveedoresControlador',   'editar');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);