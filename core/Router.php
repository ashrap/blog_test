<?php

class Router 

{


	public $wildcards = [];


	public $routes = [

		'GET' => [],

		'POST' => []

	];


/*****************************************************************************************************/


	

/***********************
**
* *
*  Register all GET routes
* *
**
***********************/

	public function get($uri, $controller) {

		if ( preg_match('/\S*\/?\{\S+\}/', $uri) ) {


			$wildcards = mb_substr(explode('{', $uri)[1], 0, -1);

			$uri = trim(explode( '{', $uri )[0], '/' );

			$this->wildcards[] = $uri;			

			$this->routes['GET'][$uri] = $controller;

		} else {

			$this->routes['GET'][$uri] = $controller;

		}

	}

/*****************************************************************************************************/




/***********************
**
* *
*  Register all POST routes
* *
**
***********************/

	public function post($uri, $controller) {

		$this->routes['POST'][$uri] = $controller;

	}

/*****************************************************************************************************/




/***********************
**
* *
*  Directing request
* *
**
***********************/

	public function direct($uri, $requestType) {

		
		foreach( $this->wildcards as $wildcard ) {

			$exp = '/' . $wildcard . '\/\S+/';

			if ( preg_match($exp, $uri) ) {

				$uri = explode('/', $uri)[0];				

			}


		}


		if ( $requestType === 'GET' ) {

			if ( array_key_exists($uri, $this->routes[$requestType]) ) {


				Session::generateToken($uri, $requestType);


				return $this->actionCall(

					...explode('@', $this->routes[$requestType][$uri])

				);




			} else {			

				return view('not_found');

			}

		}



		if ( $requestType === 'POST' ) {

			
			if ( array_key_exists($uri, $this->routes[$requestType]) ) {


				Session::generateToken($uri, $requestType);


				if ( ! hash_equals($_SESSION['previous_token'], $_POST['token']) ) {

					throw new Exception("Error Processing Request", 1);
					

					return view('page_expired');

				}


				return $this->actionCall(

					...explode('@', $this->routes[$requestType][$uri])

				);



			} else {			

				return view('not_found');

			}

		}
		

	}

/*****************************************************************************************************/




/***********************
**
* *
*  HELPER: calling requested method of the controller
* *
**
***********************/

	protected function actionCall($controller, $action) {
		

		$controller = new $controller;

		if ( ! method_exists($controller, $action)) {

			throw new Exception("{$controller} doesn't have method: {$action}");			

		}


		return $controller->$action();

	}


}