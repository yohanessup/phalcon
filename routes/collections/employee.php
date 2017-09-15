<?php

/**
 * Collections let us define groups of routes that will all use the same controller.
 * We can also set the handler to be lazy loaded.  Collections can share a common prefix.
 * @var $employeeCollection
 */

// This is an Immeidately Invoked Function in php.  The return value of the
// anonymous function will be returned to any file that "includes" it.
// e.g. $collection = include('example.php');
return call_user_func(function(){

    $employeeCollection = new \Phalcon\Mvc\Micro\Collection();

    $employeeCollection
        // VERSION NUMBER SHOULD BE FIRST URL PARAMETER, ALWAYS
        ->setPrefix('/api/employee')
        // Must be a string in order to support lazy loading
        ->setHandler('\PhalconRest\Controllers\EmployeeController')
        ->setLazy(true);

    // Set Access-Control-Allow headers.
    $employeeCollection->options('/', 'optionsBase');
    $employeeCollection->options('/{id}', 'optionsOne');

    // First paramter is the route, which with the collection prefix here would be GET /example/
    // Second paramter is the function name of the Controller.
    $employeeCollection->get('/', 'get');
    // This is exactly the same execution as GET, but the Response has no body.
    $employeeCollection->head('/', 'get');

    // $id will be passed as a parameter to the Controller's specified function
    $employeeCollection->get('/{id:[0-9]+}', 'getOne');
    $employeeCollection->head('/{id:[0-9]+}', 'getOne');
    $employeeCollection->post('/', 'post');
    $employeeCollection->delete('/{id:[0-9]+}', 'delete');
    $employeeCollection->put('/{id:[0-9]+}', 'put');
    $employeeCollection->patch('/{id:[0-9]+}', 'patch');

    return $employeeCollection;
});