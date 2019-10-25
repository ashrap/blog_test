<?php




$router->get('', 'PostController@index');

$router->get('login', 'LoginController@index');

$router->get('register', 'RegisterController@index');

$router->get('new', 'PostController@new');

$router->get('post/{id}', 'PostController@show');

$router->get('logout', 'LoginController@logout');


$router->post('register', 'RegisterController@store');

$router->post('login', 'LoginController@login');


$router->post('new', 'PostController@store');

$router->post('edit', 'PostController@edit');

$router->post('delete', 'PostController@destroy');



//die(var_dump($router->routes));