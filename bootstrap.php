<?php 



App::bind('config', require 'config.php');



App::bind('database', new QueryBuilder ( 

	Connection::make( App::get('config')['database'] ) 

));



App::bind('validation', new Validate);



App::bind('public_path', $public_path);




Session::start();




function view( $name, $data = [] ){

	extract($data);

	return require "view/{$name}.view.php";

}



function redirect( $path, $errors = [], $data = [] ) {

	Session::errors($errors);

	Session::data($data);

	header("Location: {$path}");

	//unset($_SESSION['errors']);

}


function dd($data){

	return die(var_dump($data));

}